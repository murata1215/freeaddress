# freeaddress

オフィスのフリーアドレス（座席抽選・管理）システムです。社員が毎日の座席を抽選で決定し、座席状況の確認や外出管理などを行うことができます。

## 主な機能

- フリーアドレス座席の抽選機能
- 座席表の表示・確認
- 社員の着席状況確認
- 外出（席の開放）管理
- 利用者登録・パスワード管理
- 管理者ページ（座席マスタ管理、メンバー管理、Excel アップロード）
- メール通知機能（PHPMailer 使用）
- Excel ファイルのインポート/エクスポート（PhpSpreadsheet 使用）

## ディレクトリ構成

```
freeaddress/
├── composer.json          # Composer 依存関係定義
├── composer.lock          # 依存関係バージョンロック
├── .gitignore             # Git 除外設定
├── database.txt           # データベーススキーマ定義（SQL）
├── database_mysql.php     # MySQL データベース接続クラス
├── framework_head.php     # 共通ヘッダー（DB接続、パラメータクラス）
├── framework_body.php     # 共通ボディ（リクエストパラメータ処理）
├── framework_tail.php     # 共通フッター
├── seat.php               # メインメニュー画面
├── seat_lottery.php       # 座席抽選画面（社員番号入力）
├── seat_lottery2.php      # 座席抽選処理
├── seat_seat.php          # 座席表表示
├── seat_result.php        # 着席確認画面
├── seat_member.php        # メンバー一覧・検索
├── seat_away.php          # 外出登録画面
├── seat_away2.php         # 外出処理
├── seat_regist.php        # 利用者登録画面
├── seat_regist2.php       # 利用者登録処理
├── seat_manage.php        # 管理者ページ
├── seat_manage2.php       # 管理者処理
├── seat_upload.php        # Excel アップロード画面
├── seat_upload2.php       # Excel アップロード処理
├── seat_password.php      # パスワード変更画面
├── seat_password2.php     # パスワード変更処理
├── seat_mailchange.php    # メールアドレス変更画面
├── seat_mailchange2.php   # メールアドレス変更処理
├── seat_companychange.php # 会社名変更画面
├── seat_companychange2.php# 会社名変更処理
├── seat_owasure.php       # パスワード忘れ画面
├── seat_owasure2.php      # パスワード忘れ処理
├── info.php               # 情報表示
├── phpinfo.php            # PHP 情報表示
├── test.php               # テスト用
├── mail/                  # メール関連
│   └── framework_mail.php # メール送信クラス（PHPMailer ラッパー）
├── PHPMailer/             # PHPMailer ライブラリ（バンドル版）
│   ├── src/               # PHPMailer ソースコード
│   └── language/          # 多言語対応ファイル
├── vendor/                # Composer 依存パッケージ（gitignore）
└── upload/                # アップロードファイル保存先（gitignore）
```

### 重要ファイルの説明

| ファイル | 説明 |
|---------|------|
| `database_mysql.php` | MySQL 接続クラス。接続情報（ホスト、ユーザー、パスワード、DB名）を含む |
| `framework_head.php` | 全画面で読み込まれる共通ヘッダー。DB接続と設定パラメータクラスを定義 |
| `framework_body.php` | リクエストパラメータ（id, manage, password, dt）の取得処理 |
| `seat.php` | メインメニュー。ユーザーの権限に応じて表示を切り替え |
| `database.txt` | テーブル定義 SQL（alloc, member, seat, settei） |

## セットアップ手順

### 必要要件

- PHP 7.4 以上（推奨: PHP 8.0+）
- MySQL 5.7 以上
- Apache または Nginx（mod_rewrite 不要）
- Composer

### 必要な PHP 拡張

```
php-mysqli      # MySQL 接続
php-mbstring    # マルチバイト文字列処理
php-xml         # PhpSpreadsheet 用
php-zip         # PhpSpreadsheet 用（Excel ファイル処理）
php-gd          # PhpSpreadsheet 用（画像処理、オプション）
```

### インストール手順

1. リポジトリをクローン

```bash
git clone https://github.com/murata1215/freeaddress.git
cd freeaddress
```

2. Composer で依存パッケージをインストール

```bash
composer install
```

3. データベースを作成

```bash
mysql -u root -p
```

```sql
CREATE DATABASE freeaddress CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'freeuser'@'localhost' IDENTIFIED BY 'freepass';
GRANT ALL PRIVILEGES ON freeaddress.* TO 'freeuser'@'localhost';
FLUSH PRIVILEGES;
```

4. テーブルを作成

```bash
mysql -u freeuser -p freeaddress < database.txt
```

または MySQL クライアントで `database.txt` の内容を実行してください。

5. データベース接続設定を編集

`database_mysql.php` の接続情報を環境に合わせて変更：

```php
$this->mysqli = mysqli_connect("127.0.0.1", "freeuser", "freepass", "freeaddress");
```

6. Web サーバーの設定

Apache の場合、DocumentRoot をプロジェクトディレクトリに設定するか、VirtualHost を設定してください。

7. アクセス確認

ブラウザで以下の URL にアクセス：

```
http://localhost/seat.php?id=YOUR_COMPANY_ID
```

## 設定

### データベース接続設定

`database_mysql.php` で以下の接続情報を設定します：

| 項目 | デフォルト値 | 説明 |
|-----|-------------|------|
| ホスト | `127.0.0.1` | MySQL サーバーのホスト |
| ユーザー名 | `freeuser` | MySQL ユーザー名 |
| パスワード | `freepass` | MySQL パスワード |
| データベース名 | `freeaddress` | 使用するデータベース名 |

### メール設定

`mail/framework_mail.php` で SMTP 設定を行います：

| 項目 | 説明 |
|-----|------|
| `$host` | SMTP サーバーのホスト |
| `$mail->Port` | SMTP ポート（デフォルト: 25） |
| `$mail->SMTPAuth` | SMTP 認証の有無 |
| `$mail->Username` | SMTP ユーザー名（認証使用時） |
| `$mail->Password` | SMTP パスワード（認証使用時） |

### 環境変数（.env）

`.gitignore` に `.env` が含まれています。本番環境では環境変数を使用して機密情報を管理することを推奨します。

TODO: 現在のコードは環境変数に対応していません。本番運用時は `database_mysql.php` と `mail/framework_mail.php` を環境変数から読み込むように修正することを推奨します。

## データベーステーブル

| テーブル名 | 説明 |
|-----------|------|
| `alloc` | 座席割り当て情報（日付、社員ID、座席ID） |
| `member` | 社員マスタ（社員ID、名前、電話番号など） |
| `seat` | 座席マスタ（座席ID、備考など） |
| `settei` | 設定情報（会社名、メール設定などのパラメータ） |

## よくあるエラーと対処

### DB 接続エラー

**エラー**: `DBに接続できませんでした`

**原因と対処**:
- MySQL サーバーが起動しているか確認: `sudo systemctl status mysql`
- 接続情報（ホスト、ユーザー、パスワード、DB名）が正しいか確認
- MySQL ユーザーに適切な権限があるか確認
- ファイアウォールで MySQL ポート（3306）がブロックされていないか確認

### PHP 拡張エラー

**エラー**: `Class 'mysqli' not found` など

**対処**:
```bash
# Ubuntu/Debian
sudo apt-get install php-mysqli php-mbstring php-xml php-zip

# CentOS/RHEL
sudo yum install php-mysqli php-mbstring php-xml php-zip

# PHP 拡張を有効化後、Apache を再起動
sudo systemctl restart apache2  # または httpd
```

### 文字化け

**原因と対処**:
- MySQL の文字コードが `utf8mb4` になっているか確認
- `database_mysql.php` で `$this->mysqli->set_charset("utf8")` が設定されていることを確認
- HTML の `<meta charset="UTF-8">` が設定されていることを確認

### PhpSpreadsheet エラー

**エラー**: `Class 'PhpOffice\PhpSpreadsheet\...' not found`

**対処**:
```bash
composer install
```

### パーミッションエラー

**エラー**: アップロードファイルが保存できない

**対処**:
```bash
mkdir -p upload
chmod 755 upload
chown www-data:www-data upload  # Apache ユーザーに合わせて変更
```

### Apache 設定

**エラー**: 404 Not Found

**対処**:
- DocumentRoot が正しく設定されているか確認
- `.htaccess` が必要な場合は `AllowOverride All` を設定

## 開発フロー

### ブランチ運用

TODO: 現在のブランチ運用ルールは未定義です。以下は推奨例です：

- `main`: 本番環境用ブランチ
- `develop`: 開発用ブランチ
- `feature/*`: 機能追加用ブランチ
- `fix/*`: バグ修正用ブランチ

### プルリクエスト

1. `main` から新しいブランチを作成
2. 変更を実装
3. プルリクエストを作成
4. レビュー後にマージ

### テスト/チェック方法

TODO: 現在、自動テストは実装されていません。以下の手動テストを推奨します：

1. ローカル環境で動作確認
2. 主要な画面遷移をテスト
3. データベース操作（登録、更新、削除）の確認
4. Excel アップロード/ダウンロード機能の確認

### コーディング規約

TODO: コーディング規約は未定義です。以下を推奨します：

- PHP: PSR-12 に準拠
- インデント: タブまたはスペース 4 つ
- 文字コード: UTF-8

## ライセンス

TODO: ライセンスは未定義です。

依存ライブラリのライセンス:
- PHPMailer: LGPL 2.1
- PhpSpreadsheet: MIT

## 貢献

TODO: 貢献ガイドラインは未定義です。

## 参考リンク

- [PHPMailer ドキュメント](https://github.com/PHPMailer/PHPMailer)
- [PhpSpreadsheet ドキュメント](https://phpspreadsheet.readthedocs.io/)
