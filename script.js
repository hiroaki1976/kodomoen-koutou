function toggleMenu() {
  const hamburger = document.querySelector(".hamburger");
  const navigation = document.querySelector(".navigation");

  hamburger.classList.toggle("active");
  navigation.classList.toggle("active");
}

// メニュー項目クリック時にメニューを閉じる
document.querySelectorAll(".nav-item").forEach((item) => {
  item.addEventListener("click", () => {
    document.querySelector(".hamburger").classList.remove("active");
    document.querySelector(".navigation").classList.remove("active");
  });
});

// 郵便番号検索機能の初期化フラグ
let postalCodeSearchInitialized = false;
// 検索実行中フラグ
let isSearching = false;
// イベントリスナー設定済みフラグ
let eventListenerSet = false;
// 最後にクリックされた時刻
let lastClickTime = 0;

// 郵便番号検索機能
function searchAddress() {
  console.log('郵便番号検索開始 - 関数呼び出し回数:', (window.searchCallCount || 0) + 1);
  
  // 既に検索中の場合は即座に終了
  if (isSearching) {
    console.log('既に検索中のため、新しい検索を開始しません - 即座に終了');
    return;
  }
  
  // 連続実行を防ぐ（500ms以内の重複実行を無視）
  const currentTime = Date.now();
  if (currentTime - lastClickTime < 500) {
    console.log('連続実行を検出しました。無視します。');
    return;
  }
  
  window.searchCallCount = (window.searchCallCount || 0) + 1;
  
  // 検索開始フラグを設定
  isSearching = true;
  console.log('検索開始フラグを設定しました - isSearching:', isSearching);
  
  // Contact Form 7のフィールド名に合わせて検索
  let postalCodeInput = document.querySelector('input[name="your-zipcode"]');
  let address1Input = document.querySelector('input[name="your-address1"]');
  
  // フィールドが見つからない場合、少し待ってから再試行
  if (!postalCodeInput || !address1Input) {
    console.log('フィールドが見つかりません。再試行中...');
    isSearching = false; // フラグをリセット
    console.log('フィールド未発見でフラグをリセット - isSearching:', isSearching);
    setTimeout(() => {
      searchAddress();
    }, 200);
    return;
  }

  const postalCode = postalCodeInput.value.replace(/[^\d]/g, ''); // 数字以外を除去
  
  if (postalCode.length !== 7) {
    console.log('郵便番号エラー: 7桁ではありません');
    isSearching = false; // フラグをリセット
    console.log('郵便番号エラーでフラグをリセット - isSearching:', isSearching);
    alert('郵便番号は7桁で入力してください');
    return;
  }

  // 検索ボタンを無効化
  const searchBtn = document.querySelector('.search-btn');
  if (!searchBtn) {
    console.error('検索ボタンが見つかりません');
    isSearching = false; // フラグをリセット
    console.log('検索ボタン未発見でフラグをリセット - isSearching:', isSearching);
    return;
  }
  
  // 元のテキストを確実に保存
  const originalText = searchBtn.textContent || '検索';
  searchBtn.textContent = '検索中...';
  searchBtn.disabled = true;
  
  console.log('検索ボタンを無効化しました。元のテキスト:', originalText);

  // タイムアウトを設定（10秒）
  const timeoutId = setTimeout(() => {
    console.log('検索タイムアウト');
    searchBtn.textContent = originalText;
    searchBtn.disabled = false;
    isSearching = false; // フラグをリセット
    console.log('タイムアウトでフラグをリセット - isSearching:', isSearching);
    console.log('タイムアウトエラー: 検索がタイムアウトしました');
    alert('検索がタイムアウトしました。しばらく時間をおいて再度お試しください。');
  }, 10000);

  // 郵便番号APIを使用して住所を取得
  fetch(`https://zipcloud.ibsnet.co.jp/api/search?zipcode=${postalCode}`)
    .then(response => {
      console.log('APIレスポンス受信:', response.status);
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      console.log('APIデータ受信:', data);
      clearTimeout(timeoutId); // タイムアウトをクリア
      
      if (data.status === 200 && data.results && data.results.length > 0) {
        const address = data.results[0];
        
        // 全ての住所を住所1フィールドに設定
        if (address1Input) {
          const fullAddress = `${address.address1}${address.address2}${address.address3 || ''}`;
          address1Input.value = fullAddress;
        }
        
        console.log('住所を取得しました:', address);
      } else {
        console.log('住所が見つかりませんでした:', data);
        console.log('住所未発見エラー: 該当する住所が見つかりませんでした');
        alert('該当する住所が見つかりませんでした');
      }
    })
    .catch(error => {
      console.error('住所検索エラー:', error);
      clearTimeout(timeoutId); // タイムアウトをクリア
      console.log('ネットワークエラー: 住所の取得に失敗しました');
      alert('住所の取得に失敗しました。しばらく時間をおいて再度お試しください。');
    })
    .finally(() => {
      // 検索ボタンを元に戻す（確実に実行されるように）
      console.log('検索完了。ボタンを元に戻します。元のテキスト:', originalText);
      searchBtn.textContent = originalText;
      searchBtn.disabled = false;
      isSearching = false; // フラグをリセット
      console.log('検索完了でフラグをリセット - isSearching:', isSearching);
    });
}

// 郵便番号入力時の自動検索（無効化）
function setupPostalCodeAutoSearch() {
  console.log('setupPostalCodeAutoSearch 呼び出し - 初期化フラグ:', postalCodeSearchInitialized, 'イベントリスナー設定済み:', eventListenerSet);
  
  // 既に初期化済みの場合は実行しない
  if (postalCodeSearchInitialized && eventListenerSet) {
    console.log('郵便番号検索機能は既に初期化済みです');
    return;
  }
  
  // 自動検索は無効化（ボタンクリックのみで検索）
  console.log('郵便番号自動検索は無効化されています。ボタンをクリックして検索してください。');
  
  // 検索ボタンにイベントリスナーを追加
  const searchBtn = document.querySelector('.search-btn');
  if (searchBtn) {
    console.log('検索ボタンが見つかりました。イベントリスナーを設定します。');
    
    // 既存のイベントリスナーを全て削除（重複を防ぐため）
    const newSearchBtn = searchBtn.cloneNode(true);
    searchBtn.parentNode.replaceChild(newSearchBtn, searchBtn);
    
    // 新しいイベントリスナーを追加
    newSearchBtn.addEventListener('click', function(e) {
      console.log('検索ボタンクリックイベント発火');
      
      // イベントの重複実行を防ぐ
      e.preventDefault();
      e.stopPropagation();
      e.stopImmediatePropagation();
      
      // 連続クリックを防ぐ（500ms以内の重複クリックを無視）
      const currentTime = Date.now();
      if (currentTime - lastClickTime < 500) {
        console.log('連続クリックを検出しました。無視します。');
        return;
      }
      lastClickTime = currentTime;
      
      // 既に検索中の場合は実行しない
      if (newSearchBtn.disabled || isSearching) {
        console.log('既に検索中のため、新しい検索を開始しません - disabled:', newSearchBtn.disabled, 'isSearching:', isSearching);
        return;
      }
      
      console.log('searchAddress関数を呼び出します');
      searchAddress();
    });
    
    console.log('検索ボタンのイベントリスナー設定完了');
    
    // 初期化完了フラグを設定
    postalCodeSearchInitialized = true;
    eventListenerSet = true;
    console.log('初期化フラグをtrueに設定しました - イベントリスナー設定済み:', eventListenerSet);
  } else {
    console.log('検索ボタンが見つかりません');
  }
}

// GSAP初期化関数
function initGSAP() {
  console.log('=== GSAP初期化開始 ===');
  console.log('window.gsap:', typeof window.gsap);
  console.log('window.ScrollTrigger:', typeof window.ScrollTrigger);
  console.log('gsap:', typeof gsap);
  console.log('ScrollTrigger:', typeof ScrollTrigger);
  
  // グローバル変数としても確認
  console.log('windowオブジェクトにgsapがあるか:', 'gsap' in window);
  console.log('windowオブジェクトにScrollTriggerがあるか:', 'ScrollTrigger' in window);
  
  if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
    console.log('GSAPライブラリが読み込まれています');
    gsap.registerPlugin(ScrollTrigger);

    const fadeUpElements = gsap.utils.toArray(".fade-up");
    const fadeUp2Elements = gsap.utils.toArray(".fade-up-2");
    const fadeUp3Elements = gsap.utils.toArray(".fade-up-3");
    
    console.log('fade-up要素数:', fadeUpElements.length);
    console.log('fade-up-2要素数:', fadeUp2Elements.length);
    console.log('fade-up-3要素数:', fadeUp3Elements.length);

    fadeUpElements.forEach((element, index) => {
        console.log(`fade-up要素${index + 1}:`, element);
        gsap.fromTo(
            element,
            { opacity: 0, y: 100 },
            {
                opacity: 1,
                y: 0,
                duration: 1,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: element,
                    start: "top 80%",
                    end: "top 20%",
                    toggleActions: "play none none none",
                },
            }
        );
    });

    fadeUp2Elements.forEach((element, index) => {
        console.log(`fade-up-2要素${index + 1}:`, element);
        gsap.fromTo(
            element,
            { opacity: 0, y: 100 },
            {
                opacity: 1,
                y: 0,
                duration: 2,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: element,
                    start: "top 80%",
                    end: "top 20%",
                    toggleActions: "play none none none",
                },
            }
        );
    });

    fadeUp3Elements.forEach((element, index) => {
        console.log(`fade-up-3要素${index + 1}:`, element);
        gsap.fromTo(
            element,
            { opacity: 0, y: 100 },
            {
                opacity: 1,
                y: 0,
                duration: 3,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: element,
                    start: "top 80%",
                    end: "top 20%",
                    toggleActions: "play none none none",
                },
          }
        );
    });
    
    console.log('GSAPアニメーション設定完了');
  } else {
    console.log('GSAPライブラリが読み込まれていません');
    console.log('gsapの型:', typeof gsap);
    console.log('ScrollTriggerの型:', typeof ScrollTrigger);
  }
  console.log('=== GSAP初期化終了 ===');
}

document.addEventListener("DOMContentLoaded", function () {
  console.log('=== DOMContentLoaded イベント発火 ===');
  
  // 郵便番号自動検索の設定
  console.log('郵便番号検索機能初期化開始');
  
  // フォームフィールドの存在確認
  const postalCodeInput = document.querySelector('input[name="your-zipcode"]');
  const address1Input = document.querySelector('input[name="your-address1"]');
  
  if (postalCodeInput && address1Input) {
    console.log('フォームフィールドが見つかりました');
    setupPostalCodeAutoSearch();
  } else {
    console.log('フォームフィールドが見つかりません。Contact Form 7の読み込みを待機中...');
  }
  
  // Contact Form 7の動的読み込みに対応
  if (typeof wpcf7 !== 'undefined' && typeof wpcf7.addEventListener === 'function') {
    console.log('Contact Form 7のイベントリスナー設定開始');
    
    // フォーム読み込み完了時に郵便番号検索機能を設定（一度だけ）
    if (!postalCodeSearchInitialized || !eventListenerSet) {
      console.log('wpcf7:readyイベントリスナーを設定します');
      wpcf7.addEventListener('wpcf7:ready', function(event) {
        console.log('Contact Form 7 読み込み完了イベント発火');
        setTimeout(setupPostalCodeAutoSearch, 100);
      });
    } else {
      console.log('既に初期化済みのため、wpcf7:readyイベントリスナーは設定しません');
    }
    
    // フォーム送信後に郵便番号検索機能を再設定（送信後のみ）
    console.log('wpcf7:mailsentイベントリスナーを設定します');
    wpcf7.addEventListener('wpcf7:mailsent', function(event) {
      console.log('Contact Form 7 送信完了イベント発火');
      // 送信後は初期化フラグをリセットして再設定を許可
      postalCodeSearchInitialized = false;
      eventListenerSet = false;
      console.log('初期化フラグをリセットしました - イベントリスナー設定済み:', eventListenerSet);
      setTimeout(setupPostalCodeAutoSearch, 100);
    });
  } else {
    console.log('Contact Form 7のイベントリスナーが利用できません');
  }

  // GSAPライブラリの読み込み確認
  console.log('GSAPライブラリ読み込み確認開始');
  console.log('window.gsap:', typeof window.gsap);
  console.log('window.ScrollTrigger:', typeof window.ScrollTrigger);
  console.log('document.querySelector("script[src*=\'gsap\']"):', document.querySelector("script[src*='gsap']"));
  console.log('document.querySelector("script[src*=\'ScrollTrigger\']"):', document.querySelector("script[src*='ScrollTrigger']"));
  
  // GSAP初期化を少し遅延させて実行
  console.log('GSAP初期化を100ms後に実行予定');
  
  // GSAPライブラリが読み込まれるまで待機
  function waitForGSAP() {
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
      console.log('GSAPライブラリが読み込まれました');
      initGSAP();
    } else {
      console.log('GSAPライブラリを待機中...');
      setTimeout(waitForGSAP, 100);
    }
  }
  
  setTimeout(waitForGSAP, 100);
});
