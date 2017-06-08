<?php
include dirname(_FILE_).'/configs/config.php';





$url="http://".$CFG['main']['webSite']['backendIp'].$CFG['backend']['login']['passwordSend']."?email=".urlencode($_POST['text']);
        // $url=URLEncoder.encode($url, "UTF-8");
        //$encode = mb_detect_encoding($url, array("ASCII","UTF-8","GB2312","GBK","BIG5")); 
        // $post_data = iconv('UTF-8', 'GB2312', $post_data);
        $ch = curl_init();  
        $this_header=array("Content-type: text/plain; charset=UTF-8");
        curl_setopt($ch,CURLOPT_HTTPHEADER,$this_header);
        curl_setopt($ch, CURLOPT_URL, $url);
       // curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回 
        $output = curl_exec($ch) ;  
        $output=json_decode($output);
        curl_close($ch);
        unset($ch);
//$smarty->assign("code",$code);
//
        if(1==$output->{'status'})  
        {
              $smarty->assign("result","success, please check your email");
        } else{
                   $smarty->assign("result","error, please try again or call (626)476-5378");
                }
        $smarty->display('login/findPasswordResult.mnb');
?>
