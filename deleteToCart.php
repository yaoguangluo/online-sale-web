<?php
        include dirname(_FILE_).'/configs/config.php';
        
        Header("Access-Control-Allow-Origin: * ");
        Header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");  
        //$ch = curl_init("http://104.54.190.178:8080/minibuy-engine/goods/showVendor?vid=1"); 
        $ch = curl_init("http://".$CFG['main']['webSite']['backendIp']."".$CFG['backend']['cart']['deleteCart']."?cartId=".$_GET['cartId']."&key=".$_GET['key']);//.$_GET['key']); 
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回 
        $output = curl_exec($ch) ;  
        curl_close($ch);
        unset($ch);

        $ch = curl_init("http://".$CFG['main']['webSite']['backendIp']."".$CFG['backend']['cart']['showCart']."?page=".$_GET['currentPage']."&key=".$_GET['key']);//.$_GET['key']); 
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回 
        $output = curl_exec($ch) ; 
        $output=json_decode($output);
       curl_close($ch);
        unset($ch);


if(1==$output->{'status'})
        {
           // $smarty->assign("link",$encode);
                $smarty->assign("cartList",$output->{'cartList'});
                $smarty->assign("currentPage",$output->{'currentPage'});
                $smarty->assign("totalPage",$output->{'totalPage'});
     
                $smarty->assign("email",$_GET['email']);
                $smarty->assign("key",$_GET['key']);
                $smarty->assign("miaodian","<script>window.location.href='#miaodian'</script>");
                $smarty->display('cart/cart.mnb');
        }else{
               //  $smarty->assign("link",$encode);
                 $smarty->display('login/login.mnb'); 
             } 
?>
