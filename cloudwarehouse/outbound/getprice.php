<?php

$buyerid = $_GET['buyerid'];
$commodityid = $_GET['commodityid'];

$conn = mysqli_connect("localhost", "root", "root", "cloudwarehouse");

if (!$conn)
    echo "数据库连接失败！";
else {
        $search = "SELECT buyerPrice FROM buyer_defaultprice WHERE buyerId = '$buyerid' AND buyer_CommodityID = '$commodityid' ";
        $result = mysqli_query($conn,$search);
        $name = array();
        while($row = mysqli_fetch_row($result)) {   //只能用一次
                $name[]=$row;  
        } 
        
        echo json_encode($name);
}
?>