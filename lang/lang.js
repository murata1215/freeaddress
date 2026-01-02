/**
 * FreeAddress 多言語化スクリプト
 * HTMLページ用の言語切り替え機能
 */

const Lang = {
    currentLang: 'ja',
    translations: {},
    supportedLangs: ['ja', 'en'],

    /**
     * 初期化
     */
    async init() {
        // URLパラメータまたはlocalStorageから言語を取得
        const urlParams = new URLSearchParams(window.location.search);
        const urlLang = urlParams.get('lang');
        const storedLang = localStorage.getItem('freeaddress_lang');

        if (urlLang && this.supportedLangs.includes(urlLang)) {
            this.currentLang = urlLang;
        } else if (storedLang && this.supportedLangs.includes(storedLang)) {
            this.currentLang = storedLang;
        } else {
            // ブラウザの言語設定を確認
            const browserLang = navigator.language.split('-')[0];
            if (this.supportedLangs.includes(browserLang)) {
                this.currentLang = browserLang;
            }
        }

        // 言語ファイルを読み込み
        await this.loadTranslations(this.currentLang);

        // ページを翻訳
        this.translatePage();

        // 言語切り替えボタンを設置
        this.addLanguageSwitcher();

        // localStorageに保存
        localStorage.setItem('freeaddress_lang', this.currentLang);
    },

    /**
     * 言語ファイルを読み込み
     */
    async loadTranslations(lang) {
        try {
            const response = await fetch(`lang/${lang}.json`);
            if (!response.ok) throw new Error('Failed to load language file');
            this.translations = await response.json();
        } catch (error) {
            console.error('Error loading translations:', error);
            // フォールバック：日本語
            if (lang !== 'ja') {
                await this.loadTranslations('ja');
            }
        }
    },

    /**
     * 翻訳を取得
     * @param {string} key - ドット区切りのキー (例: "common.home")
     * @returns {string} 翻訳テキスト
     */
    t(key) {
        const keys = key.split('.');
        let value = this.translations;

        for (const k of keys) {
            if (value && typeof value === 'object' && k in value) {
                value = value[k];
            } else {
                return key; // キーが見つからない場合はキーをそのまま返す
            }
        }

        return value;
    },

    /**
     * ページ全体を翻訳
     */
    translatePage() {
        // data-i18n属性を持つ要素を翻訳
        document.querySelectorAll('[data-i18n]').forEach(el => {
            const key = el.getAttribute('data-i18n');
            const translation = this.t(key);

            if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
                if (el.getAttribute('placeholder')) {
                    el.placeholder = translation;
                } else {
                    el.value = translation;
                }
            } else {
                el.innerHTML = translation;
            }
        });

        // data-i18n-placeholder属性（プレースホルダー用）
        document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
            const key = el.getAttribute('data-i18n-placeholder');
            el.placeholder = this.t(key);
        });

        // data-i18n-title属性（title属性用）
        document.querySelectorAll('[data-i18n-title]').forEach(el => {
            const key = el.getAttribute('data-i18n-title');
            el.title = this.t(key);
        });

        // HTML lang属性を更新
        document.documentElement.lang = this.currentLang;
    },

    /**
     * 言語切り替えボタンを追加
     */
    addLanguageSwitcher() {
        // 既存のスイッチャーがあれば削除
        const existing = document.getElementById('lang-switcher');
        if (existing) existing.remove();

        // スイッチャーを作成
        const switcher = document.createElement('div');
        switcher.id = 'lang-switcher';
        switcher.innerHTML = `
            <button class="lang-btn ${this.currentLang === 'ja' ? 'active' : ''}" data-lang="ja">日本語</button>
            <button class="lang-btn ${this.currentLang === 'en' ? 'active' : ''}" data-lang="en">EN</button>
        `;

        // スタイルを追加
        const style = document.createElement('style');
        style.textContent = `
            #lang-switcher {
                position: fixed;
                top: 70px;
                right: 20px;
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
                transition: all 0.3s;
            }
            .lang-btn:hover {
                background: #e0e0e0;
            }
            .lang-btn.active {
                background: #3498db;
                color: white;
            }
            @media (max-width: 768px) {
                #lang-switcher {
                    top: 10px;
                    right: 10px;
                }
            }
        `;
        document.head.appendChild(style);

        // ボタンにイベントを設定
        switcher.querySelectorAll('.lang-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const lang = btn.getAttribute('data-lang');
                this.switchLanguage(lang);
            });
        });

        document.body.appendChild(switcher);
    },

    /**
     * 言語を切り替え
     */
    async switchLanguage(lang) {
        if (!this.supportedLangs.includes(lang)) return;

        this.currentLang = lang;
        localStorage.setItem('freeaddress_lang', lang);

        await this.loadTranslations(lang);
        this.translatePage();

        // ボタンのアクティブ状態を更新
        document.querySelectorAll('.lang-btn').forEach(btn => {
            btn.classList.toggle('active', btn.getAttribute('data-lang') === lang);
        });
    }
};

// DOMContentLoadedで初期化
document.addEventListener('DOMContentLoaded', () => {
    Lang.init();
});
