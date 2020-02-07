
<?php

$box = $_GET["box"];
$bag = $_GET["bag"];
$id = $_GET["id"];

$conn = mysqli_connect("localhost", "root", "root", "cloudwarehouse");

if (!$conn)
    echo "数据库连接失败！";
else {
    $sql_getUnit = "SELECT commodityUnit_conversion FROM commodity WHERE commodityId = '$id'";
    $result_unit = mysqli_query($conn,$sql_getUnit);
    $unit =  mysqli_fetch_row($result_unit);
    $amount = $box * $unit[0] + $bag;

    $sql_search = "SELECT wh_commodityBag FROM warehouse WHERE wh_commodityId = '$id'";
    $result_search = mysqli_query($conn,$sql_search);
    $warehouseamount = mysqli_fetch_row($result_search);
    if($amount <= $warehouseamount[0]){
        echo "可以入库";
    }
    else
        echo -1;
}

?>
