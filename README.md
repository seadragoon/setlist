# setlist
セットリスト

### 追加したい機能
* Twitter OAuthログイン→UserId発行、編集者の表示
* 検索機能（特定の曲を歌ったイベントをリストで表示する）
* 集計機能（歌唱回数の多い曲ランキング、等）

### 機能
* アーティストデータの登録
* 曲データの登録
* セットリストの登録
* キーワード（曲名、アーティスト名、ライブ名など）でセトリを検索
* 曲一覧を表示
* セトリ一覧を表示
* ・集計機能
* 曲ごとの歌った回数を表示
* 期間指定もしたい
* 年、月ごとの集計も

### ページ種類
* ・共通ヘッダーメニュー
* 一覧表示画面、新規楽曲追加画面、新規イベント追加画面（セットリストも同時に追加）
* ・一覧表示画面
* 直近のイベント一覧を表示する10件までとか（日付で範囲指定・ページング必要）
* イベント名をクリックすると「イベント詳細ページ」に遷移
* ・イベント詳細ページ
* セットリストを表示するページ
* 楽曲名をクリックすると「楽曲詳細ページ」に遷移
* イベント詳細データの編集（「イベント編集ページ」に遷移）、削除が可能
* ・楽曲詳細ページ
* 楽曲データを表示するページ
* その楽曲が歌われた直近のイベント一覧を表示する（日付で範囲指定・ページング必要）
* 楽曲データの編集（「楽曲編集ページ」に遷移）、削除が可能
* ・新規イベント追加ページ
* ・イベント編集ページ
* 日付
* イベント名
* 会場名
* イベント概要
* ○セトリデータ
* アーティストID
* セトリグループタイプ
* ○セトリ曲リスト
* セトリグループ連番
* 番号
* 曲ID
* メドレーかどうか
* コラボアーティストリスト
* ・新規楽曲追加ページ（楽曲の追加はSQL経由でもいいかもしれない）
* ・楽曲編集ページ

### テーブル設計

・ユーザーデータ(users)  
user_id		: ユーザーID  
twitter_id	: TwitterID  

・アーティストデータ(artists)  
artist_id	: アーティストID(連番)  
name		: アーティスト名  
link		: リンクテキスト、オフィシャルページとかを入れる  
edit_user_id: 編集ユーザーID  

・曲データ(songs)  
song_id		: 曲ID(連番)  
artist_id	: アーティストID(サブキー)  
name		: 曲名  
link		: リンクテキスト、商品のリンクとか入れる用  
edit_user_id: 編集ユーザーID  

・イベントデータ(events)  
event_id	: イベントID(連番)  
datetime	: 開催日付  
name		: イベント名  
summary		: イベント概要  
venue_name	: 会場名  
tag_text	: タグテキスト(カンマ区切りで保存とか)  
event_type	: イベントタイプ(0:ワンマンライブ、1:ミニライブ、2:フェス、3:対バン)  
edit_user_id: 編集ユーザーID  

・セトリデータ(setlists) 一つのイベントに複数のアーティストのデータがぶら下がる想定  
setlist_id	: セトリID(連番)  
event_id	: イベントID  
artist_id	: アーティストID  

・セトリグループ(setlist_group)  
setlist_id			: セトリID  
setlist_group_seq	: セトリグループ連番  
setlist_group_type	: セトリグループタイプ(0:通常、1:アンコール、2:コラボ、3:カバー）  

・セトリ曲データ(setlist_songs)  
setlist_id			: セトリID  
setlist_group_seq	: セトリグループ連番  
seq					: 手動連番(サブキー)  
song_id				: 曲ID  
is_medley			: メドレーかどうか このフラグが立っているものが連続した場合にはメドレーとして扱う  
collabo_artist_ids	: アーティストIDをカンマ区切りで  
arrange_type		: アレンジタイプ(0:通常, 1:アコースティック) 使うかわからん  
edit_user_id		: 編集ユーザーID  

### その他
■マイグレーション作成
php artisan make:migration create_artists_table --create=artists  
php artisan make:migration create_songs_table --create=songs  
php artisan make:migration create_events_table --create=events  
php artisan make:migration create_setlists_table --create=setlists  
php artisan make:migration create_setlist_group_table --create=setlist_group  
php artisan make:migration create_setlist_songs_table --create=setlist_songs  
■モデル作成  
php artisan make:model Artist  
php artisan make:model Song  
php artisan make:model Event  
php artisan make:model Setlist  
php artisan make:model SetlistGroup  
php artisan make:model SetlistSongs  
■ルーティング  
Route::resource('artists', 'ArtistsController');  
Route::resource('songs', 'SongsController');  
Route::resource('events', 'EventsController');  
■コントローラー作成  
php artisan make:controller ArtistsController  
php artisan make:controller SongsController  
php artisan make:controller EventsController  
■シーダー  
php artisan make:seeder ArtistsTableSeeder  
php artisan make:seeder SongsTableSeeder  
