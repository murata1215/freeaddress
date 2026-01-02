<?php
/**
 * FreeAddress 多言語化スクリプト
 * PHPページ用の言語切り替え機能
 */

class Lang {
    private static $instance = null;
    private $currentLang = 'ja';
    private $translations = [];
    private $supportedLangs = ['ja', 'en'];

    private function __construct() {
        $this->detectLanguage();
        $this->loadTranslations();
    }

    /**
     * シングルトンインスタンスを取得
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 言語を検出
     */
    private function detectLanguage() {
        // URLパラメータから取得
        if (isset($_GET['lang']) && in_array($_GET['lang'], $this->supportedLangs)) {
            $this->currentLang = $_GET['lang'];
            setcookie('freeaddress_lang', $this->currentLang, time() + (365 * 24 * 60 * 60), '/');
            return;
        }

        // Cookieから取得
        if (isset($_COOKIE['freeaddress_lang']) && in_array($_COOKIE['freeaddress_lang'], $this->supportedLangs)) {
            $this->currentLang = $_COOKIE['freeaddress_lang'];
            return;
        }

        // ブラウザの言語設定から取得
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $browserLang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            if (in_array($browserLang, $this->supportedLangs)) {
                $this->currentLang = $browserLang;
            }
        }
    }

    /**
     * 言語ファイルを読み込み
     */
    private function loadTranslations() {
        $langFile = __DIR__ . '/' . $this->currentLang . '.json';

        if (file_exists($langFile)) {
            $json = file_get_contents($langFile);
            $this->translations = json_decode($json, true);
        } else {
            // フォールバック：日本語
            $fallbackFile = __DIR__ . '/ja.json';
            if (file_exists($fallbackFile)) {
                $json = file_get_contents($fallbackFile);
                $this->translations = json_decode($json, true);
            }
        }
    }

    /**
     * 翻訳を取得
     * @param string $key ドット区切りのキー (例: "common.home")
     * @return string 翻訳テキスト
     */
    public function t($key) {
        $keys = explode('.', $key);
        $value = $this->translations;

        foreach ($keys as $k) {
            if (is_array($value) && isset($value[$k])) {
                $value = $value[$k];
            } else {
                return $key; // キーが見つからない場合はキーをそのまま返す
            }
        }

        return $value;
    }

    /**
     * 現在の言語を取得
     */
    public function getCurrentLang() {
        return $this->currentLang;
    }

    /**
     * サポートされている言語一覧を取得
     */
    public function getSupportedLangs() {
        return $this->supportedLangs;
    }

    /**
     * 言語切り替えボタンのHTMLを出力
     */
    public function renderSwitcher() {
        $html = '<div id="lang-switcher">';
        $html .= '<a href="?lang=ja" class="lang-btn ' . ($this->currentLang === 'ja' ? 'active' : '') . '">日本語</a>';
        $html .= '<a href="?lang=en" class="lang-btn ' . ($this->currentLang === 'en' ? 'active' : '') . '">EN</a>';
        $html .= '</div>';

        $html .= '<style>
            #lang-switcher {
                position: fixed;
                top: 10px;
                right: 10px;
                z-index: 1001;
                display: flex;
                gap: 5px;
                background: white;
                padding: 5px;
                border-radius: 20px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.15);
            }
            .lang-btn {
                padding: 6px 12px;
                border: none;
                border-radius: 15px;
                cursor: pointer;
                font-size: 12px;
                font-weight: 600;
                background: #f0f0f0;
                color: #666;
                text-decoration: none;
                transition: all 0.3s;
            }
            .lang-btn:hover {
                background: #e0e0e0;
            }
            .lang-btn.active {
                background: #3498db;
                color: white;
            }
        </style>';

        return $html;
    }

    /**
     * 言語切り替え時にURLパラメータを保持するヘルパー
     */
    public function buildUrl($params = []) {
        $currentParams = $_GET;
        $currentParams['lang'] = $this->currentLang;
        $mergedParams = array_merge($currentParams, $params);
        return '?' . http_build_query($mergedParams);
    }
}

/**
 * グローバル関数：翻訳を取得
 */
function __($key) {
    return Lang::getInstance()->t($key);
}

/**
 * グローバル関数：翻訳を出力
 */
function _e($key) {
    echo Lang::getInstance()->t($key);
}
?>
