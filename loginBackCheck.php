<?php
include dirname(_FILE_).'/configs/config.php';

        Header("Access-Control-Allow-Origin: * ");
        Header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");


        $url="http://".$CFG['main']['webSite']['backendIp'].$CFG['backend']['login']['loginBack']."?email=".urlencode($_POST['text'])."&password=".urlencode($_POST['password']);
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
        if(1==$output->{'status'})
        {
           // $smarty->assign("link",$encode);
            
                $link = "http://".$CFG['main']['webSite']['backendIp'].$CFG['backend']['pay']['getPayInfoByPage']."?key=".$output->{'key'}."&currentPage=0"; 
                $key=$output->{'key'};
                $ch = curl_init("http://".$CFG['main']['webSite']['backendIp'].$CFG['backend']['pay']['getPayInfoByPage']."?key=".$output->{'key'}."&currentPage=0");  

                $this_header=array("Content-type: text/plain; charset=UTF-8");
                curl_setopt($ch,CURLOPT_HTTPHEADER,$this_header);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
                curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回 
                $output = urldecode(curl_exec($ch)) ; 
                // echo $encode = mb_detect_encoding($output, array("ASCII","UTF-8","GB2312","GBK","BIG5")); 
                $output=json_decode($output);
                curl_close($ch);
        unset($ch);
                //var_dump($output);     
                if(1==$output->{'status'})
                {
                    // $smarty->assign("link",$encode);
                    $smarty->assign("link",$link);
                    $smarty->assign("email",$_GET['email']);
                    $smarty->assign("key",$key);
                    $smarty->assign("currentPage",$output->{'currentPage'});
                    $smarty->assign("totalPage",$output->{'totalPage'});
                     $smarty->assign("payList",$output->{'payList'});
                     $smarty->assign("miaodian","<script>window.location.href='#miaodian'</script>");
                    $smarty->display('cart/payInfoBack.mnb'); 
                }else{
                        //  $smarty->assign("link",$encode);
                         $smarty->display('login/loginBack.mnb'); 
                     } 
                     
        }else{
               //  $smarty->assign("link",$encode);
                 $smarty->display('login/loginBack.mnb'); 
             } 
?>
