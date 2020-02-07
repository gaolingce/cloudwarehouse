<?php
    $openid = $_GET['openid'];
    $today = $_GET['today'];
    $lastmonth = $_GET['lastmonth'];
    $num = $_GET['page'];                        //当前页数
     
$conn = mysqli_connect("localhost", "root", "root", "cloudwarehouse");

if (!$conn)
    echo "数据库连接失败！";
else {
    $sqlcount = "SELECT count(*) as count from outboundlist WHERE openid = '$openid' AND outboundDate BETWEEN '$lastmonth' AND '$today'";
    $resultcount = mysqli_query($conn,$sqlcount);
    $pages_res = mysqli_fetch_row($resultcount);  


    $tag = 10 ; 
    $pages = $pages_res[0];                             //总页数
    $lastpages = $pages - $num * 10 ;
    $frontpage = $lastpages - 10;   
                           //后十页
    if($frontpage < 0 ) {
        $frontpage = 0;
        $tag = $lastpages;
    }

    if($lastpages <= 0){
        echo -1;
        return;
    }

    $sql = "SELECT outboundId,outbound_commodityName,outboundBag,outboundTotalprice,outboundDate,operationTime,outbound_commodityId,outboundBuyer FROM outboundlist WHERE openid = '$openid' AND outboundDate BETWEEN '$lastmonth' AND '$today' LIMIT $frontpage,$tag";
    $result = mysqli_query($conn,$sql);

    $name = array();    
	while($row = mysqli_fetch_row($result)) {
        $name[]=$row;  
    } 

    for($i = 0;$i<sizeof($name);$i++){

         $sqlunit = "SELECT commodityUnit_conversion FROM commodity WHERE commodityId = '{$name[$i][6]}'";
         $unitres = mysqli_query($conn,$sqlunit);
         $as =  mysqli_fetch_row($unitres);
        //  $name[$i][7] = $as[0];
         
         $name[$i][8] = intval(floor($name[$i][2] /$as[0]));
         $name[$i][2] = $name[$i][2]  % $as[0];
     }

     
    array_multisort(array_column($name,'5'),SORT_DESC,$name); 
    echo json_encode($name);

    
}




?>