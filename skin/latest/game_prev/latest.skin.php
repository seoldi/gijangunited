<?php
if (!defined('_GNUBOARD_')) exit;

include_once(G5_THEME_PATH . '/skin/latest/game_box.php'); // render_game_box 함수 포함

$today = date('Y-m-d H:i:s');
$last_game = null;

foreach ($list as $row) {
  if (empty($row['wr_2'])) continue;

  // 날짜 포맷 보정 (datetime-local 형식 대응)
  $game_time = strpos($row['wr_2'], 'T') !== false
    ? str_replace('T', ' ', $row['wr_2'])
    : $row['wr_2'];

  // 오늘 이전의 경기 중 가장 최근 것 하나만
  if (strtotime($game_time) < strtotime($today)) {
    if (!$last_game || strtotime($game_time) > strtotime($last_game['wr_2'])) {
      $last_game = $row;
    }
  }
}

if ($last_game) {
  echo render_game_box($last_game); // 지난 경기 1건 출력
} else {
  echo '<p class="empty_li">지난 경기가 없습니다.</p>';
}
