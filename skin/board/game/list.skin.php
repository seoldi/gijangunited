<!-- e: sub-visual subbg-1 -->
<div class="boxy-warp sub-contents">
	<div class="r-sub-con">
		<?php
		if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

		// 선택옵션으로 인해 셀합치기가 가변적으로 변함
		$colspan = 5;

		if ($is_checkbox) $colspan++;
		if ($is_good) $colspan++;
		if ($is_nogood) $colspan++;
		$subject_px = 875 - ($colspan * 50 + 70);

		// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
		add_stylesheet('<link rel="stylesheet" href="' . $board_skin_url . '/style.css">', 0);

		// wr_2 일정 03월 23일(일) 01:00과 같은 형식으로 나타내기기
		// $datetime = new DateTime($list[$i]['wr_2']);
		// $koreanDays = ['일', '월', '화', '수', '목', '금', '토'];
		// $dayOfWeek = $datetime->format('w');
		// $formattedDate = $datetime->format('m월 d일') . '(' . $koreanDays[$dayOfWeek] . ') ' . $datetime->format('H:i');

		// 출력
		?>
		<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-straight/css/uicons-regular-straight.css'>
		<style>
			span.w_subject {
				width: <?php echo $subject_px ?>px;
			}
		</style>

		<!-- 게시판 목록 시작 { -->
		<div id="bo_list" style="width:<?php echo $width; ?>">


			<!-- 게시판 페이지 정보 및 버튼 시작 { -->
			<div id="bo_btn_top">
				<div id="bo_list_total">
					<span>Total <?php echo number_format($total_count) ?>건</span>
					<?php echo $page ?> 페이지
				</div>

				<ul class="btn_bo_user">
					<?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin btn btn_dark" title="관리자">관리자</a></li><?php } ?>
					<?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01 btn" title="RSS">RSS</a></li><?php } ?>

					<?php if ($is_admin == 'super' || $is_auth) {  ?>
						<li>
							<button type="button" class="btn_more_opt is_list_btn btn_b01 btn" title="게시판 리스트 옵션">선택</button>
							<?php if ($is_checkbox) { ?>
								<ul class="more_opt is_list_btn">
									<li><button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"><i class="fas fa-trash" aria-hidden="true"></i> 선택삭제</button></li>
									<li><button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"><i class="fas fa-copy" aria-hidden="true"></i> 선택복사</button></li>
									<li><button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"><i class="fas fa-arrow-right" aria-hidden="true"></i> 선택이동</button></li>
								</ul>
							<?php } ?>
						</li>
					<?php }  ?>
				</ul>
			</div>
			<!-- } 게시판 페이지 정보 및 버튼 끝 -->


			<!-- 게시판 카테고리 시작 { -->
			<?php if ($is_category) { ?>
				<nav id="bo_cate">
					<h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
					<ul id="bo_cate_ul">
						<?php echo $category_option ?>
					</ul>
				</nav>
			<?php } ?>
			<!-- } 게시판 카테고리 끝 -->

			<form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
				<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
				<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
				<input type="hidden" name="stx" value="<?php echo $stx ?>">
				<input type="hidden" name="spt" value="<?php echo $spt ?>">
				<input type="hidden" name="sca" value="<?php echo $sca ?>">
				<input type="hidden" name="sst" value="<?php echo $sst ?>">
				<input type="hidden" name="sod" value="<?php echo $sod ?>">
				<input type="hidden" name="page" value="<?php echo $page ?>">
				<input type="hidden" name="sw" value="">

				<div class="bo_list head">
					<ul>
						<li>
							<?php if ($is_checkbox) { ?>
								<span class="all_chk s-check">
									<label for="chkall">
										<span></span>
										<b class="sound_only">현재 페이지 게시물 전체선택</b>
									</label>
									<input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
								</span>
							<?php } ?>
							<span class="round">라운드</span>
							<span class="date">일정</span>
							<span class="location">홈/어웨이</span>
							<span class="place">장소</span>
							<span class="verse">대진</span>
							<span class="result">결과</span>
							<span class="icon"></span>


							<!--span class="s-view"><?php echo subject_sort_link('wr_hit', $qstr2, 1) ?>조회</a></span-->
							<!-- <?php if ($is_good) { ?><span class="w50"><?php echo subject_sort_link('wr_good', $qstr2, 1) ?>추천 <i class="fas fa-sort" aria-hidden="true"></i></a></span><?php } ?>
							<?php if ($is_nogood) { ?><span class="w50"><?php echo subject_sort_link('wr_nogood', $qstr2, 1) ?>비추천 <i class="fas fa-sort" aria-hidden="true"></i></a></span><?php } ?>
							<span class="s-day"><?php echo subject_sort_link('wr_datetime', $qstr2, 1) ?>날짜</a></span>
							<span class="s-data">첨부</span> -->
						</li>
					</ul>
				</div>
				<div class="bo_list list">
					<ul>
						<!-- <li>
							<span class="s-check"></span>
							<span class="round">1R</span>
							<span class="date">02월 22일(토) 15:00</span>
							<span class="location">H</span>
							<span class="place">모덕체육공원</span>
							<span class="verse list-verse">
								<div class="team">
									<img src="<?php echo G5_THEME_IMG_URL ?>/game/gijang.svg">
									<p class="name gijang">기장군민축구단</p>
									<p class="score bold">5</p>
								</div>
								<div class="bold">:</div>
								<div class="team">
									<p class="score bold">3</p>
									<p class="name jinju">진주시민축구단</p>
									<img src="<?php echo G5_THEME_IMG_URL ?>/game/jinju.svg">
								</div>
							</span>
							<span class="result">승</span>
						</li> -->

						<?php
						$update_href = $delete_href = '';
						set_session('ss_delete_token', $token = uniqid(time()));

						for ($i = 0; $i < count($list); $i++) {

							// 로그인중이고 자신의 글이라면 또는 관리자라면 비밀번호를 묻지 않고 바로 수정, 삭제 가능
							if (($member['mb_id'] && ($member['mb_id'] === $list[$i]['mb_id'])) || $is_admin) {
								$update_href = './write.php?w=u&amp;bo_table=' . $bo_table . '&amp;wr_id=' . $list[$i]['wr_id'] . '&amp;page=' . $page . $qstr;
								$delete_href = './delete.php?bo_table=' . $bo_table . '&amp;wr_id=' . $list[$i]['wr_id'] . '&amp;token=' . $token . '&amp;page=' . $page . urldecode($qstr);
							} else if (!$list[$i]['mb_id']) { // 회원이 쓴 글이 아니라면
								$update_href = './password.php?w=u&amp;bo_table=' . $bo_table . '&amp;wr_id=' . $list[$i]['wr_id'] . '&amp;page=' . $page . $qstr;
								$delete_href = './password.php?w=d&amp;bo_table=' . $bo_table . '&amp;wr_id=' . $list[$i]['wr_id'] . '&amp;page=' . $page . $qstr;
							}
						?>

							<li class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?>"">
								<?php if ($is_checkbox) { ?>
								<span class=" s-check">
								<!-- <label for="chk_wr_id_<?php echo $i ?>" class="sound_only mobile_none"><?php echo $list[$i]['subject'] ?></label> -->
								<input class="mobile_none" type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" />
								</span>
							<?php } ?>


							<?php
							if (!function_exists('getTeamClass')) {
								function getTeamClass($teamName)
								{
									$teamMap = [
										"기장군민축구단" => "gijang",
										"진주시민축구단" => "jinju",
										"거제시민축구단" => "geoje",
										"남양주시민축구단" => "namyangju",
										"당진시민축구단" => "dangjin",
										"대구FC" => "daegu",
										"서울중랑축구단" => "Jungrang",
										"세종SA" => "sejong",
										"연천FC" => "yeoncheon",
										"평택시티즌FC" => "pyeongtaek",
										"평창유나이티드FC" => "pyeongchang",
									];

									return isset($teamMap[$teamName]) ? $teamMap[$teamName] : "default";
								}
							}
							?>

							<span class="round"><?php echo $list[$i]['wr_1'] ?></span>
							<span class="date"><?php echo date('m월 d일', strtotime($list[$i]['wr_2'])); ?>(<?php echo get_yoil($list[$i]['wr_2']); ?>) <?php echo date('H:i', strtotime($list[$i]['wr_2'])); ?></span>
							<span class="location"><?php echo $list[$i]['wr_3'] ?></span>
							<span class="place"><?php echo $list[$i]['wr_4'] ?></span>
							<span class="verse list-verse">
								<div class="team" style="justify-content: flex-end;">
									<p class="name"><?php echo $list[$i]['wr_5'] ?></p>
									<img src="<?php echo G5_THEME_IMG_URL ?>/game/<?php echo getTeamClass($list[$i]['wr_5']); ?>.svg">
									<p class="score bold"><?php echo $list[$i]['wr_6'] ?></p>
								</div>
								<div class="bold">:</div>
								<div class="team">
									<p class="score bold"><?php echo $list[$i]['wr_8'] ?></p>
									<img src="<?php echo G5_THEME_IMG_URL ?>/game/<?php echo getTeamClass($list[$i]['wr_7']); ?>.svg">
									<p class="name"><?php echo $list[$i]['wr_7'] ?></p>
								</div>
							</span>
							<span class="result"><?php echo $list[$i]['wr_9'] ?></span>
							<span class="icon">
								<?php if ($update_href) { ?><a href="<?php echo $update_href ?>"><i class="fi fi-rs-pen-square"></i></a><?php } ?>
								<!-- <?php if ($delete_href) { ?><a href="<?php echo $delete_href ?>" onclick="del(this.href); return false;"><i class="fi fi-rs-trash"></i></a><?php } ?> -->
							</span>

							<!--
							<span class=" s-number mobile_none">
								<?php
								if ($list[$i]['is_notice']) // 공지사항
									echo '<strong class="mobile_none" >공지</strong>';
								else if ($wr_id == $list[$i]['wr_id'])
									echo "<span class=\"bo_current mobile_none\">열람중</span>";
								else
									echo '<div class="mobile_none">' . $list[$i]['num'] . '</div>';
								?>
							</span>


							<span class="s-name" style="padding-left:<?php echo $list[$i]['reply'] ? (strlen($list[$i]['wr_reply']) * 10) : '0'; ?>px" onclick="location.href='<?php echo $list[$i]['href'] ?>'">
								<div class="bo_tit">
									<?php
									if ($is_category && $list[$i]['ca_name']) {
									?>
										<a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$i]['ca_name'] ?></a>
									<?php } ?>

									<a href="<?php echo $list[$i]['href'] ?>">
										<?php echo $list[$i]['icon_reply'] ?>
										<?php
										if (isset($list[$i]['icon_secret'])) echo rtrim($list[$i]['icon_secret']);
										?>

										<?php echo conv_subject($list[$i]['wr_subject'], 100, "..."); ?>

									</a>
									<?php
									// if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }
									// if (isset($list[$i]['icon_file'])) echo rtrim($list[$i]['icon_file']);
									// if (isset($list[$i]['icon_link'])) echo rtrim($list[$i]['icon_link']);
									// if (isset($list[$i]['icon_new'])) echo rtrim($list[$i]['icon_new']);
									// if (isset($list[$i]['icon_hot'])) echo rtrim($list[$i]['icon_hot']);
									?>
									<?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><span class="cmt">[<?php echo $list[$i]['wr_comment']; ?>]</span><span class="sound_only">개</span><?php } ?>
								</div>

							</span>
							<span class="s-user"><?php echo $list[$i]['name'] ?></span>
							span class="s-view"><nobr class="pc_none"></nobr> <?php echo $list[$i]['wr_hit'] ?></span
								<?php if ($is_good) { ?><span class="w50">
							<nobr class="pc_none"><i class="fas fa-thumbs-up" aria-hidden="true"> </i></nobr> <?php echo $list[$i]['wr_good'] ?>
							</span><?php } ?>
						<?php if ($is_nogood) { ?><span class="w50">
								<nobr class="pc_none"><i class="fas fa-thumbs-down" aria-hidden="true"> </i></nobr> <?php echo $list[$i]['wr_nogood'] ?>
							</span><?php } ?>
						<span class="s-day">
							<nobr class="pc_none"></nobr> <?php echo $list[$i]['datetime'] ?>
						</span>
						<span class="s-data">
							<?php
							if (isset($list[$i]['icon_file'])) echo rtrim($list[$i]['icon_file']);
							if ($list[$i]['wr_1']) {
								echo '<i class="fas fa-download" aria-hidden="true"></i>';
							}
							?>
						</span>
							</li>
							-->
						<?php } ?>
						<?php if (count($list) == 0) {
							echo '<li style="text-align:center;">게시물이 없습니다.</li>';
						} ?>
					</ul>
				</div>

				<div class="bo_fx">
					<!-- 페이지 --><?php echo $write_pages;  ?> <!-- -->
					<ul class="btn_bo_user" style="display: flex; width: 100%;">
						<?php if ($is_checkbox) { ?>
							<div class="select_btn" style="margin-right: auto;">
								<li><button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_admin">선택삭제</button></li>
								<li><button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value" class="btn btn_admin">선택복사</button></li>
								<li><button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value" class="btn btn_admin">선택이동</button></li>
							</div>
						<?php } ?>
						<?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn">목록</a></li><?php } ?>
						<li>
							<!-- <button type="button" class="btn_bo_sch btn_b01 btn" title="게시판 검색">게시판 검색</button> -->
						</li>
						<?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn btn_dark">추가</a></li><?php } ?>
					</ul>
				</div>


			</form>
		</div>
		<!-- 게시판 검색 시작 { -->
		<div class="bo_sch_wrap">
			<fieldset class="bo_sch">
				<h3>검색</h3>
				<form name="fsearch" method="get">
					<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
					<input type="hidden" name="sca" value="<?php echo $sca ?>">
					<input type="hidden" name="sop" value="and">
					<label for="sfl" class="sound_only">검색대상</label>
					<select name="sfl" id="sfl">
						<?php echo get_board_sfl_select_options($sfl); ?>
					</select>
					<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
					<div class="sch_bar">
						<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="sch_input" size="25" maxlength="20" placeholder="검색어를 입력해주세요">
						<button type="submit" value="검색" class="sch_btn"><i class="fas fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
					</div>
					<button type="button" class="bo_sch_cls"><i class="fas fa-times" aria-hidden="true"></i><span class="sound_only">닫기</span></button>
				</form>
			</fieldset>
			<div class="bo_sch_bg"></div>
		</div>
		<script>
			// 게시판 검색
			$(".btn_bo_sch").on("click", function() {
				$(".bo_sch_wrap").toggle();
			})
			$('.bo_sch_bg, .bo_sch_cls').click(function() {
				$('.bo_sch_wrap').hide();
			});
		</script>
		<!-- } 게시판 검색 끝 -->
		<?php if ($is_checkbox) { ?>
			<noscript>
				<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
			</noscript>
		<?php } ?>


		<?php if ($is_checkbox) { ?>
			<script>
				function all_checked(sw) {
					var f = document.fboardlist;

					for (var i = 0; i < f.length; i++) {
						if (f.elements[i].name == "chk_wr_id[]")
							f.elements[i].checked = sw;
					}
				}

				function fboardlist_submit(f) {
					var chk_count = 0;

					for (var i = 0; i < f.length; i++) {
						if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
							chk_count++;
					}

					if (!chk_count) {
						alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
						return false;
					}

					if (document.pressed == "선택복사") {
						select_copy("copy");
						return;
					}

					if (document.pressed == "선택이동") {
						select_copy("move");
						return;
					}

					if (document.pressed == "선택삭제") {
						if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
							return false;

						f.removeAttribute("target");
						f.action = "./board_list_update.php";
					}

					return true;
				}

				// 선택한 게시물 복사 및 이동
				function select_copy(sw) {
					var f = document.fboardlist;

					if (sw == "copy")
						str = "복사";
					else
						str = "이동";

					var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

					f.sw.value = sw;
					f.target = "move";
					f.action = "./move.php";
					f.submit();
				}

				// 게시판 리스트 관리자 옵션
				jQuery(function($) {
					$(".btn_more_opt.is_list_btn").on("click", function(e) {
						e.stopPropagation();
						$(".more_opt.is_list_btn").toggle();
					});
					$(document).on("click", function(e) {
						if (!$(e.target).closest('.is_list_btn').length) {
							$(".more_opt.is_list_btn").hide();
						}
					});
				});
			</script>
		<?php } ?>
		<!-- } 게시판 목록 끝 -->
	</div>
</div>