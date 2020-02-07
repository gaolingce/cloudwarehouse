<?php

$commodityid = $_GET["commodityid"];
$bag = $_GET["bag"];
$box = $_GET["box"];
$name = $_GET["name"];
$buyer = $_GET["buyer"];
$buyerid = $_GET["buyerid"];
$sellprice = $_GET["sellprice"];
$total = $_GET["total"];
$date = $_GET["date"];
$subdate = $_GET["subdate"];
$openid = $_GET["openid"];


$conn = mysqli_connect("localhost", "root", "root", "cloudwarehouse");

if (!$conn)
    echo "数据库连接失败！";
else {
    $sql_getUnit = "SELECT commodityUnit_conversion FROM commodity WHERE commodityId = '$commodityid'";
    $result_unit = mysqli_query($conn,$sql_getUnit);
    $unit =  mysqli_fetch_row($result_unit);
    $amount = $box * $unit[0] + $bag;                       //amount为总bag数量

    $sql_outbound = "INSERT INTO outboundlist (outbound_commodityId,outbound_commodityName,outboundBag,outboundPrice,outboundTotalprice,outboundBuyer,outbound_buyerId,outboundDate,operationTime,openid) VALUES ('$commodityid','$name','$amount','$sellprice','$total','$buyer','$buyerid','$date','$subdate','$openid') ";
    $result_outbound = mysqli_query($conn,$sql_outbound);        //创建出库表

    $sql_modify = "UPDATE warehouse SET wh_commodityBag = wh_commodityBag - '$amount' WHERE wh_commodityId = '$commodityid'";
    $result_modify = mysqli_query($conn,$sql_modify); 

    if(!($result_outbound) || !($result_modify)){
        echo"更新失败";
    }
    else
        echo $commodityid;

}
?>