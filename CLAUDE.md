# FreeAddress - プロジェクトガイド

## プロジェクト概要

オフィスのフリーアドレス座席管理システム。社員が出社時に座席を抽選し、座席状況をリアルタイムで共有できるWebアプリケーション。

## 技術スタック

- **言語**: PHP 8.x
- **データベース**: MySQL
- **ライブラリ**:
  - PhpSpreadsheet (Excel読み書き)
  - PHPMailer (メール送信)
- **パッケージ管理**: Composer

## ディレクトリ構造

```
freeaddress/
├── lang/                   # 多言語対応ファイル
│   ├── lang.php           # 言語クラス定義
│   ├── ja.json            # 日本語翻訳
│   └── en.json            # 英語翻訳
├── mail/                   # メール送信関連
├── PHPMailer/             # PHPMailerライブラリ
├── png/                    # 画像ファイル
├── upload/                 # アップロードされたExcelファイル
├── seat_*.php             # 座席管理機能のPHPファイル
├── framework_*.php        # 共通フレームワーク
├── index.html             # トップページ
├── howto.html             # 使い方ガイド
└── setup.html             # 登録・初期設定ガイド
```

## 主要ファイル

### 機能別PHPファイル
| ファイル | 機能 |
|---------|------|
| seat.php | メインメニュー画面 |
| seat_lottery.php/2.php | 座席抽選 |
| seat_away.php/2.php | 外出（離席）登録 |
| seat_result.php | 着席確認一覧 |
| seat_member.php | メンバー検索 |
| seat_seat.php | 座席表表示 |
| seat_regist.php/2.php | 利用者登録 |
| seat_manage.php/2.php | 管理者ページ |
| seat_upload.php/2.php | マスタアップロード |
| seat_password.php/2.php | パスワード変更 |
| seat_mailchange.php/2.php | メールアドレス変更 |
| seat_companychange.php/2.php | 会社名変更 |
| seat_owasure.php/2.php | パスワードリマインダー |

### フレームワークファイル
- `framework_head.php` - HTMLヘッダー前の共通処理（セッション、DB接続、ID取得）
- `framework_body.php` - ページヘッダー（会社名表示）
- `framework_tail.php` - フッター

## 多言語対応（i18n）

### 実装パターン
```php
<?php require "lang/lang.php"; ?>
<!doctype html>
<html lang="<?php echo Lang::getInstance()->getCurrentLang(); ?>">
```

### 翻訳関数
- `_e('key.name')` - 翻訳を直接出力
- `_g('key.name')` - 翻訳文字列を取得（PHP内で使用）

### 言語切替
```php
<?php echo Lang::getInstance()->renderSwitcher(); ?>
```

### 翻訳キーの構造
```json
{
  "セクション名": {
    "キー名": "翻訳テキスト"
  }
}
```
例: `seat.title`, `lottery.employeeNumber`, `manage.passwordChange`

## データベーススキーマ

主要テーブル:
- `seat` - 座席マスタ (id, seatid, mid, biko1, biko2, biko3)
- `member` - メンバーマスタ (id, mid, name, kana, phone, seat_range, biko1-3)
- `settei` - 設定テーブル (id, param, val)
- `result` - 抽選結果 (id, mid, seatid, ymd)

## コーディング規約

### PHP
- インデントはタブを使用
- 文字列はダブルクォート推奨
- SQLはシングルクォートで囲む
- 日本語コメントOK

### CSS
- CSS変数を使用（`:root`で定義）
- クラス名はケバブケース（例: `form-container`, `manage-btn-primary`）

### 多言語対応時の注意
- 新しいテキストを追加する際は、ja.jsonとen.json両方に追加
- キー名はドット区切りのセクション.キー形式
- HTMLタグを含む翻訳は`<br>`などそのまま記述可能

## 開発環境セットアップ

```bash
composer install
```

## セキュリティ注意事項

- SQLインジェクション対策が不十分な箇所あり（要改善）
- パスワードは平文保存（要改善）
- CSRFトークン未実装（要改善）
