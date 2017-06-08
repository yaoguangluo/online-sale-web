<?php
include dirname(_FILE_).'/configs/config.php';
$smarty->assign("email",$_GET['email']);
$smarty->assign("key",$_GET['key']);
$smarty->assign("miaodian","<script>window.location.href='#miaodian'</script>");
$smarty->display('goods/policy.mnb');
?>
