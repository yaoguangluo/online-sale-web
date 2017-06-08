<?php
        include dirname(_FILE_).'/configs/config.php';
        
        Header("Access-Control-Allow-Origin: * ");
        Header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");  
        //$ch = curl_init("http://104.54.190.178:8080/minibuy-engine/goods/showVendor?vid=1"); 
        $ch = curl_init("http://".$CFG['main']['webSite']['backendIp']."".$CFG['backend']['cart']['updateCart']."?cartId=".$_GET['cartId']."&key=".$_GET['key']."&count=".$_GET['count']);//.$_GET['key']); 
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回 
        $output = curl_exec($ch) ;  
        $output=json_decode($output);
        curl_close($ch);
        unset($ch);
        echo $output;//$output);
?>
