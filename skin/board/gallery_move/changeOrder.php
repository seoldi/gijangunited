<?php
include_once('../../../common.php');

if ($is_member && ($is_admin == 'super' || $group['gr_admin'] == $member['mb_id'] || $board['bo_admin'] == $member['mb_id'])) {
	for ($i=0; $i<count($_POST['order_wr_id']); $i++){
		$wr_1 = $_POST['biggest'] - $i;
		$sql = " update ".$write_table." set wr_1 = '".$wr_1."' where wr_id = '".$_POST['order_wr_id'][$i]."' ";
		sql_query($sql);
	}
}