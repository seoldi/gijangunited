<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
  include_once(G5_THEME_MOBILE_PATH . '/head.php');
  return;
}

include_once(G5_THEME_PATH . '/head.sub.php');
include_once(G5_LIB_PATH . '/latest.lib.php');
include_once(G5_LIB_PATH . '/latest.all.lib.php');
include_once(G5_LIB_PATH . '/outlogin.lib.php');
include_once(G5_LIB_PATH . '/poll.lib.php');
include_once(G5_LIB_PATH . '/visit.lib.php');
include_once(G5_LIB_PATH . '/connect.lib.php');
include_once(G5_LIB_PATH . '/popular.lib.php');
include_once(G5_LIB_PATH . '/latest_basic.lib.php');

?>


<header id="header">
  <div class="bg">
  </div>

  <div id="hs1">
    <div class="d_container">
      <div id="d_gnb">
        <a class="home" href="/"><i class="fi fi-rr-home"></i></a>
        <div class="sns">
          <a href="https://www.instagram.com/gijangunited_fc/" target="_blank">
            <img src="<?php echo G5_THEME_IMG_URL ?>/sns_insta.svg" />
            <p>INSTA</p>
          </a>
          <a href="https://www.facebook.com/profile.php?id=61577081670081" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/sns_facebook.svg" />
            <p>FACEBOOK</p>
          </a>
          <a href="https://band.us/band/97530785" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/sns_band.svg" />
            <p>B</p>
          </a>
          <a href="https://blog.naver.com/gijangunited" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/sns_blog.svg" />
            <p>BLOG</p>
          </a>
        </div>
        <div class="close">
          <span></span>
        </div>
      </div>
    </div>
  </div>


  <div id="hs2">
    <div class="d_container">
      <div id="d_lnb_btn">
        <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
      </div>
      <h1 class="logo">
        <a href="/">
          <img src="<?php echo G5_THEME_IMG_URL ?>/logo.svg" alt="부산기장군민축구단" class="pc_logo" />
          <img src="<?php echo G5_THEME_IMG_URL ?>/logo(m).svg" alt="부산기장군민축구단" class="m_logo" />
        </a>
      </h1>
      <div id="d_lnb">
        <div id="d_lnb_bg">
          <div class="d_container">
          </div>
          <div class="shadow">
          </div>
        </div>
        <div class="menu_wrap">
          <div class="menu_sns">
            <a href="/">HOME</a>
            <a href="https://www.instagram.com/gijangunited_fc/" target="_blank">INSTAGRAM</a>
            <a href="https://www.facebook.com/profile.php?id=61577081670081" target="_blank">FACEBOOK</a>
            <a href="https://band.us/band/97530785" target="_blank">BAND</a>
            <a href="https://blog.naver.com/gijangunited" target="_blank">BLOG</a>
          </div>
          <ul class="menu">
            <?php
            $sql = " select *
                  from {$g5['menu_table']}
                  where me_use = '1'
                    and length(me_code) = '2'
                  order by me_order, me_id ";
            $result = sql_query($sql, false);
            $gnb_zindex = 999; // gnb_1dli z-index 값 설정용
            $menu_datas = array();
            for ($i = 0; $row = sql_fetch_array($result); $i++) {
              $menu_datas[$i] = $row;

              $sql2 = " select *
                    from {$g5['menu_table']}
                    where me_use = '1'
                      and length(me_code) = '4'
                      and substring(me_code, 1, 2) = '{$row['me_code']}'
                    order by me_order, me_id ";
              $result2 = sql_query($sql2);
              for ($k = 0; $row2 = sql_fetch_array($result2); $k++) {
                $menu_datas[$i]['sub'][$k] = $row2;
              }
            }
            $i = 0;
            foreach ($menu_datas as $row) {
              if (empty($row)) continue;
            ?>
              <?php if ($row['sub']['0']) { ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle en2 f16" href="<?php echo $row['me_link']; ?>" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" target="_<?php echo $row['me_target']; ?>">
                    <?php echo $row['me_name'] ?>
                  </a>
                  <!-- 서브 -->
                  <div class="sub">
                    <?php
                    // 하위 분류
                    $k = 0;
                    foreach ((array) $row['sub'] as $row2) {

                      if (empty($row2)) continue;

                    ?>
                      <a class="dropdown-item ko1 f15 fw4" href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>"><?php echo $row2['me_name'] ?></a>

                    <?php
                      $k++;
                    }   //end foreach $row2

                    if ($k > 0)
                      echo '</div>' . PHP_EOL;
                    ?>
                  <?php } else { ?>
                <li class="nav-item">
                  <a class="nav-link en2 f16" href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>"><?php echo $row['me_name'] ?></a>
                </li>
              <?php } ?>
              </li>

            <?php
              $i++;
            }   //end foreach $row

            if ($i == 0) {  ?>
              <li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
            <?php } ?>
            <!--li class="tail">
            <a href="../sub10/sub03_01.html"><span class="bar">사이트맵</span></a>
            </li-->
          </ul>
        </div>
      </div>
      <div class="menu-last">
        <a href="/adm"><i class="xi-user"></i><span>관리자</span></a>
        <a href="/bbs/search.php"><i class="xi-search"></i><span>검색</span></a>
      </div>
    </div>
    <div id="d_lnb_mask">
    </div>
  </div>
</header>

<?php
if (defined('_INDEX_')) { // index에서만 실행
  include G5_BBS_PATH . '/newwin.inc.php'; // 팝업레이어
}
?>

<? if (defined('_INDEX_')) { ?>

<? } else { ?>
  <?php include_once(G5_THEME_PATH . '/sub/top.php');  ?>
<? } ?>

<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

<!--내용관리 php 구문 삽입-->
<?php include_once(G5_THEME_PATH . '/sub.php');  ?>