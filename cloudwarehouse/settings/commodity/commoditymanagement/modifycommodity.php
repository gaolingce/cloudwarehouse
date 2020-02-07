
<?php

$name = $_GET["name"];
$id = $_GET["id"];
$openid = $_GET["openid"];
$cost = $_GET["cost"];
$category = $_GET["category"];
$unit = $_GET["unit"];
$barcode = $_GET["barcode"];
$seller = $_GET["seller"];

if($category == 0)
    $category = "冷冻";
else
    $category = "常温";

$conn = mysqli_connect("localhost", "root", "root", "cloudwarehouse");

if (!$conn)
    echo "数据库连接失败！";
else{
    $sql = "UPDATE commodity SET commodityName = '$name' , commodityCost ='$cost', commodityCategory='$category',commodityUnit_conversion='$unit',commoditySeller='$seller',commodityBarcode='$barcode'  WHERE commodityId = $id";
    $result = mysqli_query($conn,$sql);
        if(!($result)){
            echo"更改失败";
        }
        else
            echo"更改成功";
}
?>