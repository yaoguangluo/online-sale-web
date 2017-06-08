<?php
include dirname(_FILE_).'/configs/config.php';

        Header("Access-Control-Allow-Origin: * ");
        Header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

       //$text=$_POST['text'];
       //echo $text=urlencode($text);


       $url="http://".$CFG['main']['webSite']['backendIp'].$CFG['backend']['login']['login']."?email=".urlencode($_POST['text'])."&password=".urlencode($_POST['password']);
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
            $key=$output->{'key'};
            $email=$output->{'email'};
            $smarty->assign("email",$email);
            $smarty->assign("key",$key);
            $_GET['key']=$key;
            $_GET['email']=$email;
             // echo "->".$_POST['link'];
            if("cart.php"==$_POST['link'])
            {
                  Header("Access-Control-Allow-Origin: * ");
                    Header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");  
                    //$link = "http://".$CFG['main']['webSite']['backendIp']."".$CFG['backend']['cart']['showCart']."?page=".$_GET['currentPage']."&key=".$_GET['key']; 
                    $ch = curl_init("http://".$CFG['main']['webSite']['backendIp']."".$CFG['backend']['cart']['showCart']."?currentPage=0&key=".$key);//.$_GET['key']); 
                    //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
                    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回 
                    $output = curl_exec($ch); 
                    $output = json_decode($output);   
                    curl_close($ch);
        unset($ch);
                    if(1==$output->{'status'})
                        {
           // $smarty->assign("link",$encode);
                            $smarty->assign("link",$link);
                            $smarty->assign("cartList",$output->{'cartList'});
                            $smarty->assign("currentPage",$output->{'currentPage'});
                            $smarty->assign("totalPage",$output->{'totalPage'});    
                            $smarty->assign("_GET", $_GET);
                            //$smarty->assign("email",$_GET['email']);
                            //$smarty->assign("key",$_GET['key']);
                            $smarty->assign("miaodian","<script>window.location.href='#miaodian'</script>");
                            $smarty->display('cart/cart.mnb');
                        }else{
                                 //  $smarty->assign("link",$encode);
                 
                                 $smarty->display('login/login.mnb'); 
                             } 
            }

            if("addToCart.php"==$_POST['link'])
            {
                    Header("Access-Control-Allow-Origin: * ");
                    Header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");  
                    //$ch = curl_init("http://104.54.190.178:8080/minibuy-engine/goods/showVendor?vid=1"); 
                    $ch = curl_init("http://".$CFG['main']['webSite']['backendIp']."".$CFG['backend']['cart']['addCart']."?iid=".$_POST['iid']."&key=".$key);//.$_GET['key']); 
                    //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
                    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回 
                     $output = curl_exec($ch) ;  
                    $output=json_decode($output);
                    curl_close($ch);
        unset($ch);
                    echo "<script>alert('added to cart')</script>";
            }
                 $smarty->assign("_GET", $_GET);
                 $smarty->display('goods/index.mnb'); 

        }else{
               //  $smarty->assign("link",$encode);
                 $smarty->display('login/login.mnb'); 
             } 
?>
