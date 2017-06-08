<?php
include dirname(_FILE_).'/configs/config.php';

if($_POST['newPassword']==$_POST['newPasswordAgain'])
{
        Header("Access-Control-Allow-Origin: * ");
        Header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        $ch = curl_init("http://".$CFG['main']['webSite']['backendIp']
                                 .$CFG['backend']['login']['changePassword']
                                 ."?email=".$_POST['text']
                                 ."&password=".$_POST['password']
                                 ."&newPassword=".$_POST['newPassword']
                                 ."&key=".$_POST['key']
                                 );  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回 
        $output = curl_exec($ch) ;  
        $output = json_decode($output);
        curl_close($ch);
        unset($ch);
        if(1==$output->{'status'})
        {
            $key=$output->{'key'};
            $email=$output->{'email'};
            $smarty->assign("email",$email);
            $smarty->assign("key",$key);
            $smarty->display('goods/index.mnb'); 
        }
}
        //echo $output->{'key'};
       $smarty->display('login/changePassword.mnb'); 
?>
