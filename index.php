<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
  include_once(G5_THEME_MOBILE_PATH . '/index.php');
  return;
}

include_once(G5_THEME_PATH . '/head.php');

// ── 슬라이더 데이터 로드 ──────────────────────────────────
$sl_rows = [];

// g5_slider 테이블 존재 여부 확인 후 데이터 로드
$tbl_check = sql_query("SHOW TABLES LIKE 'g5_slider'");
if (sql_num_rows($tbl_check) > 0) {
    $sl_result = sql_query("SELECT * FROM g5_slider WHERE sl_use=1 ORDER BY sl_sort ASC, sl_id ASC");
    while ($sl_row = sql_fetch_array($sl_result)) {
        $sl_rows[] = $sl_row;
    }
}

// DB에 데이터 없으면 기본값(하드코딩) 유지용 더미 생성
$use_db_slider = !empty($sl_rows);
?>

<style>
/* ── 슬라이더 텍스트 모바일 중앙 정렬 ── */
@media (max-width: 800px) {
  #sliderTxtWrap,
  .sliderTxt {
    text-align: center !important;
    align-items: center !important;
  }
  #sliderTxtWrap #slTxtTitle,
  #sliderTxtWrap #slTxtSub,
  .sliderTxt h3,
  .sliderTxt p {
    text-align: center !important;
    width: 100% !important;
  }
  #sliderTxtWrap #slTxtLabel,
  .sliderTxt span {
    margin: 0 auto !important;
    display: block !important;
    width: fit-content !important;
  }
}
</style>

<div id="slider">
  <?php if ($use_db_slider): ?>

  <!-- ── DB 슬라이더 텍스트 오버레이 (JS로 교체) ── -->
  <div class="sliderTxt absCenter" id="sliderTxtWrap">
    <span id="slTxtLabel"><?php echo htmlspecialchars($sl_rows[0]['sl_label']) ?></span>
    <h3 id="slTxtTitle"><?php echo htmlspecialchars($sl_rows[0]['sl_title']) ?></h3>
    <p id="slTxtSub"><?php echo htmlspecialchars($sl_rows[0]['sl_subtitle']) ?></p>
  </div>

  <!-- ── 슬라이드 목록 ── -->
  <ul id="mainslider" class="bxslider">
    <?php foreach ($sl_rows as $sl): ?>
    <?php
      $sl_img_url = '';
      if ($sl['sl_image_file']) {
          $sl_img_url = G5_DATA_URL . '/slider/' . $sl['sl_image_file'];
      }
      $sl_bg_style = $sl_img_url
          ? 'background-image:url(' . htmlspecialchars($sl_img_url) . ');background-size:cover;background-position:center center;background-color:#000;'
          : '';
      $sl_link = htmlspecialchars($sl['sl_link']);
    ?>
    <li class="visu"
        style="<?php echo $sl_bg_style ?>"
        data-label="<?php echo htmlspecialchars($sl['sl_label']) ?>"
        data-title="<?php echo htmlspecialchars($sl['sl_title']) ?>"
        data-subtitle="<?php echo htmlspecialchars($sl['sl_subtitle']) ?>"
        <?php if ($sl_link): ?>data-link="<?php echo $sl_link ?>"<?php endif; ?>
    ></li>
    <?php endforeach; ?>
  </ul>

  <?php echo display_banner('슬라이드'); ?>

  <div id="bx-pager" class="absCenter">
    <?php foreach ($sl_rows as $i => $sl): ?>
    <a data-slide-index="<?php echo $i ?>" href=""></a>
    <?php endforeach; ?>
  </div>

  <!-- ── bxSlider + 텍스트 교체 ── -->
  <script>
  (function(){
    var slides = <?php
      $js_slides = array_map(function($s) {
          return [
              'label'    => $s['sl_label'],
              'title'    => $s['sl_title'],
              'subtitle' => $s['sl_subtitle'],
              'link'     => $s['sl_link'],
          ];
      }, $sl_rows);
      echo json_encode($js_slides, JSON_UNESCAPED_UNICODE);
    ?>;

    function updateText(idx) {
      var s = slides[idx] || slides[0];
      // textContent 사용 → white-space:pre-line이 \n을 줄바꿈으로 처리
      document.getElementById('slTxtLabel').textContent = s.label;
      document.getElementById('slTxtTitle').textContent = s.title;
      document.getElementById('slTxtSub').textContent   = s.subtitle;
    }

    $(document).ready(function() {
      var slider = $('#mainslider').bxSlider({
        auto: true,
        stopAutoOnClick: true,
        infiniteLoop: true,
        mode: 'fade',
        controls: false,
        speed: 3000,
        pause: 5000,
        pagerCustom: '#bx-pager',
        onSlideAfter: function($el, oldIdx, newIdx) {
          updateText(newIdx);
        }
      });

      // ── 터치 스와이프 지원 (fade 모드는 기본 touch 미지원 → 수동 구현) ──
      var $wrapper = $('#mainslider').closest('.bx-wrapper');
      var touchStartX = 0, touchStartY = 0, touching = false;

      $wrapper[0].addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].pageX;
        touchStartY = e.changedTouches[0].pageY;
        touching = true;
      }, { passive: true });

      $wrapper[0].addEventListener('touchend', function(e) {
        if (!touching) return;
        touching = false;
        var dx = e.changedTouches[0].pageX - touchStartX;
        var dy = e.changedTouches[0].pageY - touchStartY;
        // 수평 스와이프가 수직보다 크고 40px 이상일 때만 처리
        if (Math.abs(dx) > Math.abs(dy) && Math.abs(dx) > 40) {
          if (dx < 0) { slider.goToNextSlide(); }
          else        { slider.gotoPrevSlide(); }
        }
      }, { passive: true });

      // 슬라이드 클릭 시 링크 이동
      $('#mainslider').on('click', '.visu', function() {
        var link = $(this).data('link');
        if (link) window.location.href = link;
      });
    });
  })();
  </script>

  <?php else: ?>

  <!-- ── 기존 하드코딩 슬라이더 (DB 데이터 없을 때 폴백) ── -->
  <div class="sliderTxt absCenter">
    <span>FOOTBALL CLUB</span>
    <h3>GIJANG UNITED FC,
      FOR THE FUTURE, GIJANG</h3>
    <p>기장에서 시작되는
      축구의 열정</p>
  </div>
  <ul id="mainslider" class="bxslider">
    <li class="visu img-1"></li>
    <li class="visu img-2"></li>
  </ul>
  <?php echo display_banner('슬라이드'); ?>
  <div id="bx-pager" class="absCenter">
    <a data-slide-index="0" href=""></a>
    <a data-slide-index="1" href=""></a>
  </div>
  <script>
  $(document).ready(function() {
    $('#mainslider').bxSlider({
      auto: true,
      stopAutoOnClick: true,
      infiniteLoop: true,
      mode: 'fade',
      controls: false,
      speed: 3000,
      pause: 5000,
      pagerCustom: '#bx-pager'
    });
  });
  </script>

  <?php endif; ?>
</div>

<!-- 메인 게임 결과 영역 -->
<div id="main-game">
  <div class="container">
    <!-- 경기결과 -->
    <div class="item game-result">
      <div class="game-tl">
        <h3>지난 경기 결과</h3>
        <a href="/bbs/board.php?bo_table=gjuGame" class="more"></a>
      </div>
      <?php
      echo latest('theme/game_prev', 'gjuGame', 100, 100); // 지난 경기
      ?>
    </div>

    <!-- 다음 경기 일정 -->
    <div class="item game-result" style="background-color:#091932;;">
      <div class="game-tl">
        <h3>다음 경기 일정</h3>
        <a href="/bbs/board.php?bo_table=gjuGame" class="more"></a>
      </div>
      <?php
      echo latest('theme/game_next', 'gjuGame', 100, 100); // 다음 경기
      ?>
    </div>

    <!-- TEAM RANKING -->
    <div class="item game-result">
      <div class="game-tl">
        <h3>TEAM RANKING</h3>
        <a href="/bbs/board.php?bo_table=gjuRanking" class="more"></a>
      </div>
      <div class="ranking">
        <?php
        echo latest_basic("theme/ranking", "gjuRanking", 4, 10, "", "", "", "wr_2");
        ?>
      </div>
    </div>

  </div>
</div>


<div class="main-least wow fadeInUp">
  <div class="container">
    <div class="allLeast-wrap">
      <h3>What's NEW<span>기장군민축구단의 최신소식을 확인하세요!</span></h3>
      <?php echo latest_all('theme/all_least', '새글', 5, 40, ['free', 'gjuGame', 'gjuRanking', 'supporters', 'partners', 'gjuBoard', 'gjuPlayer']); ?>
    </div>
  </div>

</div>

<div class="main_gallery wow fadeInUp">
  <div class="container">
    <div class="tl">
      <h3>GALLERY</h3>
    </div>
    <?php echo latest("theme/pic_block", "gallery", "5", "50"); ?>
  </div>
</div>


<div class="clients">
  <div class="container">
    <?php echo latest("theme/partners", "partners", "100", "50"); ?>
  </div>
</div>

<?php
include_once(G5_THEME_PATH . '/tail.php');
?>
