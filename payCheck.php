<?php
include dirname(_FILE_).'/configs/config.php';
include dirname(_FILE_).'/configs/function.php';

        Header("Access-Control-Allow-Origin: * ");
        Header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

//cvv
$cvv=(int)$_GET['cvv'];
$expireMonth=(int)$_GET['expireMonth'];
$expireYear=(int)$_GET['expireYear'];


   $link1="http://".$CFG['main']['webSite']['backendIp'].$CFG['backend']['pay']['doPaymentSandbox']."?postalCode=".$_GET['postalCode']."&cvv=".$cvv."&countryCode=".$_GET['countryCode']."&state=".$_GET['state']."&city=".$_GET['city']."&address=".urlencode($_GET['address'])."&subTotal=".$_GET['subTotal']."&tax=".$_GET['tax']."&shipping=".$_GET['shipping']."&currency=".$_GET['currency']."&cardNumber=".$_GET['cardNumber']."&expireYear=".$expireYear."&expireMonth=".$expireMonth."&firstName=".$_GET['firstName']."&lastName=".$_GET['lastName']."&cardType=".$_GET['cardType']."&total=".$_GET['total']."&payInfo=".urlencode($_GET['payInfo'])."&key=".$_GET['key']."&shippingAddress=".urlencode($_GET['shippingAddress']);

$ch=curl_init("http://".$CFG['main']['webSite']['backendIp'].$CFG['backend']['pay']['doPaymentSandbox']."?postalCode=".$_GET['postalCode']."&cvv=".$cvv."&countryCode=".$_GET['countryCode']."&state=".$_GET['state']."&city=".$_GET['city']."&address=".urlencode($_GET['address'])."&subTotal=".$_GET['subTotal']."&tax=".$_GET['tax']."&shipping=".$_GET['shipping']."&currency=".$_GET['currency']."&cardNumber=".$_GET['cardNumber']."&expireYear=".$expireYear."&expireMonth=".$expireMonth."&firstName=".$_GET['firstName']."&lastName=".$_GET['lastName']."&cardType=".$_GET['cardType']."&total=".$_GET['total']."&payInfo=".urlencode($_GET['payInfo'])."&key=".$_GET['key']."&shippingAddress=".urlencode($_GET['shippingAddress']));

        
        $this_header=array("Content-type: text/plain; charset=UTF-8");
        curl_setopt($ch,CURLOPT_HTTPHEADER,$this_header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回 
         $output = curl_exec($ch) ;  
         $smarty->assign("link",$output);
        $output = json_decode($output);  
curl_close($ch);
        unset($ch);
       if(1==$output->{'status'})
        {
           // $smarty->assign("link",$encode);
            $smarty->assign("link1",$link1);
               $smarty->assign("payInfo",$output->{'payInfo'});
               $smarty->assign("payTotal",$_GET['total']);
               $smarty->assign("paypalId",$output->{'paypalId'});
               $smarty->assign("email",$_GET['email']);
               $smarty->assign("key",$_GET['key']);
               $smarty->assign("miaodian","<script>window.location.href='#miaodian'</script>");
               $smarty->display('pay/payResult.mnb');
        }else{
               //  $smarty->assign("link",$encode);
                 $smarty->display('login/login.mnb'); 
             } 
       // echo $output->{'status'};
              //  $smarty->assign("status",$output->{'status'});
               //*/
?>
