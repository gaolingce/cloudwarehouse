
<?php

$name = $_GET["name"];
$id = $_GET["id"];
$box = $_GET["box"];
$bag = $_GET["bag"];
$date = $_GET["date"];
$subdate = $_GET["subdate"];
$openid = $_GET["openid"];
$price = $_GET["price"];
$front_unit = $_GET["unit"];
 
$conn = mysqli_connect("localhost", "root", "root","cloudwarehouse");

if (!$conn)
    echo "数据库连接失败！";
else {
    
    $sql_getUnit = "SELECT commodityUnit_conversion FROM commodity WHERE commodityId = '$id'";
    $result_unit = mysqli_query($conn,$sql_getUnit);
    $unit =  mysqli_fetch_row($result_unit);
    $amount = $box * $unit[0] + $bag;


    $sql_new = "INSERT INTO warehouse VALUES ('$id','$name','$amount','$openid')";
    $result_update = mysqli_query($conn,$sql_new);

    $in_price = $price / $front_unit; 
    
    $sql_inbound = "INSERT INTO inboundlist (inboundlist_commodityId,inboundlist_commodityName,inboundlistPrice,inboundlistAmount,inboundlistBag,inboundlistDate,operationTime,openid) VALUES ('$id','$name','$price','$amount' * '$in_price','$amount','$date','$subdate','$openid') ";
    $result_inbound = mysqli_query($conn,$sql_inbound);

    if(!($result_update) || !($result_inbound)){
        echo"更新失败";
    }
    else
        echo $id;
}

?>
