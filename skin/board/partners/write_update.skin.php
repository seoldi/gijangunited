<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


if ($w == '') {
	$sql = " update ".$write_table." set wr_1 = '".$wr_id."' where wr_id = '".$wr_id."' ";
	sql_query($sql);
}
