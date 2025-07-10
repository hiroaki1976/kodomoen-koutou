<?php get_header(); ?>

<div style="max-width: 800px; margin: 0 auto; padding: 20px;">
    <?php 
    // 現在の投稿IDを取得
    $post_id = get_queried_object_id();
    
    // 投稿データを直接取得
    $post = get_post($post_id);
    
    if ($post) : ?>
        <article id="post-<?php echo $post->ID; ?>" class="single-post post-<?php echo $post->ID; ?>">
            <!-- 投稿ヘッダー -->
            <div class="post-header">
                <div class="post-meta">
                    <div class="post-date"><?php echo get_the_date('Y年m月d日', $post->ID); ?></div>
                    <div class="post-category">
                        <?php
                        $categories = get_the_category($post->ID);
                        if (!empty($categories)) {
                            echo '<span class="category-label">カテゴリー:</span> ';
                            foreach ($categories as $category) {
                                echo '<span class="category-name">' . $category->name . '</span>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <h1 class="post-title"><?php echo $post->post_title; ?></h1>
            </div>

            <!-- 投稿内容 -->
            <div class="post-content">
                <?php if (has_post_thumbnail($post->ID)) : ?>
                    <div class="post-thumbnail">
                        <?php echo get_the_post_thumbnail($post->ID, 'large'); ?>
                           </div>
                <?php endif; ?>
                
                <div class="post-body">
                    <?php echo apply_filters('the_content', $post->post_content); ?>
                </div>
            </div>

            <!-- 投稿フッター -->
            <div class="post-footer">
                <div class="post-navigation">
                    <div class="nav-previous">
                        <?php previous_post_link('%link', '← 前の記事: %title'); ?>
                    </div>
                    <div class="nav-next">
                        <?php next_post_link('%link', '次の記事: %title →'); ?>
                    </div>
                </div>
                
                <div class="back-to-top">
                    <a href="<?php echo home_url(); ?>" class="back-link">← トップページに戻る</a>
                </div>
            </div>
        </article>
    <?php else : ?>
        <div class="no-post">
            <h2>記事が見つかりません</h2>
            <p>お探しの記事は存在しないか、削除された可能性があります。</p>
            <a href="<?php echo home_url(); ?>" class="back-link">トップページに戻る</a>
        </div>
    <?php endif; ?>
</div>

<style>
.single-post-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Hiragino Kaku Gothic ProN', 'Yu Gothic', 'Meiryo', sans-serif;
}

.single-post {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.post-header {
    background: #f8f9fa;
    color: #333;
    padding: 40px 30px;
    text-align: left;
    margin-top: 180px; /* ヘッダーとナビゲーションの下に隠れないようにマージンを追加 */
    border-bottom: 2px solid #e9ecef;
}

.post-meta {
    margin-bottom: 15px;
    font-size: 14px;
    color: #6c757d;
}

.post-date {
    margin-bottom: 10px;
    font-weight: normal;
}

.post-category {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.category-label {
    font-weight: normal;
    color: #6c757d;
}

.category-name {
    background: #9b2226;
    color: white;
    padding: 3px 8px;
    border-radius: 4px;
    font-size: 12px;
}

.post-title {
    font-size: 32px;
    font-weight: bold;
    line-height: 1.3;
    margin: 0;
    color: #333;
}

.post-content {
    padding: 30px;
}

.post-thumbnail {
    margin-bottom: 30px;
    text-align: center;
}

.post-thumbnail img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.post-body {
    line-height: 1.8;
    font-size: 16px;
}

.post-body h2 {
    color: #9b2226;
    font-size: 24px;
    margin: 40px 0 20px 0;
    padding-bottom: 10px;
    border-bottom: 3px solid #9b2226;
}

.post-body h3 {
    color: #d62828;
    font-size: 20px;
    margin: 30px 0 15px 0;
}

.post-body p {
    margin-bottom: 20px;
}

.post-body ul, .post-body ol {
    margin: 20px 0;
    padding-left: 30px;
}

.post-body li {
    margin-bottom: 10px;
}

.post-body blockquote {
    background: #f8f9fa;
    border-left: 4px solid #9b2226;
    padding: 20px;
    margin: 30px 0;
    font-style: italic;
}

.post-footer {
    background: #f8f9fa;
    padding: 30px;
    border-top: 1px solid #e9ecef;
}

.post-navigation {
    display: flex;
    justify-content: space-between;
    margin-bottom: 30px;
    gap: 20px;
}

.nav-previous, .nav-next {
    flex: 1;
}

.nav-previous a, .nav-next a {
    display: block;
    padding: 15px;
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    text-decoration: none;
    color: #495057;
    transition: all 0.3s ease;
}

.nav-previous a:hover, .nav-next a:hover {
    background: #9b2226;
    color: white;
    border-color: #9b2226;
}

.back-to-top {
    text-align: center;
}

.back-link {
    display: inline-block;
    padding: 12px 24px;
    background: #9b2226;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-weight: bold;
    transition: background 0.3s ease;
}

.back-link:hover {
    background: #d62828;
}

.no-post {
    text-align: center;
    padding: 60px 20px;
}

.no-post h2 {
    color: #9b2226;
    margin-bottom: 20px;
}

.no-post p {
    margin-bottom: 30px;
    color: #6c757d;
}

/* レスポンシブ対応 */
@media (max-width: 768px) {
    .single-post-container {
        padding: 10px;
    }
    
    .post-header {
        padding: 20px;
    }
    
    .post-title {
        font-size: 24px;
    }
    
    .post-content {
        padding: 20px;
    }
    
    .post-navigation {
        flex-direction: column;
    }
    
    .nav-previous, .nav-next {
        margin-bottom: 15px;
    }
}
</style>

<?php get_footer(); ?>
