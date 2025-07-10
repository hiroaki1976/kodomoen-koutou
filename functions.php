<?php
/**
 * <title>タグを出力する
 */
 add_theme_support('title-tag');

 /**
 * 投稿のサムネイルを有効にする
 */
add_theme_support('post-thumbnails');

 /**
 * <title>の区切り文字を変更する
 */
add_filter('document_title_separator', 'my_document_title_separator');
function my_document_title_separator($separator) {
    $separator = '|';
    return $separator;
}

/**
 * Font Awesomeを読み込む
 */
function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');

/**
 * JavaScriptファイルを読み込む（GSAP設定で統合）
 */
// function enqueue_custom_scripts() {
//     wp_enqueue_script('kodomoen-koutou', get_template_directory_uri() . '/script.js', array(), '1.0.0', true);
// }
// add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

/**
 * メインループの投稿数を設定（トップページのみ）
 */
function set_posts_per_page($query) {
    if (!is_admin() && $query->is_main_query() && is_home()) {
        $query->set('posts_per_page', 10);
    }
}
add_action('pre_get_posts', 'set_posts_per_page');

/**
 * カスタムページテンプレートを登録
 */
function register_custom_page_templates($templates) {
    $templates['page-admission.php'] = '入園案内';
    $templates['page-cocoroom.php'] = 'COCO room';
    return $templates;
}
add_filter('theme_page_templates', 'register_custom_page_templates');

/**
 * Contact Form 7の時には整形機能をOFFにする
 */
add_filter('wpcf7_autop_or_not', 'my_wpcf7_autop');
function my_wpcf7_autop() {
    return false;
};

/**
 * GSAPを読み込む
 */
// The proper way to enqueue GSAP script in WordPress

// wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
function theme_gsap_script(){
    // The core GSAP library - より確実な読み込みのため
    wp_enqueue_script( 'gsap-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.7/gsap.min.js', array(), '3.12.7', false );
    // ScrollTrigger - with gsap.js passed as a dependency
    wp_enqueue_script( 'gsap-st', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.7/ScrollTrigger.min.js', array('gsap-js'), '3.12.7', false );
    // Your animation code file - with gsap.js passed as a dependency
    wp_enqueue_script( 'gsap-js2', get_stylesheet_directory_uri() . '/script.js', array('gsap-js', 'gsap-st'), '1.0.3', true );
}

add_action( 'wp_enqueue_scripts', 'theme_gsap_script' );

/**
 * 投稿画面のカテゴリーをラジオボタン化
 */
// カテゴリーをラジオボタン化するためのメタボックスを追加
function add_category_radio_meta_box() {
    add_meta_box(
        'category-radio',
        'カテゴリー',
        'category_radio_meta_box_callback',
        'post',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'add_category_radio_meta_box', 10);

// カテゴリーラジオボタンメタボックスの表示
function category_radio_meta_box_callback($post) {
    $categories = get_categories(array(
        'hide_empty' => false,
        'orderby' => 'name',
        'order' => 'ASC'
    ));
    
    $selected_categories = wp_get_object_terms($post->ID, 'category', array('fields' => 'ids'));
    $selected_category = !empty($selected_categories) ? $selected_categories[0] : 0;
    
    wp_nonce_field('category_radio_meta_box', 'category_radio_meta_box_nonce');
    ?>
    <div class="category-radio-container">
        <p><strong>カテゴリーを選択してください：</strong></p>
        <?php if (!empty($categories)) : ?>
            <?php foreach ($categories as $category) : ?>
                <label style="display: block; margin-bottom: 8px;">
                    <input type="radio" 
                           name="post_category_radio" 
                           value="<?php echo esc_attr($category->term_id); ?>"
                           <?php checked($selected_category, $category->term_id); ?> />
                    <?php echo esc_html($category->name); ?>
                </label>
            <?php endforeach; ?>
        <?php else : ?>
            <p>カテゴリーがありません。</p>
        <?php endif; ?>
    </div>
    <?php
}

// カテゴリー選択を保存
function save_category_radio_meta_box($post_id) {
    // セキュリティチェック
    if (!isset($_POST['category_radio_meta_box_nonce']) || 
        !wp_verify_nonce($_POST['category_radio_meta_box_nonce'], 'category_radio_meta_box')) {
        return;
    }
    
    // 自動保存の場合は処理しない
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // 権限チェック
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // カテゴリー選択を保存
    if (isset($_POST['post_category_radio'])) {
        $category_id = intval($_POST['post_category_radio']);
        if ($category_id > 0) {
            wp_set_object_terms($post_id, $category_id, 'category');
        }
    }
}
add_action('save_post', 'save_category_radio_meta_box');

// デフォルトのカテゴリーメタボックスを非表示にする
function hide_default_category_meta_box() {
    remove_meta_box('categorydiv', 'post', 'side');
}
// 複数のフックで確実に削除
add_action('admin_init', 'hide_default_category_meta_box');
add_action('add_meta_boxes', 'hide_default_category_meta_box', 999);
add_action('admin_menu', 'hide_default_category_meta_box');

// CSSでデフォルトのカテゴリーメタボックスをより強力に非表示にする
function hide_category_meta_box_css() {
    $screen = get_current_screen();
    if ($screen && $screen->base === 'post' && $screen->post_type === 'post') {
        echo '<style>
            #categorydiv, 
            #categorydiv.categorydiv, 
            #side-sortables #categorydiv, 
            .edit-post-taxonomies__hierarchical-terms-list, 
            .editor-post-taxonomies__hierarchical-terms-list, 
            .components-panel__body[data-title="カテゴリー"],
            .components-panel__body > .components-panel__body-title {
                display: none !important;
            }
        </style>';
    }
}
add_action('admin_head', 'hide_category_meta_box_css');
