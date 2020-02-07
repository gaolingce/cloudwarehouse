
<?php

$openid = $_GET["openid"];
$name = $_GET["name"];
$conn = mysqli_connect("localhost", "root", "root", "cloudwarehouse");

if (!$conn)
    echo "数据库连接失败！";
else{
    $sql = "SELECT buyerName FROM buyer WHERE buyerName = '$name'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)){
        echo"false";
    }
}
?>