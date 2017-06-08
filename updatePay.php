<?php
        include dirname(_FILE_).'/configs/config.php';
        //echo "<script>alert('good')</script>"
        Header("Access-Control-Allow-Origin: * ");
        Header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE"); 


        echo $link = "http://".$CFG['main']['webSite']['backendIp'].$CFG['backend']['pay']['updateSend']."?sendWay=".$_GET['sendWay']."&key=".$_GET['key']."&packageNumber=".urlencode($_GET['packageNumber'])."&paypalId=".urlencode($_GET['paypalId']);
        
        $url=$link;



        $ch = curl_init();  
        $this_header=array("Content-type: text/plain; charset=UTF-8");
        curl_setopt($ch,CURLOPT_HTTPHEADER,$this_header);
        curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回 
        $output = curl_exec($ch) ;  
        $output=json_decode($output);
  //*/    
         curl_close($ch);
        unset($ch);  
        echo $output;//$output);
?>
