
<?php

$openid = $_GET["openid"];
$conn = mysqli_connect("localhost", "root", "root", "cloudwarehouse");

if (!$conn)
    echo "数据库连接失败！";
else{
    $sql = "SELECT buyerId,buyerName FROM buyer WHERE openid = '$openid'";
    $result = mysqli_query($conn,$sql);

    $name = array();    
	while($row = mysqli_fetch_assoc($result)) {
        $name[]=$row;  
    } 
    
    array_multisort(array_column($name,'buyerName'),SORT_ASC,$name); 
    echo json_encode($name);
}
?>