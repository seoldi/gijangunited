<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
	include_once(G5_THEME_MOBILE_PATH . '/tail.php');
	return;
}
?>

<? if (defined('_INDEX_')) { ?>
<? } else { ?>
	</div><!-- end .content -->
	</section> <!-- End #sub -->
<? } ?>


<!-- 하단 시작 { -->
<div id="ft">
	<div class="container">
		<div class="copyright">
			<img src="<?php echo G5_THEME_IMG_URL ?>/logo(c).svg">
			<div>부산광역시 기장군 기장읍 차성동로122번길 13, 2층 | 전화 070-4118-2023~7 | 팩스 051-724-2025 | 이메일 bestgijang@naver.com
				<p>Copyright by 2025 <span>GIJANG UNITED FOOTBALL CLUB</span> All rights reserved.</p>
			</div>
		</div>

		<div class="link">
			<a href="https://www.nts.go.kr/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/footer-link-1.svg" alt="국세청"></a>
			<a href="https://www.acrc.go.kr/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/footer-link-2.svg" alt="국민권익위원회회"></a>
		</div>
	</div>
</div>

<button type="button" id="top_btn">
	<i class="fi fi-rr-arrow-small-up"></i><span class="sound_only">상단으로</span>
</button>
<script>
	$(function() {
		$("#top_btn").on("click", function() {
			$("html, body").animate({
				scrollTop: 0
			}, '500');
			return false;
		});
	});
</script>

<script>
	$(document).ready(function() {
		try {
			$('#nav').onePageNav({
				begin: function() {
					console.log('start')
				},
				end: function() {
					console.log('stop')
				}
			});
		} catch (e) {}

		$('map').imageMapResize();
	});
</script>

<script type="text/javascript" src="<?php echo G5_THEME_URL; ?>/plugin/share/wow.js"></script>
<link rel="stylesheet" media="all" href="<?php echo G5_THEME_URL; ?>/plugin/share/animate.css">
<script>
	wow = new WOW({
		boxClass: 'wow',
		animateClass: 'animated',
		offset: 100,
		callback: function(box) {
			console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
		}
	});
	wow.init();
</script>

<?php
if (G5_DEVICE_BUTTON_DISPLAY && !G5_IS_MOBILE) { ?>
<?php
}

if ($config['cf_analytics']) {
	echo $config['cf_analytics'];
}
?>

<!-- } 하단 끝 -->

<script>
	$(function() {
		// 폰트 리사이즈 쿠키있으면 실행
		font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
	});
</script>

<?php
include_once(G5_THEME_PATH . "/tail.sub.php");
?>