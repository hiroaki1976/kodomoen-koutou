<?php get_header(); ?>

    <?php
    // newsカテゴリーの投稿を取得
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $news_query = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'paged' => $paged,
        'orderby' => 'date',
        'order' => 'DESC',
        'category_name' => 'news'
    ));
    ?>

    <!-- メインビジュアル -->
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <div class="main-visual fade-up">
      <div class="swiper main-swiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <img src="<?php echo get_template_directory_uri(); ?>/img/top1.jpg" alt="メインビジュアル1" />
            <div class="illustration-overlay">
              <h2 class="main-visual-text">愛情と学びで育む<br />心と未来の翼</h2>
            </div>
          </div>
          <div class="swiper-slide">
            <img src="<?php echo get_template_directory_uri(); ?>/img/top2.jpg" alt="メインビジュアル2" />
            <div class="illustration-overlay">
              <h2 class="main-visual-text">愛情と学びで育む<br />心と未来の翼</h2>
            </div>
          </div>
          <div class="swiper-slide">
            <img src="<?php echo get_template_directory_uri(); ?>/img/top3.jpg" alt="メインビジュアル3" />
            <div class="illustration-overlay">
              <h2 class="main-visual-text">愛情と学びで育む<br />心と未来の翼</h2>
            </div>
          </div>
          <div class="swiper-slide">
            <img src="<?php echo get_template_directory_uri(); ?>/img/top4.jpg" alt="メインビジュアル4" />
            <div class="illustration-overlay">
              <h2 class="main-visual-text">愛情と学びで育む<br />心と未来の翼</h2>
            </div>
          </div>
          <div class="swiper-slide">
            <img src="<?php echo get_template_directory_uri(); ?>/img/top5.jpg" alt="メインビジュアル5" />
            <div class="illustration-overlay">
              <h2 class="main-visual-text">愛情と学びで育む<br />心と未来の翼</h2>
            </div>
          </div>
        </div>
        <!-- ナビゲーションボタン -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <!-- ページネーション -->
        <div class="swiper-pagination"></div>
      </div>
    </div>

    <!-- お知らせ＆イベント -->
    <section id="news-events">
      <div class="news">
        <h2 class="section-title">おしらせ</h2>

        <div class="decoration-line">
          <div class="decoration-dot dot-blue"></div>
          <div class="decoration-dot dot-yellow"></div>
          <div class="decoration-dot dot-pink"></div>
          <div class="decoration-dot dot-blue"></div>
          <div class="decoration-dot dot-yellow"></div>
          <div class="decoration-dot dot-pink"></div>
        </div>

        <?php if ( $news_query->have_posts() ) : ?>
        <div class="news-container">
          <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class('news-item'); ?>>
              <div class="date"><?php the_time('Y/m/d'); ?></div>
              <a href="<?php the_permalink(); ?>" class="news-link">
                <div class="title"><?php the_title(); ?></div>
              </a>
            </div>
          <?php endwhile; ?>
        </div>
        <?php 
        wp_reset_postdata(); // ループをリセット
        else : ?>
        <div class="news-container">
          <div class="news-item">
            <div class="date">お知らせなし</div>
            <div class="title">お知らせの投稿がありません</div>
          </div>
        </div>
        <?php endif; ?>
        <div class="more-btn">
          <a href="<?php echo get_category_link(get_category_by_slug('news')->term_id); ?>">もっと見る</a>
        </div>
      </div>
      

      <div class="divider"></div>
      <div class="events">
        <h2 class="section-title">イベント</h2>

        <div class="decoration-line">
          <div class="decoration-dot dot-blue"></div>
          <div class="decoration-dot dot-yellow"></div>
          <div class="decoration-dot dot-pink"></div>
          <div class="decoration-dot dot-blue"></div>
          <div class="decoration-dot dot-yellow"></div>
          <div class="decoration-dot dot-pink"></div>
        </div>

        <?php
        // eventカテゴリーの投稿を取得
        $event_query = new WP_Query(array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'category_name' => 'event',
            'posts_per_page' => 3,
            'orderby' => 'date',
            'order' => 'DESC'
        ));
        
        if ( $event_query->have_posts() ) : ?>
        <div class="events-container">
          <?php while ( $event_query->have_posts() ) : $event_query->the_post(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class('news-event-item'); ?>>
              <div class="date"><?php the_time('Y/m/d'); ?></div>
              <a href="<?php the_permalink(); ?>" class="event-link">
                <div class="title"><?php the_title(); ?></div>
              </a>
            </div>
          <?php endwhile; ?>
        </div>
        <?php else : ?>
        <div class="events-container">
          <div class="news-event-item">
            <div class="date">イベントなし</div>
            <div class="title">イベントの投稿がありません</div>
          </div>
        </div>
        <?php endif; 
        wp_reset_postdata(); // ループをリセット ?>
        <div class="more-btn">
          <a href="<?php echo get_category_link(get_category_by_slug('event')->term_id); ?>">もっと見る</a>
        </div>
      </div>
    </section>

    <!-- 教育方針 -->
    <section id="policy">
      <div class="polka-dots"></div>
      <div class="policy-content">
        <div class="policy-left">
          <h2>愛情と学びで育む<br />心と未来の翼</h2>
          <p class="policy-subtitle">
            安心と笑顔に包まれて<br />子どもたちの可能性は羽ばたいていく
          </p>
          <p>
            認定こども園幌東は、子ども一人ひとりの個性と笑顔を大切にしながら、まるで家庭のように温かく安心できる環境を提供しています。その中で、遊びや学びを通して「自ら気づき、考える力」や「他者と関わる力」を育み、未来へ羽ばたくための基盤を育てます。多様な価値観や文化にもふれながら、子どもたちの心と世界を広げ、保護者・地域とも手を取り合って、子どもたちの豊かな未来を共に育んでいきます。
          </p>
        </div>
        <div class="policy-right">
          <h2 class="section-title">教育・保育方針</h2>

          <div class="decoration-line">
            <div class="decoration-dot dot-blue"></div>
            <div class="decoration-dot dot-yellow"></div>
            <div class="decoration-dot dot-pink"></div>
            <div class="decoration-dot dot-blue"></div>
            <div class="decoration-dot dot-yellow"></div>
            <div class="decoration-dot dot-pink"></div>
          </div>

          <div class="policy-image fade-up">
            <img src="<?php echo get_template_directory_uri(); ?>/img/policy.jpg" alt="" />
          </div>
        </div>
      </div>
    </section>

    <!-- 幌東にしかない魅力 -->
    <section id="unique-charm">
      <h2 class="section-title">幌東にしかない魅力</h2>

      <div class="decoration-line">
        <div class="decoration-dot dot-blue"></div>
        <div class="decoration-dot dot-yellow"></div>
        <div class="decoration-dot dot-pink"></div>
        <div class="decoration-dot dot-blue"></div>
        <div class="decoration-dot dot-yellow"></div>
        <div class="decoration-dot dot-pink"></div>
      </div>

      <div class="container">
        <div class="unique-charm-container fade-up">
          <div class="unique-charm-content family-env">
            <img
              src="<?php echo get_template_directory_uri(); ?>/img/parts/unique-charm-1.png"
              alt="温かい家庭的環境の創出"
            />
          </div>

          <div class="unique-charm-content photo-placeholder">
            <img
              class="unique-charm-circle"
              src="<?php echo get_template_directory_uri(); ?>/img/charm-right.png"
              alt=""
            />
          </div>

          <div class="center-content">
            <h2 class="inclusive-title">
              <div class="curved-text">
                <span class="letter">"</span>
                <span class="letter">違</span>
                <span class="letter">い</span>
                <span class="letter">"</span>
                <span class="letter">を</span>
                <span class="letter">愛</span>
                <span class="letter">せ</span>
                <span class="letter">る</span>
                <span class="letter">心</span>
                <span class="letter">を</span>
                <span class="letter">育</span>
                <span class="letter">て</span>
                <span class="letter">る</span>
              </div>
              <br />
              インクルーシブ教育
            </h2>
            <div class="rainbow-bar">
              <img src="<?php echo get_template_directory_uri(); ?>/img/parts/unique-charm-line.png" alt="rainbow-bar" />
            </div>
          </div>

          <div class="unique-charm-content cooperation">
            <img
              src="<?php echo get_template_directory_uri(); ?>/img/parts/unique-charm-2.png"
              alt="保護者・地域との連携強化"
            />
          </div>

          <div class="unique-charm-content photo-placeholder-bottom">
            <img
              class="unique-charm-circle"
              src="<?php echo get_template_directory_uri(); ?>/img/charm-left.jpg"
              alt=""
            />
          </div>

          <div class="main-text">
            <p>
              見た目や考え方、できることや感じ方が違っていても<br />
              どの子も「そのまま」で、かけがえのない存在<br />
              インクルーシブ教育は<br />
              そんな一人ひとりを尊重する学びのかたちです<br />
              幌東では、長い歴史の中で育まれた温もりある環境に<br />
              最先端の教育を取り入れながら<br />
              経験豊かなスタッフが、一人ひとりの心に寄り添い<br />
              未来を生きる力を育てています
            </p>
          </div>

          <div class="unique-charm-content growth-individuality">
            <img
              src="<?php echo get_template_directory_uri(); ?>/img/parts/unique-charm-3.png"
              alt="個々の成長と個性の尊重"
            />
          </div>

          <div class="unique-charm-content life-skills">
            <img
              src="<?php echo get_template_directory_uri(); ?>/img/parts/unique-charm-4.png"
              alt="生きる力と社会性の育成"
            />
          </div>

          <div class="unique-charm-content multicultural">
            <img
              src="<?php echo get_template_directory_uri(); ?>/img/parts/unique-charm-5.png"
              alt="国際感覚と多文化理解の促進"
            />
          </div>
        </div>
      </div>
    </section>

    <!-- 特色 -->
    <section id="features">
      <!-- A: 主題 -->
      <div class="feature-title">
        <h2 class="section-title">幌東の特色</h2>

        <div class="decoration-line">
          <div class="decoration-dot dot-blue"></div>
          <div class="decoration-dot dot-yellow"></div>
          <div class="decoration-dot dot-pink"></div>
          <div class="decoration-dot dot-blue"></div>
          <div class="decoration-dot dot-yellow"></div>
          <div class="decoration-dot dot-pink"></div>
        </div>
      </div>

      <!-- 特色コンテンツ全体を包むコンテナ -->
      <div class="features-container">
        <!-- B: 副題1つ目 -->
        <div class="subtitle-item">
          <div class="subtitle">
            <div class="number-icon">
              <img src="<?php echo get_template_directory_uri(); ?>/img/parts/feature-number-1.png" alt="1" />
            </div>
            <div class="subtitle-text">安心して<br />通える</div>
          </div>
        </div>

        <!-- C: 副題1つ目コンテンツ -->
        <div class="feature-content-item">
          <div class="feature-content-left">
            <div class="content-box fade-up">
              <ul class="content-list">
                <li>防犯カメラ・インターホン等</li>
                <li class="content-list-item">万全のセキュリティ</li>
                <li>アレルギー対応・栄養バランスを考えた</li>
                <li class="content-list-item">安心・安全な食事</li>
              </ul>
              <img src="<?php echo get_template_directory_uri(); ?>/img/feature-left-img.jpg" alt="安全な環境" />
            </div>
          </div>
        </div>

        <!-- D: 副題2つ目 -->
        <div class="subtitle-item reverse">
          <div class="subtitle reverse">
            <div class="number-icon">
              <img src="<?php echo get_template_directory_uri(); ?>/img/parts/feature-number-2.png" alt="2" />
            </div>
            <div class="subtitle-text">楽しく<br />成長できる</div>
          </div>
        </div>

        <!-- E & F: 副題2つ目コンテンツ -->
        <div class="feature-content-item">
          <div class="feature-content-right">
            <!-- E: 英語あそび -->
            <div class="activity-card fade-up">
              <div class="activity-frame type1"></div>
              <div class="activity-content type1">
                <div class="activity-title">英語あそび</div>
                <div class="activity-photo1">
                  <img
                    src="<?php echo get_template_directory_uri(); ?>/img/feature-english-right.jpg"
                    alt="英語あそび1"
                  />
                </div>
                <div class="activity-photo2">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/feature-english-left2.jpeg" alt="英語あそび2" />
                </div>
                <div class="activity-description">
                  <p>ECCジュニア英会話教室</p>
                </div>
              </div>
            </div>

            <!-- F: 体育あそび -->
            <div class="activity-card fade-up">
              <div class="activity-frame type2"></div>
              <div class="activity-content type2">
                <div class="activity-title">体育あそび</div>
                <div class="activity-photo1">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/feature-pe-left.jpg" alt="体育あそび1" />
                </div>
                <div class="activity-photo2">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/feature-pe-right.jpg" alt="体育あそび2" />
                </div>
                <div class="activity-description">
                  <p>コスモスポーツクラブ</p>
                  <p>サッカー教室・体育教室</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- G: 農園体験 -->
        <div class="feature-content-item">
          <div class="activity-card fade-up">
            <div class="activity-frame type2"></div>
            <div class="activity-content type2">
              <div class="activity-title">農園体験</div>
              <div class="activity-photo1 feature-farm-photo1">
                <img src="<?php echo get_template_directory_uri(); ?>/img/feature-farm-left.jpg" alt="農園体験1" />
              </div>
              <div class="activity-photo2">
                <img src="<?php echo get_template_directory_uri(); ?>/img/feature-farm-right.jpg" alt="農園体験2" />
              </div>
              <div class="activity-description"></div>
            </div>
          </div>
        </div>

        <!-- H: 音楽あそび -->
        <div class="feature-content-item">
          <div class="activity-card fade-up">
            <div class="activity-frame type1"></div>
            <div class="activity-content type1">
              <div class="activity-title">音楽あそび</div>
              <div class="activity-photo1">
                <img src="<?php echo get_template_directory_uri(); ?>/img/feature-music-right.jpg" alt="音楽あそび1" />
              </div>
              <div class="activity-photo2">
                <img src="<?php echo get_template_directory_uri(); ?>/img/feature-music-left.jpg" alt="音楽あそび2" />
              </div>
              <div class="activity-description">
                <p>カワイ音楽教室</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="principal-greeting">
      <h2 class="section-title">園長挨拶・スタッフ紹介</h2>

      <div class="decoration-line">
        <div class="decoration-dot dot-blue"></div>
        <div class="decoration-dot dot-yellow"></div>
        <div class="decoration-dot dot-pink"></div>
        <div class="decoration-dot dot-blue"></div>
        <div class="decoration-dot dot-yellow"></div>
        <div class="decoration-dot dot-pink"></div>
      </div>

      <div class="principal-greeting-content">
        <!-- 園長挨拶 -->
        <div class="principal-greeting-left">
          <div class="principal-greeting-background"></div>
          <div class="principal-greeting-wrapper">
            <div class="principal-left">
              <div class="principal-photo fade-up">
				<img src="<?php echo get_template_directory_uri(); ?>/img/principal-img.jpg" alt="園長写真" />
                <div class="photo-shadow principal"></div>
                <img
                  src="<?php echo get_template_directory_uri(); ?>/img/parts/principal-greeting-sun.png"
                  alt="太陽"
                  class="principal-sun"
                />
              </div>
              <div class="principal-name">
                園長 <ruby>美山 富子<rt>みやま とみこ</rt></ruby>
              </div>
            </div>
            <div class="principal-info">
              <div class="principal-message">
                <p>
                  子どもたちが自分らしく過ごし、笑顔があふれる園。それが私たちの願いです。歴史ある学校法人として、すべての子どもを受け入れるインクルーシブな環境を整え、明るく・楽しく・元気よく、心豊かなウェルビーイングな毎日を育んでいます。これからも信頼され続ける園であるために、歩みを止めず進んでいきます。
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- スタッフ紹介 -->
        <div class="principal-greeting-right">
          <div class="staff-introduction">
            <div class="staff-photos">
              <div class="staff-photo-ellipse fade-up-2">
                <img src="<?php echo get_template_directory_uri(); ?>/img/staff-1.jpg" alt="スタッフ写真1" />
                <div class="photo-shadow ellipse"></div>
              </div>
              <div class="staff-photo-rectangle fade-up-3">
                <img src="<?php echo get_template_directory_uri(); ?>/img/staff-2.jpg" alt="スタッフ写真2" />
                <div class="photo-shadow rectangle"></div>
              </div>
            </div>
            <div class="staff-message">
              <span class="message-top">わたしたちが</span>
              <span class="message-bottom">お迎えします！</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="daily-life">
      <div class="daily-life-cover fade-up">
        <img src="<?php echo get_template_directory_uri(); ?>/img/parts/daily-life-cover.png" alt="園の1日" />
        <h2 class="section-title">園の1日</h2>

        <div class="decoration-line">
          <div class="decoration-dot dot-blue"></div>
          <div class="decoration-dot dot-yellow"></div>
          <div class="decoration-dot dot-pink"></div>
          <div class="decoration-dot dot-blue"></div>
          <div class="decoration-dot dot-yellow"></div>
          <div class="decoration-dot dot-pink"></div>
        </div>
      </div>

      <div class="daily-life-container">
        <!-- 左側：スケジュール部分 -->
        <div class="schedule-section">
          <img
            src="<?php echo get_template_directory_uri(); ?>/img/parts/daily-life-schedule.png"
            alt="園の1日のスケジュール"
          />
        </div>

        <!-- 右側：写真部分 -->
        <div class="photos-section">
          <div class="photos-grid">
            <div class="photo-item fade-up">
              <img src="<?php echo get_template_directory_uri(); ?>/img/daily-life-left-top.jpg" alt="園での生活1" />
            </div>
            <div class="photo-item fade-up-2">
              <img src="<?php echo get_template_directory_uri(); ?>/img/daily-life-right-top.jpg" alt="園での生活2" />
            </div>
            <div class="photo-item fade-up-2">
              <img src="<?php echo get_template_directory_uri(); ?>/img/daily-life-left-bottom.jpg" alt="園での生活3" />
            </div>
            <div class="photo-item fade-up">
              <img src="<?php echo get_template_directory_uri(); ?>/img/daily-life-right-bottom.jpg" alt="園での生活4" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- 年間行事 -->
    <section class="en-annual-events">
      <h2 class="section-title">年間行事</h2>
      <div class="decoration-line">
        <div class="decoration-dot dot-blue"></div>
        <div class="decoration-dot dot-yellow"></div>
        <div class="decoration-dot dot-pink"></div>
        <div class="decoration-dot dot-blue"></div>
        <div class="decoration-dot dot-yellow"></div>
        <div class="decoration-dot dot-pink"></div>
      </div>

      <div class="en-events-container">
        <div class="en-events">
          <div class="en-events-photos">
            <img src="<?php echo get_template_directory_uri(); ?>/img/parts/schedule-4-6.png" alt="4月5月6月" />
            <img
              class="en-events-photos-img1 fade-up"
              src="<?php echo get_template_directory_uri(); ?>/img/annual-event46-1.jpg"
              alt="4-6月行事写真1"
            />
            <img
              class="en-events-photos-img2 fade-up-2"
              src="<?php echo get_template_directory_uri(); ?>/img/annual-event46-2.jpg"
              alt="4-6月行事写真2"
            />
            <img
              class="en-events-photos-img3 fade-up-3"
              src="<?php echo get_template_directory_uri(); ?>/img/annual-event46-3.jpg"
              alt="4-6月行事写真3"
            />
          </div>
          <div class="en-events-name">
            <ul>
              <li>入園式</li>
              <li>参観日</li>
              <li>親子遠足</li>
            </ul>
          </div>
        </div>

        <div class="en-events-reverse">
          <div class="en-events-photos-reverse">
            <img src="<?php echo get_template_directory_uri(); ?>/img/parts/schedule-7-9.png" alt="7月8月9月" />
            <img
              class="en-events-photos-img1 fade-up"
              src="<?php echo get_template_directory_uri(); ?>/img/annual-event79-3.jpg"
              alt="7-9月行事写真1"
            />
            <img
              class="en-events-photos-img2 fade-up-2"
              src="<?php echo get_template_directory_uri(); ?>/img/annual-event79-1.jpg"
              alt="7-9月行事写真2"
            />
            <img
              class="en-events-photos-img3 fade-up-3"
              src="<?php echo get_template_directory_uri(); ?>/img/annual-event79-2.jpg"
              alt="7-9月行事写真3"
            />
          </div>
          <div class="en-events-name-reverse">
            <ul>
              <li>運動会</li>
              <li>お泊まり会</li>
              <li>秋の遠足</li>
            </ul>
          </div>
        </div>

        <div class="en-events">
          <div class="en-events-photos">
            <img src="<?php echo get_template_directory_uri(); ?>/img/parts/schedule-10-12.png" alt="10月11月12月" />
            <img
              class="en-events-photos-img1 fade-up"
              src="<?php echo get_template_directory_uri(); ?>/img/annual-event1012-1.jpg"
              alt="10-12月行事写真1"
            />
            <img
              class="en-events-photos-img2 fade-up-2"
              src="<?php echo get_template_directory_uri(); ?>/img/annual-event1012-2.jpg"
              alt="10-12月行事写真2"
            />
            <img
              class="en-events-photos-img3 fade-up-3"
              src="<?php echo get_template_directory_uri(); ?>/img/annual-event1012-3.jpg"
              alt="10-12月行事写真3"
            />
          </div>
          <div class="en-events-name">
            <ul>
              <li>KOUTOU FESTIVAL</li>
              <li>生活発表会</li>
              <li>クリスマス会</li>
            </ul>
          </div>
        </div>

        <div class="en-events-reverse">
          <div class="en-events-photos-reverse">
            <img src="<?php echo get_template_directory_uri(); ?>/img/parts/schedule-1-3.png" alt="1月2月3月" />
            <img
              class="en-events-photos-img1 fade-up"
              src="<?php echo get_template_directory_uri(); ?>/img/annual-event13-3.jpg"
              alt="1-3月行事写真1"
            />
            <img
              class="en-events-photos-img2 fade-up-2"
              src="<?php echo get_template_directory_uri(); ?>/img/annual-event13-1.jpg"
              alt="1-3月行事写真2"
            />
            <img
              class="en-events-photos-img3 fade-up-3"
              src="<?php echo get_template_directory_uri(); ?>/img/annual-event13-2.jpg"
              alt="1-3月行事写真3"
            />
          </div>
          <div class="en-events-name-reverse">
            <ul>
              <li>節分の日の集い</li>
              <li>ひな祭り会</li>
              <li>卒園式</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section id="contact">
      <h2 class="section-title">お問い合わせ</h2>

      <div class="decoration-line">
        <div class="decoration-dot dot-blue"></div>
        <div class="decoration-dot dot-yellow"></div>
        <div class="decoration-dot dot-pink"></div>
        <div class="decoration-dot dot-blue"></div>
        <div class="decoration-dot dot-yellow"></div>
        <div class="decoration-dot dot-pink"></div>
      </div>

      <div class="contact-content">
        <p class="contact-description">
          見学希望・入園に関する不安や疑問、イベントに関するお問い合わせなど、<br />
          気になることがございましたら、下記よりお気軽にお問い合わせください。
        </p>

        <div class="contact-phone">
          <h3>お電話でのお問い合わせはこちら</h3>
          <div class="phone-numbers">
            <p>幼児部　　📞 <span>011-864-6246</span></p>
            <p>乳児部　　📞 <span>011-864-0111</span></p>
            <p>COCO room　📞 <span>011-598-9343</span></p>
          </div>
        </div>
      </div>

      <div class="form-container">
        <?php 
        // Contact Form 7のショートコードを表示
        if (function_exists('wpcf7_contact_form')) {
            echo do_shortcode('[contact-form-7 id="81a9a43" title="コンタクトフォーム 1"]');
        } else {
            // Contact Form 7が無効な場合のフォールバック
            echo '<p style="text-align: center; color: #666; padding: 20px;">お問い合わせフォームを読み込めませんでした。Contact Form 7プラグインが有効になっているかご確認ください。</p>';
        }
        ?>
      </div>
    </section>

    <?php get_footer(); ?>
<!-- Swiper JS（フッター直前などでOK） -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const mainSwiper = new Swiper('.main-swiper', {
    effect: 'fade',
    fadeEffect: { crossFade: true },
    speed: 2000,
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
      pauseOnMouseEnter: false,
    },
    loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
      dynamicBullets: true,
    },
  });
});
</script>