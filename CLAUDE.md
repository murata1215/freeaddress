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
├── lang/                   # 多言語対応ファイル（5か国語）
│   ├── lang.php           # 言語クラス定義
│   ├── lang.js            # HTMLページ用言語切替
│   ├── ja.json            # 日本語翻訳
│   ├── en.json            # 英語翻訳
│   ├── zh.json            # 中国語（簡体字）翻訳
│   ├── ko.json            # 韓国語翻訳
│   └── es.json            # スペイン語翻訳
├── mail/                   # メール送信関連
├── PHPMailer/             # PHPMailerライブラリ
├── png/                    # 画像ファイル
├── upload/                 # アップロードされたExcelファイル
├── seat_*.php             # 座席管理機能のPHPファイル
├── framework_*.php        # 共通フレームワーク
├── index.html             # トップページ
├── howto.html             # 使い方ガイド
├── setup.html             # 登録・初期設定ガイド
├── privacy.html           # プライバシーポリシー
└── contact.html           # お問い合わせ（導入相談）
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
- 対応言語: 日本語(ja)、英語(en)、中国語簡体字(zh)、韓国語(ko)、スペイン語(es)
- 新しいテキストを追加する際は、5つの言語ファイル全てに追加
- キー名はドット区切りのセクション.キー形式
- HTMLタグを含む翻訳は`<br>`などそのまま記述可能
- 英語版では「Free Address」→「Hot Desking」に変更済み
- 中国語版は「共享工位」、韓国語版は「핫데스킹」、スペイン語版は「Hot Desking」を使用

### 言語別コンテンツ表示
日本語スクリーンショットなど、言語によって表示/非表示を切り替える場合：
```html
<div class="ja-only">日本語のみ表示</div>
<div class="non-ja-only">日本語以外で表示</div>
```
`lang/lang.js`の`updateLanguageVisibility()`で制御

## 開発環境セットアップ

```bash
composer install
```

## Google AdSense

### 導入済みページ
- index.html（Hero直後に広告ユニット）
- howto.html（headにスクリプトのみ）
- setup.html（headにスクリプトのみ）
- seat.php（headにスクリプトのみ）

### 広告コード
```html
<!-- headに配置 -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6340357703893137" crossorigin="anonymous"></script>

<!-- 広告ユニット（任意の位置に配置） -->
<div style="max-width:728px;margin:24px auto;text-align:center;">
    <ins class="adsbygoogle"
        style="display:block"
        data-ad-client="ca-pub-6340357703893137"
        data-ad-slot="1234567890"
        data-ad-format="auto"
        data-full-width-responsive="true"></ins>
    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
</div>
```

## お問い合わせ情報

- 会社名: 合同会社りぼん不動産
- 代表: 村田 圭助
- メール: fwjg2507@gmail.com

## セキュリティ注意事項

- SQLインジェクション対策が不十分な箇所あり（要改善）
- パスワードは平文保存（要改善）
- CSRFトークン未実装（要改善）
