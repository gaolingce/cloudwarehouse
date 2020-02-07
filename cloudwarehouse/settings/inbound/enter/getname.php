
<?php

$openid = $_GET["openid"];
$conn = mysqli_connect("localhost", "root", "root", "cloudwarehouse");

if (!$conn)
    echo "数据库连接失败！";
else{
    $sql = "SELECT commodityId,commodityName,commodityCost,commodityCategory,commodityUnit_conversion,commoditySeller,commodityBarcode FROM commodity WHERE openid = '$openid'";
    $result = mysqli_query($conn,$sql);

    $name = array();    
	while($row = mysqli_fetch_assoc($result)) {
        $name[]=$row;  
    } 
    
    array_multisort(array_column($name,'commodityName'),SORT_DESC,$name); 
    echo json_encode($name);
}
?>