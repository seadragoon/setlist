<?php

namespace App\Http\Controllers;

require __DIR__ . '/../../../vendor/autoload.php';

use Illuminate\Http\Request;
use SpotifyWebAPI;
use App\Artist;
use App\Song;

class GenerateMasterController extends Controller
{
	public function index()
	{
		$session = new SpotifyWebAPI\Session(
		    '0c3de006d178498497fab849ce950da5',
		    '4d80f88f6ca44c89831cb42a4e65b1e5',
		    'http://localhost:8080/setlist/public/generateMaster'
		);

		$api = new SpotifyWebAPI\SpotifyWebAPI();

		if (isset($_GET['code'])) {
		    $session->requestAccessToken($_GET['code']);
		    $api->setAccessToken($session->getAccessToken());

		    //print_r($api->me());
		    //print_r($session->getAccessToken());
			
			// 検索アーティスト名
			$targetName = "GARNiDELiA";
			
			$offset = 0;
			$trackNameList = array();
			do {
				// 検索実行
				$result = $api->search($targetName, "track", array(
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
			
			// アーティストデータ取得
			$artist = Artist::where('name', $targetName)->first();
			if (empty($artist)){
				// 空なら作成する
				$artist = new Artist();
				$artist->name = $targetName;
				$artist->save();
				echo "アーティスト名「" . $targetName . "」を追加しました。";
			}
			
			// 登録前にそのアーティストIDのデータは削除しておく
			//Song::where('artist_id', $artist->artist_id)->delete();
			
			// データベースに登録
			$savedata = array();
			foreach($trackNameList as $key => $name)
			{
				// 登録済みかを確認
				$current = Song::where('artist_id', $artist->artist_id)->where('name', $name)->get();
				if($current->isEmpty()){
					// 現在追加しようとしているリストに入っていないか確認
					if (array_search(strtolower($name), array_map('strtolower', array_column($savedata, 'name'))) === false){
						$song = array();
						$song['artist_id'] = $artist->artist_id;
						$song['name'] = $name;
						$song['created_at'] = new DateTime();
						$song['updated_at'] = new DateTime();
						
						$savedata[$key] = $song;
					}
				}
				else
				{
					//echo 'current : ' . '<pre>' . var_export($current, true) . '</pre>';
				}
			}
			
			// 保存
			if(empty($savedata)) {
				echo "新規データはありませんでした。";
			} else {
				Song::insert($savedata);
				echo '<pre>' . var_export($savedata, true) . '</pre>';
			}
			
		} else {
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
	}
}

