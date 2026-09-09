<!-- e: sub-visual subbg-1 -->
<div class="boxy-warp sub-contents">
	<div class="r-sub-con">
		<?php
		if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

		// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
		add_stylesheet('<link rel="stylesheet" href="' . $board_skin_url . '/style.css">', 0);
		$wr10 = explode('|', $write['wr_10']);

		for ($i = 0; $i < 5; $i++) $wrchk[$i] = $wr10[$i] ?  'checked' : '';
		?>

		<section id="bo_w">
			<!-- <h2 class="sound_only"><?php echo $g5['title'] ?></h2> -->

			<!-- 게시물 작성/수정 시작 { -->
			<form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
				<input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
				<input type="hidden" name="w" value="<?php echo $w ?>">
				<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
				<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
				<input type="hidden" name="sca" value="<?php echo $sca ?>">
				<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
				<input type="hidden" name="stx" value="<?php echo $stx ?>">
				<input type="hidden" name="spt" value="<?php echo $spt ?>">
				<input type="hidden" name="sst" value="<?php echo $sst ?>">
				<input type="hidden" name="sod" value="<?php echo $sod ?>">
				<input type="hidden" name="page" value="<?php echo $page ?>">
				<?php
				$option = '';
				$option_hidden = '';
				if ($is_notice || $is_html || $is_secret || $is_mail) {
					$option = '';
					if ($is_notice) {
						$option .= "\n" . '<input type="checkbox" id="notice" name="notice" value="1" ' . $notice_checked . '>' . "\n" . '<label for="notice">공지</label>';
					}

					if ($is_html) {
						if ($is_dhtml_editor) {
							$option_hidden .= '<input type="hidden" value="html1" name="html">';
						} else {
							$option .= "\n" . '<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="' . $html_value . '" ' . $html_checked . '>' . "\n" . '<label for="html">HTML</label>';
						}
					}

					if ($is_secret) {
						if ($is_admin || $is_secret == 1) {
							$option .= "\n" . '<input type="checkbox" id="secret" name="secret" value="secret" ' . $secret_checked . '>' . "\n" . '<label for="secret">비밀글</label>';
						} else {
							$option_hidden .= '<input type="hidden" name="secret" value="secret">';
						}
					}

					if ($is_mail) {
						$option .= "\n" . '<input type="checkbox" id="mail" name="mail" value="mail" ' . $recv_email_checked . '>' . "\n" . '<label for="mail">답변메일받기</label>';
					}
				}

				echo $option_hidden;
				?>

				<?php if ($is_category) { ?>
					<div class="bo_w_select write_div">
						<label for="ca_name" class="sound_only">분류<strong>필수</strong></label>
						<select name="ca_name" id="ca_name" required>
							<option value="">분류를 선택하세요</option>
							<?php echo $category_option ?>
						</select>
					</div>
				<?php } ?>

				<div class="">
					<?php if ($is_name) { ?>
						<label for="wr_name" class="sound_only">이름<strong>필수</strong></label>
						<input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required" placeholder="이름">
					<?php } ?>

					<?php if ($is_password) { ?>
						<label for="wr_password" class="sound_only">비밀번호<strong>필수</strong></label>
						<input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" placeholder="비밀번호">
					<?php } ?>

					<?php if ($is_email) { ?>
						<label for="wr_email" class="sound_only">이메일</label>
						<input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input email " placeholder="이메일">
					<?php } ?>
				</div>

				<?php if ($is_homepage) { ?>
					<div class="write_div">
						<label for="wr_homepage" class="sound_only">홈페이지</label>
						<input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input full_input" size="50" placeholder="홈페이지">
					</div>
				<?php } ?>

				<?php if ($option) { ?>
					<div class="option-box">
						<span class="sound_only">옵션</span>
						<?php echo $option ?>
					</div>
				<?php } ?>

				<div class="write_wrap">
					<!--제목 -->
					<div class="row">
						<label for="wr_subject" class="sound_only required">제목<strong>필수</strong></label>
						<input type="hidden" name="wr_subject" value="경기 일정 및 결과" id="wr_subject" required class="frm_input full_input required" size="50" maxlength="255" placeholder="제목">
					</div>
					<!-- 일정 및 결과 글쓰기 폼-->
					<div class="w_game">
						<div class="box">
							<p class="tl">랭킹정보</p>
							<div class="cont">
								<div class="item" style="width: 500px;">
									<p class="w_tl required">팀명</p>
									<select name="wr_1" id="wr_1" class="frm_input" style="text-align: left;">
										<option value=""></option>
										<option class="gijang" value="기장군민축구단" <?php if ($write['wr_1'] == "기장군민축구단") echo "selected"; ?>>기장군민축구단</option>
										<option class="jinju" value="진주시민축구단" <?php if ($write['wr_1'] == "진주시민축구단") echo "selected"; ?>>진주시민축구단</option>
										<option class="geoje" value="거제시민축구단" <?php if ($write['wr_1'] == "거제시민축구단") echo "selected"; ?>>거제시민축구단</option>
										<option class="namyangju " value="남양주시민축구단" <?php if ($write['wr_1'] == "남양주시민축구단") echo "selected"; ?>>남양주시민축구단</option>
										<option class="dangjin " value="당진시민축구단" <?php if ($write['wr_1'] == "당진시민축구단") echo "selected"; ?>>당진시민축구단</option>
										<option class="daegu " value="대구FC" <?php if ($write['wr_1'] == "대구FC") echo "selected"; ?>>대구FC</option>
										<option class="Jungrang " value="서울중랑축구단" <?php if ($write['wr_1'] == "서울중랑축구단") echo "selected"; ?>>서울중랑축구단</option>
										<option class="sejong " value="세종SA" <?php if ($write['wr_1'] == "세종SA") echo "selected"; ?>>세종SA</option>
										<option class="yeoncheon " value="연천FC" <?php if ($write['wr_1'] == "연천FC") echo "selected"; ?>>연천FC</option>
										<option class="pyeongtaek " value="평택시티즌FC" <?php if ($write['wr_1'] == "평택시티즌FC") echo "selected"; ?>>평택시티즌FC</option>
										<option class="pyeongchang " value="평창유나이티드FC" <?php if ($write['wr_1'] == "평창유나이티드FC") echo "selected"; ?>>평창유나이티드FC</option>
									</select>
								</div>
								<div class="item">
									<p class="w_tl required">승점</p>
									<input type="number" name="wr_2" value="<?php echo $write['wr_2'] ?>" id="wr_2" required class="frm_input" size="20">
								</div>
								<div class="item">
									<p class="w_tl required">승</p>
									<input type="number" name="wr_3" value="<?php echo $write['wr_3'] ?>" id="wr_3" required class="frm_input" size="20">
								</div>
								<div class="item">
									<p class="w_tl required">무</p>
									<input type="number" name="wr_4" value="<?php echo $write['wr_4'] ?>" id="wr_4" required class="frm_input" size="20">
								</div>
								<div class="item">
									<p class="w_tl required">패</p>
									<input type="number" name="wr_5" value="<?php echo $write['wr_5'] ?>" id="wr_5" required class="frm_input" size="20">
								</div>
								<div class="item">
									<p class="w_tl required">골득실</p>
									<input type="number" name="wr_6" value="<?php echo $write['wr_6'] ?>" id="wr_6" required class="frm_input" size="20">
								</div>
								<div class="item">
									<p class="w_tl required">경기수</p>
									<input type="number" name="wr_7" value="<?php echo $write['wr_7'] ?>" id="wr_7" required class="frm_input" size="20">
								</div>
								<div class="item" style="opacity: 0.5;">
									<p class="w_tl required">승점 + 골득실</p>
									<input type="number" name="wr_10" value="<?php echo $write['wr_10'] ?>" id="wr_10" readonly class="frm_input" size="20">
								</div>
							</div>
						</div>

					</div>

					<script>
						function updateScoreSum() {
							const winPoint = parseInt(document.getElementById("wr_2").value) || 0;
							const goalDiff = parseInt(document.getElementById("wr_6").value) || 0;
							document.getElementById("wr_10").value = (winPoint * 10000) + goalDiff;
						}

						// wr_2(승점), wr_6(골득실) 값이 바뀔 때마다 자동계산
						document.getElementById("wr_2").addEventListener("input", updateScoreSum);
						document.getElementById("wr_6").addEventListener("input", updateScoreSum);

						// 폼 제출 전에도 한번 더 강제계산
						document.getElementById("fwrite").addEventListener("submit", function() {
							updateScoreSum();
						});
					</script>

					<!-- 내용 -->
					<div class="write_div" style="display: none;">
						<!-- <label for="wr_content" class="sound_only">내용<strong>필수</strong></label> -->
						<div class="wr_content <?php echo $is_dhtml_editor ? $config['cf_editor'] : ''; ?>">
							<?php if ($write_min || $write_max) { ?>
								<!-- 최소/최대 글자 수 사용 시 -->
								<p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
							<?php } ?>
							<?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 
							?>
							<?php if ($write_min || $write_max) { ?>
								<!-- 최소/최대 글자 수 사용 시 -->
								<div id="char_count_wrap"><span id="char_count"></span>글자</div>
							<?php } ?>
						</div>

					</div>

					<?php for ($i = 1; $is_link && $i <= G5_LINK_COUNT; $i++) { ?>
						<div class="bo_w_link write_div" style="display: none;">
							<label for="wr_link<?php echo $i ?>"><i class="fi fi-br-link-alt"></i><span class="sound_only"> 링크 #<?php echo $i ?></span></label>
							<input type="text" name="wr_link<?php echo $i ?>" value="<?php if ($w == "u") {
																							echo $write['wr_link' . $i];
																						} ?>" id="wr_link<?php echo $i ?>" class="frm_input full_input" size="50">
						</div>
					<?php } ?>

					<?php for ($i = 0; $is_file && $i < $file_count; $i++) { ?>
						<div class="bo_w_flie write_div" style="display: none;">
							<div class="file_wr write_div">
								<label for="bf_file_<?php echo $i + 1 ?>" class="lb_icon"><i class="fi fi-br-add-document"></i><span class="sound_only"> 파일 #<?php echo $i + 1 ?></span></label>
								<input type="file" name="bf_file[]" id="bf_file_<?php echo $i + 1 ?>" title="파일첨부 <?php echo $i + 1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file ">
							</div>
							<?php if ($is_file_content) { ?>
								<input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="full_input frm_input" size="50" placeholder="파일 설명을 입력해주세요.">
							<?php } ?>

							<?php if ($w == 'u' && $file[$i]['file']) { ?>
								<span class="file_del">
									<input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'] . '(' . $file[$i]['size'] . ')';  ?> 파일 삭제</label>
								</span>
							<?php } ?>

						</div>
					<?php } ?>

					<?php if ($is_use_captcha) { //자동등록방지  
					?>
						<div class="write_div">
							<?php echo $captcha_html ?>
						</div>
					<?php } ?>


					<div class="btn_confirm write_div">
						<a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel btn">취소</a>
						<input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit btn">
					</div>
			</form>

			<script>
				<?php if ($write_min || $write_max) { ?>
					// 글자수 제한
					var char_min = parseInt(<?php echo $write_min; ?>); // 최소
					var char_max = parseInt(<?php echo $write_max; ?>); // 최대
					check_byte("wr_content", "char_count");

					$(function() {
						$("#wr_content").on("keyup", function() {
							check_byte("wr_content", "char_count");
						});
					});

				<?php } ?>

				function html_auto_br(obj) {
					if (obj.checked) {
						result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
						if (result)
							obj.value = "html2";
						else
							obj.value = "html1";
					} else
						obj.value = "";
				}

				function fwrite_submit(f) {
					<?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   
					?>

					var subject = "";
					var content = "";
					$.ajax({
						url: g5_bbs_url + "/ajax.filter.php",
						type: "POST",
						data: {
							"subject": f.wr_subject.value,
							"content": f.wr_content.value
						},
						dataType: "json",
						async: false,
						cache: false,
						success: function(data, textStatus) {
							subject = data.subject;
							content = data.content;
						}
					});

					if (subject) {
						alert("제목에 금지단어('" + subject + "')가 포함되어있습니다");
						f.wr_subject.focus();
						return false;
					}

					if (content) {
						alert("내용에 금지단어('" + content + "')가 포함되어있습니다");
						if (typeof(ed_wr_content) != "undefined")
							ed_wr_content.returnFalse();
						else
							f.wr_content.focus();
						return false;
					}

					if (document.getElementById("char_count")) {
						if (char_min > 0 || char_max > 0) {
							var cnt = parseInt(check_byte("wr_content", "char_count"));
							if (char_min > 0 && char_min > cnt) {
								alert("내용은 " + char_min + "글자 이상 쓰셔야 합니다.");
								return false;
							} else if (char_max > 0 && char_max < cnt) {
								alert("내용은 " + char_max + "글자 이하로 쓰셔야 합니다.");
								return false;
							}
						}
					}

					<?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  
					?>

					document.getElementById("btn_submit").disabled = "disabled";

					return true;
				}
			</script>
		</section>
		<!-- } 게시물 작성/수정 끝 -->
	</div>
</div>