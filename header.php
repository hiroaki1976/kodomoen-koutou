<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style1.css" />
    <?php wp_head(); ?>
  </head>
  <body>
    <?php wp_body_open(); ?>
    <!-- ヘッダー -->
    <div class="top">
      <header class="header">
        <div class="logo-container">
          <a href="<?php echo home_url(); ?>" class="logo-link">
            <img src="<?php echo get_template_directory_uri(); ?>/img3/koutou_logo.png" alt="Kou Tou Logo" class="logo" />
            <div class="school-name">
              <h2>学校法人早坂学園</h2>
              <h1>
                認定こども園 <ruby>幌東<rt>こうとう</rt></ruby>
              </h1>
            </div>
          </a>
        </div>
        <div class="buttons">
          <a href="<?php echo home_url(); ?>?page_id=29" class="btn">COCOroom</a>
          <a href="<?php echo home_url(); ?>?page_id=27" class="btn">入園のご案内</a>
		      <a href="<?php echo home_url(); ?>?page_id=103" class="btn">未就園児/子育て支援</a>
        </div>
      </header>

      <!-- ハンバーガーメニューボタン -->
      <button class="hamburger" onclick="toggleMenu()">
        <span></span>
        <span></span>
        <span></span>
      </button>

      <nav class="navigation" id="navigation">
        <!-- 既存のナビゲーション項目 -->
        <a href="<?php echo home_url(); ?>#policy" class="nav-item">教育方針</a>
        <a href="<?php echo home_url(); ?>#features" class="nav-item">園の特色</a>
        <a href="<?php echo home_url(); ?>#principal-greeting" class="nav-item">園長挨拶</a>
        <a href="<?php echo home_url(); ?>#daily-life" class="nav-item">園での生活</a>
        <a href="<?php echo home_url(); ?>#contact" class="nav-item">お問い合わせ</a>
      </nav>
    </div>