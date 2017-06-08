<?php
include dirname(_FILE_).'/configs/config.php';

        Header("Access-Control-Allow-Origin: * ");
        Header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

       // $link = "http://".$CFG['main']['webSite']['backendIp']
        //                         .$CFG['backend']['goods']['showItem']
         //                        ."?cid=".$_GET['cid']
        //                         ."&type=".$_GET['type']
         //                        ."&currentPage=".$_GET['page']; 

        $ch = curl_init("http://".$CFG['main']['webSite']['backendIp']
                                 .$CFG['backend']['pay']['findTotal']
                                 ."?key=".$_GET['key']
                                 );  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回 
        $output = curl_exec($ch) ;  
        $output=json_decode($output);
curl_close($ch);
        unset($ch);
       //echo $currentPage=$output->{'currentPage'};
       //echo $totalPage=$output->{'totalPage'};
       //echo $totalPage=$output->{'itemList'};
        $subTotal=$output->{'subtotal'};
        $rate=0.095;
        if(30<$subTotal)
        {
           $ship=0.0;
        }else
            {
               $ship=8.0; 
            }
        $tax=$subTotal*$rate;
        $total=$subTotal+$ship+$tax;
        $total= round($total ,2);
        $tax= round($tax ,2);
        $smarty->assign("ship",$ship);
        $smarty->assign("tax",$tax);
        $smarty->assign("total",$total);
        $smarty->assign("subTotal",$output->{'subtotal'});
        $smarty->assign("payInfo",$output->{'payInfo'});
        $smarty->assign("link",$link);
        $key=$_GET['key'];
        $smarty->assign("email",$_GET['email']);
        $smarty->assign("key",$key);
        $smarty->assign("item",$output->{'item'});

        $link="http://".$CFG['main']['webSite']['backendIp'].$CFG['backend']['pay']['getCardsByGid']."?key=".$_GET['key']."&currentPage=".$_GET['currentPage'];
        $ch = curl_init("http://".$CFG['main']['webSite']['backendIp'].$CFG['backend']['pay']['getCardsByGid']."?key=".$_GET['key']."&currentPage=".$_GET['currentPage']);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回 
        $output = curl_exec($ch) ;  
        $output=json_decode($output);  
            curl_close($ch);
        unset($ch);   

if(1==$output->{'status'})
        {
           // $smarty->assign("link",$encode);
             $smarty->assign("link",$link);
                $smarty->assign("status",$output->{'status'});
                $smarty->assign("cardList",$output->{'cardList'});
                $smarty->assign("currentPage",$output->{'currentPage'});
                $smarty->assign("totalPage",$output->{'totalPage'});
                $smarty->assign("miaodian","<script>window.location.href='#miaodian'</script>");
                $smarty->display('cart/pay.mnb');  
        }else{
               //  $smarty->assign("link",$encode);
                 $smarty->display('login/login.mnb'); 
             } 




?>
