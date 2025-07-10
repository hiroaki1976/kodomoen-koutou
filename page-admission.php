<?php
/*
Template Name: 入園案内
*/

get_header(); ?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style2.css" />

<!-- メインビジュアル -->
<div class="en-main-visual fade-up">
  <img
    src="<?php echo get_template_directory_uri(); ?>/img2/nyuen_annnai_top_AIhosei.jpeg"
    alt="幼稚園のメインビジュアル"
    class="en-clipped-image"
  />
  <h2 class="en-main-visual-text">入園のご案内</h2>
</div>

<!-- 新入園受付 -->
<section class="en-admission-reception">
    <h2>新入園受付</h2>
    <div class="decoration-line">
      <div class="decoration-dot dot-blue"></div>
      <div class="decoration-dot dot-yellow"></div>
      <div class="decoration-dot dot-pink"></div>
      <div class="decoration-dot dot-blue"></div>
      <div class="decoration-dot dot-yellow"></div>
      <div class="decoration-dot dot-pink"></div>
    </div>

    <div class="en-certification">
      <div class="en-first-certification">
        <div class="en-first-certification-title">
          <p>　</p>
          <h3>1号認定</h3>
          <p>（幼稚園利用）</p>
          <p>　</p>
        </div>
        <div class="en-flow">
          <div class="en-flow-img en-circle">
            <p>　</p>
            <p class="en-pc-text">　説明会　</p>
            <p class="en-sp-text">説明会</p>
            <p>　</p>
          </div>
          <div class="en-flow-img en-arrow">
            　　
          </div>
          <div class="en-flow-img en-circle">
            <p>　</p>
            <p class="en-pc-text">　願書配布　</p>
            <p class="en-sp-text">願書配布</p>
            <p>　</p>
          </div>
          <div class="en-flow-img en-arrow">
            　　
          </div>
          <div class="en-flow-img en-circle">
            <p>入園手続<br>面談</p>
          </div>
        </div>
        <div class="en-first-certification-text">
          <ul>
            <li>入園説明会への参加、または事前の園見学をお願いします。</li>
            <li>お問い合わせフォームまたはお電話にてご予約ください。</li>
            <li>入園手続きおよび面談は、お子様と一緒にご来園ください。</li>
          </ul>
        </div>
      </div>
      
      <div class="en-second-certification">
        <div class="en-second-certification-title">
          <p>　</p>
          <h3>2号・3号認定</h3>
          <p>（保育所利用）</p>
          <p>　</p>
        </div>
        <div class="en-second-main-text">
          <p>当園は札幌市の委託を受けた
          <br>認可保育園となりますので<br>お住まいの区の子ども家庭福祉係に
          <br>お問い合わせください。</p>
        </div>
        <div class="en-second-sub-text">
          <img src="<?php echo get_template_directory_uri(); ?>/img2/logo_hidari_1_1.png" alt="注目" class="en-note-icon">
          <span>お申し込みの前に</span>
          <img src="<?php echo get_template_directory_uri(); ?>/img2/logo_migi_1_1.png" alt="注目" class="en-note-icon">
          <p>必ず園の見学をお願いいたします。</p>
        </div>
      </div>
    </div>
</section>

<!-- 定員・保育料 -->
<section class="en-capacity-fee">
  <h2>定員・保育料</h2>
    <div class="decoration-line">
      <div class="decoration-dot dot-blue"></div>
      <div class="decoration-dot dot-yellow"></div>
      <div class="decoration-dot dot-pink"></div>
      <div class="decoration-dot dot-blue"></div>
      <div class="decoration-dot dot-yellow"></div>
      <div class="decoration-dot dot-pink"></div>
    </div>

    <div class="en-data-table-container-pc">
      <table class="en-data-table-pc">
        <thead>
          <tr>
            <th colspan="4" class="en-section-group-header en-capacity-group">定 員</th>
            <th class="en-header-spacer-cell"></th>
            <th colspan="3" class="en-section-group-header en-fee-group">保育料</th>
          </tr>
          <tr>
            <th>満3歳</th>
            <th>年少</th>
            <th>年中</th>
            <th>年長</th>
            <th></th>
            <th>保育環境<br>充実費</th>
            <th>給食費</th>
            <th>バス利用料</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>12名</td>
            <td>36名</td>
            <td>36名</td>
            <td>36名</td>
            <td class="en-nintei-type en-nintei1">
              1号認定
              <span class="en-age-note">(3・4・5歳)</span>
            </td>
            <td>5,000円/月</td>
            <td>7,000円/月</td>
            <td>3,500円/月</td>
          </tr>
          <tr>
            <td></td>
            <td>11名</td>
            <td>11名</td>
            <td>11名</td>
            <td class="en-nintei-type en-nintei2">
              2号認定
              <span class="en-age-note">(3・4・5歳)</span>
            </td>
            <td>5,000円/月</td>
            <td>7,000円/月</td>
            <td class="en-no-fee">—</td>
          </tr>
          <tr class="en-dotted-line-row">
            <td colspan="4"></td>
          </tr>
          <tr>
            <td></td>
            <td>6名</td>
            <td>10名</td>
            <td>11名</td>
            <td class="en-nintei-type en-nintei3">
              3号認定
              <span class="en-age-note">(0・1・2歳)</span>
            </td>
            <td>5,000円/月</td>
            <td class="en-no-fee">—</td>
            <td class="en-no-fee">—</td>
          </tr>
        </tbody>
        <tfoot>
          <tr class="en-capacity-subheader">
            <th></th>
            <th>0歳</th>
            <th>1歳</th>
            <th>2歳</th>
            <td colspan="4"></td>
          </tr>
        </tfoot>
      </table>
    </div>

    <div class="en-data-table-container-sp">
      <table class="en-data-table-sp1">
        <thead>
          <tr>
            <th colspan="5" class="en-section-group-header en-capacity-group">定 員</th>
          </tr>
          <tr>
            <th class="en-header-spacer-cell"></th>
            <th>満3歳</th>
            <th>年少</th>
            <th>年中</th>
            <th>年長</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="en-nintei-type en-nintei1">
              1号認定
              <span class="en-age-note">(3・4・5歳)</span>
            </td>
            <td>12名</td>
            <td>36名</td>
            <td>36名</td>
            <td>36名</td>
          </tr>
          <tr>
            <td class="en-nintei-type en-nintei2">
              2号認定
              <span class="en-age-note">(3・4・5歳)</span>
            </td>
            <td></td>
            <td>11名</td>
            <td>11名</td>
            <td>11名</td>
          </tr>
          <tr class="en-dotted-line-row">
            <td colspan="5"></td>
          </tr>
          <tr>
            <td class="en-nintei-type en-nintei3">
              3号認定
              <span class="en-age-note">(0・1・2歳)</span>
            </td>
            <td></td>
            <td>6名</td>
            <td>10名</td>
            <td>11名</td>
          </tr>
        </tbody>
        <tfoot>
          <tr class="en-capacity-subheader">
            <th class="en-header-spacer-cell"></th>
            <th></th>
            <th>0歳</th>
            <th>1歳</th>
            <th>2歳</th>
            <td colspan="5"></td>
          </tr>
        </tfoot>
      </table>

      <table class="en-data-table-sp2">
        <thead>
          <tr>
            <th colspan="4" class="en-section-group-header en-fee-group">保育料</th>
          </tr>
          <tr>
            <th class="en-header-spacer-cell"></th>
            <th>保育環境<br>充実費</th>
            <th>給食費</th>
            <th>バス<br>利用料</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="en-nintei-type en-nintei1">
              1号認定
              <span class="en-age-note">(3・4・5歳)</span>
            </td>
            <td>5,000円/月</td>
            <td>7,000円/月</td>
            <td>3,500円/月</td>
          </tr>
          <tr>
            <td class="en-nintei-type en-nintei2">
              2号認定
              <span class="en-age-note">(3・4・5歳)</span>
            </td>
            <td>5,000円/月</td>
            <td>7,000円/月</td>
            <td class="en-no-fee">—</td>
          </tr>
          <tr>
            <td colspan="4"></td>
          </tr>
          <tr>
            <td class="en-nintei-type en-nintei3">
              3号認定
              <span class="en-age-note">(0・1・2歳)</span>
            </td>
            <td>5,000円/月</td>
            <td class="en-no-fee">—</td>
            <td class="en-no-fee">—</td>
          </tr>
        </tbody>
      </table>
    </div>
</section>

<!-- こども園概要 -->
<section class="en-summary">
  <h2>こども園概要</h2>
    <div class="decoration-line">
      <div class="decoration-dot dot-blue"></div>
      <div class="decoration-dot dot-yellow"></div>
      <div class="decoration-dot dot-pink"></div>
      <div class="decoration-dot dot-blue"></div>
      <div class="decoration-dot dot-yellow"></div>
      <div class="decoration-dot dot-pink"></div>
    </div>

    <div class="en-summary-container">
      <div class="en-summary-columns-wrapper">
        <dl class="en-summary-list en-summary-list-left">
          <dt>運営主体</dt>
          <dd>学校法人早坂学園</dd>

          <dt>開設年月日</dt>
          <dd>昭和44年3月13日</dd>

          <dt>理事長</dt>
          <dd>美山　富子</dd>

          <dt>園長</dt>
          <dd>美山　富子</dd>

          <dt>保育時間</dt>
          <dd>
            基本　7:00～18:00<br>
            延長　18:00〜19:00
          </dd>

          <dt>連絡先</dt>
          <dd>
            幼児部：011-864-6246<br>
            乳児部：011-864-0111<br>
            COCO room：011-598-9343
          </dd>   
        </dl>

        <dl class="en-summary-list en-summary-list-right">
          <dt>所在地</dt>
          <dd>
            〒003-0025<br>
            札幌市白石区本郷通3丁目北3-11
          </dd>

          <dt>アクセス</dt>
          <dd>
            中央バス川下線バス停本郷通3丁目<br>-徒歩2分<br>
            地下鉄東西線白石駅-徒歩13分<br>
            JR白石駅-徒歩13分                
          </dd>

          <dt>駐車場</dt>
          <dd>正面玄関向かいに送迎時用の駐車場がございます。路上駐車はお控え下さい。</dd>
        </dl>
      </div>
    </div>
  </section>

<?php get_footer(); ?> 