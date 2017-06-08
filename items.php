<?php
include dirname(_FILE_).'/configs/config.php';

        Header("Access-Control-Allow-Origin: * ");
        Header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

if(""==$_GET['cid'])
{
    $_GET['cid']=0;
}
if(""==$_GET['bid'])
{
    $_GET['bid']=0;
}
if(""==$_GET['vid'])
{
    $_GET['vid']=0;
}

        $link = "http://".$CFG['main']['webSite']['backendIp']
                                 .$CFG['backend']['goods']['showItems']
                                 ."?cid=".$_GET['cid']
                                 ."&bid=".$_GET['bid']
                                 ."&vid=".$_GET['vid']
                                 ."&type=".$_GET['type']
                                 ."&currentPage=".$_GET['page']; 

        $ch = curl_init("http://".$CFG['main']['webSite']['backendIp']
                                 .$CFG['backend']['goods']['showItems']
                                 ."?cid=".$_GET['cid']
                                 ."&bid=".$_GET['bid']
                                 ."&vid=".$_GET['vid']
                                 ."&type=".$_GET['type']
                                 ."&currentPage=".$_GET['page']);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回 
        $output = curl_exec($ch) ;  
        $output=json_decode($output);
        curl_close($ch);
        unset($ch);
       //echo $currentPage=$output->{'currentPage'};
      // echo $totalPage=$output->{'totalPage'};
       //echo $totalPage=$output->{'itemList'};
        $smarty->assign("link",$link);
        $key=$_GET['key'];
        $smarty->assign("email",$_GET['email']);
        $smarty->assign("key",$key);
        $smarty->assign("type",$_GET['type']);
        $smarty->assign("cid",$_GET['cid']);
        $smarty->assign("currentPage",$output->{'currentPage'});
        $smarty->assign("totalPage",$output->{'totalPage'});
        $smarty->assign("itemList",$output->{'itemList'});
        $smarty->assign("miaodian","<script language='javascript'>window.location.href='#miaodian'</script>");
        $smarty->display('goods/items.mnb'); 
     
?>
