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
			'0c3de006d178498497fab849ce950da5',
			'4d80f88f6ca44c89831cb42a4e65b1e5',
			'http://homestead.setlist/generateMaster/callback'
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
			
			$offset = 0;
			$trackNameList = array();
			do {
				// アーティスト名で検索実行
				$result = $api->search($artist->name, "track", array(
					'limit' => 20,
					'offset' => $offset
				));
				
				// 検索結果から曲名のみを抽出した配列を取得
				$nameList = array_column($result->tracks->items, 'name');
				// 検索結果をマージ
				$trackNameList = array_merge($trackNameList, $nameList);
				$trackNameList = array_unique($trackNameList);
				$trackNameList = array_values($trackNameList);
				
				// offset値を加算
				$offset += 20;
				
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
			
			// データベースに登録
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
						|| strpos($name, 'Album Ver') !== false
						|| strpos($name, 'album mix') !== false
						|| strpos($name, 'TV MIX') !== false
						|| strpos($name, 'TV Size ver') !== false
						|| strpos($name, 'LIVE ver') !== false
						) {
						\Log::debug('invalid strings: '.$name);
						continue;
					}
					// 現在追加しようとしているリストに入っていないか確認
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

