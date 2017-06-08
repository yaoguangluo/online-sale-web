<?php
include dirname(_FILE_).'/configs/config.php';

        Header("Access-Control-Allow-Origin: * ");
        Header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        $ch = curl_init("http://".$CFG['main']['webSite']['backendIp']
                                 .$CFG['backend']['goods']['showItem']
                                 ."?iid=".$_GET['iid']
                                 );  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回 
        $output = curl_exec($ch) ;  
        $output=json_decode($output);
        curl_close($ch);
        unset($ch);
        $smarty->assign("link",$link);
        $key=$_GET['key'];
        $smarty->assign("email",$_GET['email']);
        $smarty->assign("count",$_GET['count']);
        $smarty->assign("key",$key);
        $smarty->assign("item",$output->{'item'});
        $smarty->assign("miaodian","<script>window.location.href='#miaodian'</script>");
        $smarty->display('goods/item.mnb'); 
     
?>
