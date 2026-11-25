# AGENTS.md

このファイルは、AI コーディングエージェントがこのリポジトリ（`setlist`）で作業する際のプロジェクト概要・設計ルール・注意事項をまとめたものです。

## 1. プロジェクト概要

ライブ・イベントのセットリストを登録・検索・集計管理する Web アプリケーションです。

### 主な機能
- **イベント管理**: イベントの作成・編集・削除・一覧表示・キーワード/期間検索、閲覧注意（ネタバレ防止の折りたたみ表示）設定
- **セットリスト管理**: 1 イベントに対して複数アーティストのセットリスト（通常 / アンコール）を登録・編集・削除。ショート Ver・アレンジ種別・コラボアーティスト・他アーティスト楽曲のカバーに対応
- **アーティスト管理**: アーティストの登録・編集・削除・検索、イベント出演カレンダー表示
- **楽曲管理**: 楽曲の登録・編集・削除・検索、特定楽曲が演奏されたイベント一覧表示、Spotify API による楽曲マスタ一括取り込み
- **集計機能**: アーティストごとの期間指定による演奏回数・採用率・初回/最終演奏日の集計とソート表示
- **認証**: Twitter OAuth ログイン（閲覧・検索は未ログイン可、作成・編集・削除はログイン必須）

---

## 2. 技術スタック・動作環境

- **バックエンド**: PHP `^7.4` / Laravel `^6.0`
- **データベース**: MySQL（ローカル開発は Laravel Homestead 想定）
- **主要 Composer パッケージ**:
  - `laravel/socialite` (`^4.2`): Twitter OAuth 認証
  - `laravelcollective/html` (`^6.0`): Blade 内の `Form::*` / `link_to_route` 等の HTML ヘルパー
  - `jwilsson/spotify-web-api-php` (`^2.10`): Spotify API からの楽曲マスタ取得
  - `doctrine/dbal` (`^2.10`): マイグレーションでのカラム変更
  - `orangehill/iseed` (`^2.6`, dev): DB データから Seeder クラスを生成
  - `phpunit/phpunit` (`^8.0`, dev): テスト実行
- **フロントエンド**: Blade + Bootstrap 4 + jQuery（コンパイル済みの `public/css/app.css`, `public/js/app.js` を使用）。日付・時刻入力には `public/lib/` の `pickadate.js` を利用。
- **ロケール・タイムゾーン**: `ja` / `Asia/Tokyo`（`config/app.php`）

---

## 3. ディレクトリ構成と主要ファイル

```text
app/
  Artist.php, Event.php, Setlist.php, SetlistGroup.php, SetlistSong.php, Song.php, User.php
    # Eloquent モデル（Laravel 6 標準のため app/ 直下に配置）
  Http/
    Controllers/
      IndexController.php           # トップページ（過去の直近イベント一覧）
      EventsController.php          # イベント CRUD・検索、およびセットリスト CRUD（editSetlist/storeSetlist/destroySetlist）
      ArtistsController.php         # アーティスト CRUD・検索・出演カレンダー用データ生成
      SongsController.php           # 楽曲 CRUD・検索・演奏イベント一覧
      AggregateController.php       # アーティスト別の楽曲演奏回数・採用率集計
      GenerateMasterController.php  # Spotify API を使った楽曲マスタ自動取り込み
      Auth/SocialAuthController.php # Twitter OAuth ログイン・ログアウト
      SetlistsController.php        # ※未使用（routes/web.php に未登録の旧コード）
    Middleware/
      Authenticate.php              # 未認証アクセス時は HTTP 403 を返す
  Util/
    ConstantManager.php             # SimpleEnum, EventType, ArrangeType, 表示文字列・ページネーション定数
    TimeManager.php                 # 相対時間表示（convert_to_fuzzy_time）
routes/
  web.php                           # 全 Web ルート定義（auth ミドルウェアで編集系を保護）
database/
  migrations/                       # テーブル定義
  seeds/                            # AdminUsersSeeder および iseed 生成の各種テーブル Seeder
resources/
  views/                            # Blade テンプレート（layouts/app.blade.php を継承）
  lang/ja/validation.php            # 日本語バリデーションメッセージ
public/
  css/app.css, js/app.js            # ビルド済みフロントエンドアセット
  lib/                              # pickadate.js 本体・テーマ・日本語訳
tests/                              # PHPUnit テスト（現状は ExampleTest のみ）
```

---

## 4. データベース設計とドメインルール

### テーブルと主キー
- `artists`（主キー: `artist_id`）
- `songs`（主キー: `song_id`）
- `events`（主キー: `event_id`）
- `setlists`（主キー: `setlist_id`）— 1 イベントに複数アーティストが紐づく
- `setlist_groups`（複合ユニーク: `setlist_id`, `setlist_group_seq`）— `0`: 通常、`1`: アンコール
- `setlist_songs`（主キーなし、`setlist_id` / `setlist_group_seq` / `seq` で管理）
- `users`（主キー: `id`、`twitter_id` / `screen_name` にユニーク制約）

### 重要な仕様・注意点
1. **カスタム主キー**: `User` 以外の主要モデルは `id` ではなく `artist_id` / `song_id` / `event_id` / `setlist_id` を主キーとして使用しています。
2. **SoftDeletes の挙動**: マイグレーションには `softDeletes()`（`deleted_at` カラム）が定義されていますが、各 Eloquent モデルに `use SoftDeletes;` トレイトは未適用です。現状の `delete()` は物理削除として動作するため、変更時は影響範囲に注意してください。
3. **セットリスト曲の保存方式**: `EventsController::storeSetlist()` では、対象 `setlist_id` の `setlist_songs` を一度全削除してから `SetlistSong::insert()` で一括再登録します。
4. **カラム名と画面仕様の差異**:
   - `setlist_songs.is_medley`: DB カラム名は `is_medley` ですが、現在のフォーム・表示では「ショート Ver か（`is_short` / `(short.ver)`）」として扱われています。
   - `setlist_songs.collabo_artist_ids`: カンマ区切りの `artist_id` 文字列です。`0` は全員コラボを意味し、画面入力・表示では `'ALL'` として扱います。
5. **カバー曲の表現**: 対象アーティスト以外の楽曲（`song.artist_id != setlist.artist_id`）は、画面表示および入力候補上で `曲名(原曲アーティスト名)` 形式に整形して区別します。
6. **編集者記録（`edit_user_id`）**: 各データの最終編集者の `users.id` を保存します。`0` または該当ユーザーが見つからない場合は `'管理者'` と表示します。
7. **Enum 定数の拡張ルール（`app/Util/ConstantManager.php`）**:
   - `EventType` や `ArrangeType` の数値は DB に直接保存されています。既存値の数値変更・削除はデータ不整合を起こすため禁止です。新規追加は必ず既存の定義の下に連番で追加してください。
   - 既存定数名 `ArrangeType::ACOSTIC`（`ACOUSTIC` ではない）など既存綴りに注意してください。

---

## 5. 認証・外部サービス・環境設定

- **認証**: Twitter OAuth（`GET /auth/twitter`, `GET /auth/twitter/callback`, `GET /auth/twitter/logout`）のみ実装されています。未ログイン状態で `auth` ミドルウェア配下にアクセスすると 403 が返ります。
  - `SocialAuthController::redirectToProvider()` にローカル検証用の `$isDebug = false;` があります。変更した場合も絶対に `true` のままコミットしないでください。
- **Spotify API 連携**: `GenerateMasterController`（`/generateMaster/{artist_id}`）で Spotify API から楽曲マスタを取り込みます。`routes/web.php` には本番公開時にコメントアウトする旨の TODO があります。
- **環境変数**:
  - `.env` は `.gitignore` 対象です（`.env.example` が本番参考、`.env.local.example` がローカル Homestead 参考）。
  - API キーや DB パスワードなどの機密情報を新たにコードやサンプルファイルへ記述・コミットしないでください。
  - 必要な外部連携環境変数: `TWITTER_CLIENT_ID`, `TWITTER_CLIENT_SECRET`, `TWITTER_CALLBACK_URL`, `SPOTIFY_CLIENT_ID`, `SPOTIFY_CLIENT_SECRET`, `SPOTIFY_CALLBACK_URL`（`config/services.php` で参照）。

---

## 6. よく使うコマンド

```bash
# 依存パッケージのインストール
composer install
npm install

# マイグレーション・シード実行
php artisan migrate
php artisan db:seed

# PHPUnit テスト実行
vendor/bin/phpunit
# Windows 環境の場合:
vendor\bin\phpunit

# フロントエンドアセットのビルド（resources/js や resources/sass を変更した場合）
npm run dev
npm run prod
```

---

## 7. 開発・コーディング時のガイドライン

- **言語**: UI 文言、バリデーションメッセージ、コメントは日本語で統一してください。
- **スタイル・フォーマット**:
  - `.editorconfig`（UTF-8 / LF / 4 スペース）および `.styleci.yml`（Laravel プリセット、`alpha_ordered_imports` 有効）が配置されています。
  - ただし既存の PHP / Blade ファイルにはタブインデントが混在しています。修正時は対象ファイルの周辺インデントに合わせ、関係のない行の大規模な再フォーマットは避けてください。
- **コントローラー・モデルの設計方針**:
  - 既存モデルには Eloquent リレーション（`hasMany` / `belongsTo` 等）が定義されておらず、コントローラー内でクエリと配列整形を行う構造です。新規実装・リファクタリング時は既存のビューへ渡す `$param` / `$params` の配列構造を壊さないよう注意してください。
  - セットリスト関連の修正は未使用の `SetlistsController.php` ではなく `EventsController.php` を対象にしてください。
- **ビューの設計方針**:
  - すべてのページは `resources/views/layouts/app.blade.php` を継承します。
  - ページ固有の JavaScript / CSS はそれぞれ `@section('script')` / `@section('style')` に記述するのが既存パターンです。
  - フォームやリンクは既存の `laravelcollective/html`（`Form::*`, `link_to_route`）または標準 HTML / Blade のどちらを使っても構いませんが、同一ファイル内での一貫性を保ってください。
- **テスト・検証**:
  - 自動テストは現状ほぼ未整備です。変更時は PHP の構文チェック（`php -l <file>`）や、可能であれば関連する Feature / Unit テストの追加・実行を行ってください。
