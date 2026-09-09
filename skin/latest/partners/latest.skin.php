<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH . '/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $latest_skin_url . '/style.css">', 0);
$thumb_width = 350;
$thumb_height = 120;
$list_count = (is_array($list) && $list) ? count($list) : 0;
?>

<style>
    .pic_lt {
        position: relative;
    }

    .pic_lt .arrow {
        position: absolute;
        top: 0;
        z-index: 10;
        width: 20px;
        height: 100%;
        border: 0;
        font-size: 14px;
    }

    .pic_lt .arrow.prev {
        left: 0;
        border-radius: 6px 0 0 6px;
    }

    .pic_lt .arrow.next {
        right: 0;
        border-radius: 0px 6px 6px 0px;
    }
</style>

<div class="pic_lt">
    <!-- <h2 class="lat_title"><a href="<?php echo get_pretty_url($bo_table); ?>"><?php echo $bo_subject ?></a></h2> -->
    <ul id="client-slider">
        <?php
        for ($i = 0; $i < $list_count; $i++) {
            $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true);

            if ($thumb['src']) {
                $img = $thumb['src'];
            } else {
                $img = G5_IMG_URL . '/no_img.png';
                $thumb['alt'] = '이미지가 없습니다.';
            }
            $img_content = '<img src="' . $img . '" alt="' . $thumb['alt'] . '" >';
            $wr_href = get_pretty_url($bo_table, $list[$i]['wr_id']);
        ?>
            <li class="galley_li item">
                <a href="<?php echo $list[$i]['wr_link1'] ?>" class="lt_img" target="_blank"><?php echo run_replace('thumb_image_tag', $img_content, $thumb); ?></a>
            </li>
        <?php }  ?>
        <?php if ($list_count == 0) { //게시물이 없을 때  
        ?>
            <li class="empty_li">게시물이 없습니다.</li>
        <?php }  ?>
    </ul>
    <button class="arrow prev">&#10094;</button>
    <button class="arrow next">&#10095;</button>
    <!-- <a href="<?php echo get_pretty_url($bo_table); ?>" class="lt_more"><span class="sound_only"><?php echo $bo_subject ?></span>더보기</a> -->

</div>

<script>
    var clientSlider = document.getElementById('client-slider');
    var clientList = clientSlider.getElementsByTagName('li');
    var isAnimating = false; // 중복 클릭 방지

    function slideNext() {
        if (isAnimating) return;
        isAnimating = true;
        clientSlider.style.transition = "0.3s";
        clientSlider.style.transform = "translateX(-20%)";
    }

    function slidePrev() {
        if (isAnimating) return;
        isAnimating = true;
        // 맨 마지막 아이템을 앞으로 옮긴다
        clientSlider.insertBefore(clientSlider.lastElementChild, clientSlider.firstElementChild);
        clientSlider.style.transition = "none";
        clientSlider.style.transform = "translateX(-20%)";
        setTimeout(() => {
            clientSlider.style.transition = "0.3s";
            clientSlider.style.transform = "translateX(0)";
        });
    }

    // 자동 슬라이드
    setInterval(slideNext, 3000);

    // transition 끝났을 때 정리
    clientSlider.addEventListener('transitionend', function() {
        if (clientSlider.style.transform === "translateX(-20%)") {
            clientSlider.appendChild(clientSlider.firstElementChild);
            clientSlider.style.transition = "none";
            clientSlider.style.transform = "translateX(0)";
        }
        isAnimating = false;
    });

    // 버튼 클릭 이벤트
    document.querySelector('.arrow.next').addEventListener('click', slideNext);
    document.querySelector('.arrow.prev').addEventListener('click', slidePrev);
</script>