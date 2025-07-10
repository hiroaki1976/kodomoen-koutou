<?php get_header(); ?>

<div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    <?php
    // 現在のカテゴリー情報を取得
    $category = get_queried_object();
    $category_name = $category->name;
    $category_slug = $category->slug;
    $category_description = $category->description;
    
    // ページネーション用
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    // カテゴリーの投稿を取得
    $category_query = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'category_name' => $category_slug,
        'posts_per_page' => 10,
        'paged' => $paged,
        'orderby' => 'date',
        'order' => 'DESC'
    ));
    ?>

    <!-- カテゴリーヘッダー -->
    <div class="category-header" style="margin-top: 180px; padding: 40px 0; text-align: center; background: #f8f9fa; border-radius: 8px; margin-bottom: 40px;">
        <h1 class="category-title" style="font-size: 36px; font-weight: bold; color: #333; margin-bottom: 15px;">
            <?php echo $category_name; ?>
        </h1>
        <?php if ($category_description) : ?>
            <p class="category-description" style="font-size: 16px; color: #6c757d; max-width: 600px; margin: 0 auto;">
                <?php echo $category_description; ?>
            </p>
        <?php endif; ?>
        
        <!-- 装飾ライン -->
        <div class="decoration-line">
            <div class="decoration-dot dot-blue"></div>
            <div class="decoration-dot dot-yellow"></div>
            <div class="decoration-dot dot-pink"></div>
            <div class="decoration-dot dot-blue"></div>
            <div class="decoration-dot dot-yellow"></div>
            <div class="decoration-dot dot-pink"></div>
        </div>
    </div>

    <!-- 投稿一覧 -->
    <?php if ($category_query->have_posts()) : ?>
        <div class="category-posts">
            <?php while ($category_query->have_posts()) : $category_query->the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('category-post-item'); ?> style="background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px; overflow: hidden; transition: transform 0.3s ease;">
                    
                    <!-- 投稿ヘッダー -->
                    <div class="post-header" style="padding: 25px 30px; border-bottom: 1px solid #e9ecef;">
                        <div class="post-meta" style="margin-bottom: 15px; font-size: 14px; color: #6c757d;">
                            <span class="post-date" style="font-weight: normal;">
                                <?php echo get_the_date('Y年m月d日'); ?>
                            </span>
                            <?php
                            $categories = get_the_category();
                            if ($categories) : ?>
                                <span class="post-categories" style="margin-left: 15px;">
                                    <?php foreach ($categories as $cat) : ?>
                                        <span class="category-tag" style="background: #9b2226; color: white; padding: 3px 8px; border-radius: 4px; font-size: 12px; margin-right: 5px;">
                                            <?php echo $cat->name; ?>
                                        </span>
                                    <?php endforeach; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <h2 class="post-title" style="font-size: 24px; font-weight: bold; margin: 0; line-height: 1.4;">
                            <a href="<?php the_permalink(); ?>" style="color: #333; text-decoration: none; transition: color 0.3s ease;">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                    </div>

                    <!-- 投稿内容 -->
                    <div class="post-content" style="padding: 25px 30px;">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail" style="margin-bottom: 20px; text-align: center;">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium', array('style' => 'max-width: 100%; height: auto; border-radius: 6px;')); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="post-excerpt" style="line-height: 1.6; color: #555; margin-bottom: 20px;">
                            <?php 
                            $excerpt = get_the_excerpt();
                            if ($excerpt) {
                                echo wp_trim_words($excerpt, 50, '...');
                            } else {
                                echo wp_trim_words(get_the_content(), 50, '...');
                            }
                            ?>
                        </div>
                        
                        <div class="read-more" style="text-align: right;">
                            <a href="<?php the_permalink(); ?>" style="display: inline-block; padding: 8px 16px; background: #9b2226; color: white; text-decoration: none; border-radius: 4px; font-size: 14px; transition: background 0.3s ease;">
                                続きを読む →
                            </a>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <!-- ページネーション -->
        <?php if ($category_query->max_num_pages > 1) : ?>
            <div class="pagination" style="text-align: center; margin: 40px 0;">
                <?php
                echo paginate_links(array(
                    'total' => $category_query->max_num_pages,
                    'current' => $paged,
                    'prev_text' => '← 前のページ',
                    'next_text' => '次のページ →',
                    'type' => 'list'
                ));
                ?>
            </div>
        <?php endif; ?>

    <?php else : ?>
        <div class="no-posts" style="text-align: center; padding: 60px 20px;">
            <h2 style="color: #9b2226; margin-bottom: 20px;">記事が見つかりません</h2>
            <p style="color: #6c757d; margin-bottom: 30px;">
                <?php echo $category_name; ?>カテゴリーの投稿はまだありません。
            </p>
            <a href="<?php echo home_url(); ?>" style="display: inline-block; padding: 12px 24px; background: #9b2226; color: white; text-decoration: none; border-radius: 6px; font-weight: bold;">
                トップページに戻る
            </a>
        </div>
    <?php endif; 
    wp_reset_postdata(); ?>

    <!-- 戻るボタン -->
    <div class="back-to-top" style="text-align: center; margin: 40px 0;">
        <a href="<?php echo home_url(); ?>" style="display: inline-block; padding: 12px 24px; background: #6c757d; color: white; text-decoration: none; border-radius: 6px; font-weight: bold; transition: background 0.3s ease;">
            ← トップページに戻る
        </a>
    </div>
</div>

<style>
.category-post-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}

.post-title a:hover {
    color: #9b2226;
}

.read-more a:hover {
    background: #d62828;
}

.back-to-top a:hover {
    background: #495057;
}

/* ページネーション */
.pagination ul {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.pagination li {
    list-style: none;
}

.pagination a,
.pagination span {
    display: inline-block;
    padding: 8px 12px;
    background-color: #f8f9fa;
    color: #333;
    text-decoration: none;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.pagination a:hover {
    background-color: #e9ecef;
    color: #333;
}

.pagination .current {
    background-color: #9b2226;
    color: white;
    border-color: #9b2226;
}

.pagination .prev,
.pagination .next {
    background-color: #9b2226;
    color: white;
    border-color: #9b2226;
}

.pagination .prev:hover,
.pagination .next:hover {
    background-color: #8a1a1f;
    border-color: #8a1a1f;
}

/* レスポンシブ対応 */
@media (max-width: 768px) {
    .category-header {
        margin-top: 100px;
        padding: 30px 20px;
    }
    
    .category-title {
        font-size: 28px;
    }
    
    .post-header {
        padding: 20px;
    }
    
    .post-title {
        font-size: 20px;
    }
    
    .post-content {
        padding: 20px;
    }
}
</style>

<?php get_footer(); ?> 