<?php
include dirname(_FILE_).'/configs/config.php';


$smarty->assign("email",$_GET['email']);
$smarty->assign("key",$_GET['key']);

//$code=rand(1000,9999);

//$smarty->assign("code",$code);
$smarty->display('login/loginBack.mnb');
?>
