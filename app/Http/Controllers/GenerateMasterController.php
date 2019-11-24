<?php

namespace App\Http\Controllers;

require __DIR__ . '/../../../vendor/autoload.php';

use Auth;
use Datetime;
use Session;

use Illuminate\Http\Request;
use SpotifyWebAPI;
use App\Artist;
use App\Song;

class GenerateMasterController extends Controller
{
	static private function createSpotifySession ()
	{
		return new SpotifyWebAPI\Session(
			config('services.spotify')['client_id'],
			config('services.spotify')['client_secret'],
			config('services.spotify')['redirect']
		);
	}

	public function index($artist_id)
	{
		// アーティストの存在確認
		$artist = Artist::where('artist_id', $artist_id)->first();
		if (empty($artist)){
            return abort('404');
		}

		// セッションを作成
		$session = GenerateMasterController::createSpotifySession();
		
		// \Log::debug('generateMaster/index artist_id = '. $artist_id);

		// セッションに検索対象のアーティストIDを乗せておく
        session(['search.artist_id' => $artist_id]);
		Session::save();

		// spotifyに権限リクエストを投げる
		header('Location: ' . $session->getAuthorizeUrl(array(
			'scope' => array(
			  'playlist-read-private', // プレイリスト取得
			  'playlist-modify-private', // プレイリスト変更
			  'user-read-private',
			  'playlist-modify'
			)
		)));
		die();
	}

	/**
	 * Spotify APIからのコールバック
	 */
	public function callback()
	{
		// ------------------------------------------- //
		// 検索するアーティストを取得しておく
		// ------------------------------------------- //
		// セッションからartist_idを取得
		$artist_id = session('search.artist_id');
		// セッションから消しておく
		session()->forget('search.artist_id');

		$artist = Artist::where('artist_id', $artist_id)->first();
		if (empty($artist)){
			\Log::debug('generateMaster/callback cannot get artist. artist_id = ' . $artist_id);
            return abort('500');
		}
		
		// 編集者ユーザーIDを取得しておく
		$edit_user_id = 0;
		if (!empty(Auth::user())) {
			$edit_user_id = Auth::user()->id;
		}

		// ------------------------------------------- //
		// SpotifyにAPIを投げる準備
		// ------------------------------------------- //
		$session = GenerateMasterController::createSpotifySession();

		$api = new SpotifyWebAPI\SpotifyWebAPI();

		if (isset($_GET['code'])) {
		    $session->requestAccessToken($_GET['code']);
		    $api->setAccessToken($session->getAccessToken());

			// \Log::debug(var_export($api->me(), true));
			// \Log::debug($session->getAccessToken());

			// ------------------------------------------- //
			// アーティスト名を決定
			// ※専用のアーティスト名をSpotify APIでは使用している可能性がある
			// ------------------------------------------- //
			// アーティストを1件取得
			$result = $api->search($artist->name, "artist", array(
				'limit' => 10,
				'offset' => 0
			));
			// アーティストが見付からなかったら終了
			if (empty($result->artists->items)){
				return redirect()->route('artists.show', $artist->artist_id);
			}
			// 同一のアーティスト名が見付かったらそれを使用する
			$artist_name = null;
			foreach ($result->artists->items as $item) {
				if ($item->name === $artist->name) {
					$artist_name = $artist->name;
					break;
				}
			}
			// 同一のアーティスト名が見付かった場合は配列0番目のアーティスト名を使用してみる
			if (empty($artist_name)) {
				$artist_name = $result->artists->items[0]->name;
			}
			
			// ------------------------------------------- //
			// 楽曲検索（件数毎に通信）
			// ------------------------------------------- //
			// 一度に検索する件数
			$SEARCH_COUNT = 50;
			
			$offset = 0;
			$trackNameList = array();
			do {
				// アーティスト名で検索実行
				$result = $api->search($artist_name, "track", array(
					'limit' => $SEARCH_COUNT,
					'offset' => $offset
				));

				// 曲名のみの配列
				$songNameList = array();

				// アーティスト名と完全一致するものが無くなったら終了する
				foreach ($result->tracks->items as $item) {
					if ($item->artists[0]->name === $artist_name) {
						$songNameList[] = $item->name;
					} else {
						\Log::debug('artist name: '.$item->artists[0]->name);
					}
				}
				if (empty($songNameList)) {
					break;
				}
				
				// 検索結果から曲名のみを抽出した配列を取得
				// $nameList = array_column($result->tracks->items, 'name');
				// 検索結果をマージ
				$trackNameList = array_merge($trackNameList, $songNameList);
				$trackNameList = array_unique($trackNameList);
				$trackNameList = array_values($trackNameList);
				
				// offset値を加算
				$offset += $SEARCH_COUNT;
				
				//0.2秒スリープ(一応APIにかかる負荷を減らすつもり)
				usleep(200000);
				
				// nextがある間はループさせる
				$isExistNext = !empty($result->tracks->next);
			} while ($isExistNext);
			
			// 最終的な検索結果を表示
			//echo '<pre>' . var_export($result, true) . '</pre>';
			//echo '<pre>' . var_export($trackNameList, true) . '</pre>';
			
			// 登録前にそのアーティストIDのデータは削除しておく
			//Song::where('artist_id', $artist->artist_id)->delete();
			
			// ------------------------------------------- //
			// 登録データ抽出
			// ------------------------------------------- //
			$savedata = array();
			foreach($trackNameList as $key => $name)
			{
				// 登録済みかを確認
				$current = Song::where('artist_id', $artist->artist_id)->where('name', $name)->get();
				if($current->isEmpty()){
					// 括弧が付いていたら無視
					if(preg_match('/.*\(.+?\).*/', $name)) {
						\Log::debug('brackets: '.$name);
						continue;
					}
					// 特定の文字列が含まれたいたら無視
					if (strpos($name, 'instrumental') !== false
						|| strpos($name, 'Instrumental') !== false
						|| strpos($name, 'instrumetal') !== false // 誤字
						|| strpos($name, 'Instrumetal') !== false // 誤字
						|| strpos($name, 'KARAOKE') !== false
						|| strpos($name, 'Short Edit') !== false
						|| strpos($name, 'album mix') !== false
						|| strpos($name, 'TV Mix') !== false
						|| strpos($name, 'TV MIX') !== false
						|| strpos($name, 'TV edit') !== false
						|| strpos($name, 'TV Edit') !== false
						|| strpos($name, 'TVsize') !== false
						|| strpos($name, 'TVSize') !== false
						|| strpos($name, 'one man live') !== false
						|| strpos($name, 'One-man Live') !== false
						|| strpos($name, 'off vocal') !== false
						|| strpos($name, 'Game Size') !== false
						|| strpos($name, '8BIT Mix') !== false
						|| strpos($name, 'ver.') !== false
						|| strpos($name, 'Ver.') !== false
						|| strpos($name, ' Ver') !== false
						|| strpos($name, ' ver') !== false
						|| strpos($name, ' Version') !== false
						|| strpos($name, ' version') !== false
						|| strpos($name, 'remix') !== false
						|| strpos($name, 'Remix') !== false
						) {
						\Log::debug('invalid strings: '.$name);
						continue;
					}
					// 現在追加しようとしているリストに入っていないか確認
					// TODO : 空白を削除したもの同士を比較するのもありかも
					if (array_search(strtolower($name), array_map('strtolower', array_column($savedata, 'name'))) !== false){
						\Log::debug('already exist: '.$name);
						continue;
					}

					// 曲データを作成
					$song = array();
					$song['artist_id'] = $artist->artist_id;
					$song['name'] = $name;
					$song['edit_user_id'] = $edit_user_id;
					$song['created_at'] = new DateTime();
					$song['updated_at'] = new DateTime();
					
					$savedata[$key] = $song;
				}
				else
				{
					//echo 'current : ' . '<pre>' . var_export($current, true) . '</pre>';
				}
			}
			
			// ------------------------------------------- //
			// データ保存
			// ------------------------------------------- //
			if(empty($savedata)) {
				\Log::debug('新規データはありませんでした。');
			} else {
				// \Log::debug(var_export($savedata, true));

				// 保存
				Song::insert($savedata);
			}
			
			return redirect()->route('artists.show', $artist->artist_id);
		} else {
			\Log::error('error occured.');
            return abort('500');
		}
	}
}

