<?php
if (!defined('_GNUBOARD_')) exit;

include_once(G5_THEME_PATH . '/skin/latest/game_box.php'); // 공통 렌더 함수 포함

$today = date('Y-m-d'); // 현재 날짜만 추출
$found = false;

foreach ($list as $row) {
  if (empty($row['wr_2'])) continue;

  // wr_2가 '2025-04-15' 또는 '2025-04-15T15:00:00'일 수도 있으므로 정리
  $game_date = substr($row['wr_2'], 0, 10); // 앞의 날짜만 자름 (YYYY-MM-DD)

  // 날짜 비교
  if (strtotime($game_date) >= strtotime($today)) {
    echo render_game_box($row);
    $found = true;
    break;
  }
}

if (!$found) {
  echo '<p class="empty_li">다음 경기가 없습니다.</p>';
}
