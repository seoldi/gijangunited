<?php
// 중복 선언 방지
if (!function_exists('getTeamClass')) {
  function getTeamClass($teamName)
  {
    $map = [
      "기장군민축구단" => "gijang",
      "진주시민축구단" => "jinju",
      "거제시민축구단" => "geoje",
      "남양주시민축구단" => "namyangju",
      "당진시민축구단" => "dangjin",
      "대구FC" => "daegu",
      "서울중랑축구단" => "jungrang",
      "세종SA" => "sejong",
      "연천FC" => "yeoncheon",
      "평택시티즌FC" => "pyeongtaek",
      "평창유나이티드FC" => "pyeongchang",
    ];
    return $map[$teamName] ?? 'default';
  }
}

if (!function_exists('render_game_box')) {
  function render_game_box($row)
  {
    $home_team  = $row['wr_5'];
    $home_score = $row['wr_6'];
    $away_team  = $row['wr_7'];
    $away_score = $row['wr_8'];
    $place      = $row['wr_4'];
    $datetime_raw = str_replace('T', ' ', $row['wr_2']);
    $timestamp = strtotime($datetime_raw);
    $yoil = ['일', '월', '화', '수', '목', '금', '토'];
    $formatted_date = date('m월 d일', $timestamp) . '(' . $yoil[date('w', $timestamp)] . ') ' . date('H:i', $timestamp);

    ob_start();
?>
    <div class="cont">
      <div class="game">
        <div class="club">
          <p class="emblem">
            <img src="<?php echo G5_THEME_IMG_URL ?>/game/<?php echo getTeamClass($home_team); ?>.svg" alt="<?php echo $home_team ?>">
          </p>
          <p class="name"><?php echo $home_team ?></p>
        </div>
        <div class="score"><?php echo $home_score ?></div>
      </div>
      <div class="versus">:</div>
      <div class="game">
        <div class="score"><?php echo $away_score ?></div>
        <div class="club">
          <p class="emblem">
            <img src="<?php echo G5_THEME_IMG_URL ?>/game/<?php echo getTeamClass($away_team); ?>.svg" alt="<?php echo $away_team ?>">
          </p>
          <p class="name"><?php echo $away_team ?></p>
        </div>
      </div>
    </div>
    <div class="schedule" style="background-color:#091932;">
      <?php echo $formatted_date ?> <?php echo $place ?>
    </div>
<?php
    return ob_get_clean();
  }
}
?>