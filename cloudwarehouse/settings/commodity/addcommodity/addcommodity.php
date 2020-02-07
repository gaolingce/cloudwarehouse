
<?php

$openid = $_GET["openid"];
$name = $_GET["name"];
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
else {

    $search = "SELECT commodityName FROM commodity WHERE commodityName = '$name'";
    $s_result = mysqli_query($conn,$search);

    if(mysqli_num_rows($s_result)){
        echo"false";

    }
    else {
    $sql = "INSERT INTO commodity ( commodityName , commodityCost , commodityCategory , commodityUnit_conversion, commoditySeller , commodityBarcode , openid ) VALUES ( '$name' , '$cost' ,'$category','$unit','$seller','$barcode','$openid')";
    $result = mysqli_query($conn,$sql);
    if(!($result)){
        echo"插入失败";
    }
    else
        echo"插入成功";
    }
}

?>