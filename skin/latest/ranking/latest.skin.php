<?php
if (!defined('_GNUBOARD_')) exit;

// CSS 연결
add_stylesheet('<link rel="stylesheet" href="' . $latest_skin_url . '/style.css">', 0);

sql_query("alter table $write_table change `wr_2` `wr_2` int(11) default '0'", false);

$list_count = (is_array($list) && $list) ? count($list) : 0;

// 팀명에 따른 이미지 클래스 매칭 함수
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
    return isset($map[$teamName]) ? $map[$teamName] : "default";
  }
}
?>

<table class="ranking_table" style="width: 100%;">
  <thead>
    <tr>
      <th>순위</th>
      <th>팀명</th>
      <th>승점</th>
      <th>승</th>
      <th>무</th>
      <th>패</th>
      <th>골득실</th>
      <th>경기수</th>
    </tr>
  </thead>
  <tbody>
    <?php for ($i = 0; $i < $list_count; $i++) {
      $rank        = $i + 1;
      $team_name   = $list[$i]['wr_1'];
      $point       = $list[$i]['wr_2'];
      $win         = $list[$i]['wr_3'];
      $draw        = $list[$i]['wr_4'];
      $lose        = $list[$i]['wr_5'];
      $gd          = $list[$i]['wr_6'];
      $games       = $list[$i]['wr_7'];
      $team_class  = getTeamClass($team_name);
    ?>
      <tr>
        <td><?php echo $rank; ?></td>
        <td>
          <!-- <img src="<?php echo G5_THEME_IMG_URL ?>/game/<?php echo $team_class; ?>.svg" alt="<?php echo $team_name ?>" style="height: 20px; vertical-align: middle; margin-right: 6px;"> -->
          <?php echo $team_name; ?>
        </td>
        <td><?php echo $point; ?></td>
        <td><?php echo $win; ?></td>
        <td><?php echo $draw; ?></td>
        <td><?php echo $lose; ?></td>
        <td><?php echo $gd; ?></td>
        <td><?php echo $games; ?></td>
      </tr>
    <?php } ?>
    <?php if ($list_count == 0) { ?>
      <tr>
        <td colspan="8" style="text-align: center;">등록된 팀 정보가 없습니다.</td>
      </tr>
    <?php } ?>
  </tbody>
</table>
