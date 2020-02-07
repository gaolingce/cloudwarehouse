
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
 
$conn = mysqli_connect("localhost", "root", "root", "cloudwarehouse");

if (!$conn)
    echo "数据库连接失败！";
else {

    $sql_getUnit = "SELECT commodityUnit_conversion FROM commodity WHERE commodityId = '$id'";
    $result_unit = mysqli_query($conn,$sql_getUnit);
    $unit =  mysqli_fetch_row($result_unit);
    $amount = $box * $unit[0] + $bag;

    $sql_search = "SELECT wh_commodityId FROM warehouse WHERE wh_commodityId = '$id'";
    $result_search = mysqli_query($conn,$sql_search);
    
    if(! mysqli_fetch_row($result_search)){     //如果仓库里没有此商品
        echo -1;
        return;
    }

    $sql_getAmount = "SELECT wh_commodityBag FROM warehouse WHERE wh_commodityId = '$id'";
    $amonut_warehouse_sql = mysqli_fetch_row(mysqli_query($conn,$sql_getAmount));
    $amonut_warehouse = $amonut_warehouse_sql[0];     //仓库总袋数

    $sql_Unitprice = "SELECT commodityCost FROM commodity WHERE commodityId = '$id'";
    $Unitprice_sql = mysqli_fetch_row(mysqli_query($conn,$sql_Unitprice));
    $Unitprice = $Unitprice_sql[0];                 //仓库单价/袋

    $in_price = $price / $front_unit;               //入库单价/袋

    $new_price = ($amount * $in_price + $amonut_warehouse * $Unitprice) / ($amount+$amonut_warehouse);
    //新的单价     
    $sql_updateprice = "UPDATE commodity SET commodityCost = '$new_price' WHERE commodityId = '$id'";
    $result_updateprice = mysqli_query($conn,$sql_updateprice);   



    $sql_update = "UPDATE warehouse SET wh_commodityBag = wh_commodityBag + '$amount' WHERE wh_commodityId = '$id'";
    $result_update = mysqli_query($conn,$sql_update);    // 添加到仓库

    
    $sql_inbound = "INSERT INTO inboundlist (inboundlist_commodityId,inboundlist_commodityName,inboundlistPrice,inboundlistAmount,inboundlistBag,inboundlistDate,operationTime,openid) VALUES ('$id','$name','$price','$amount' * '$in_price','$amount','$date','$subdate','$openid') ";
    $result_inbound = mysqli_query($conn,$sql_inbound);
    if(!($result_update) || !($result_inbound)){
        echo"更新失败";
    }
    else
        echo $id;


}

?>