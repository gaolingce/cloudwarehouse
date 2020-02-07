
<?php

$name = $_GET["name"];
$id = $_GET["id"];
$conn = mysqli_connect("localhost", "root", "root", "cloudwarehouse");

if (!$conn)
    echo "数据库连接失败！";
else{
    $sql = "UPDATE buyer SET buyerName = '$name' WHERE buyerId = $id";
    $result = mysqli_query($conn,$sql);
        if(!($result)){
            echo"更改失败";
        }
        else
            echo"更改成功";
}
?>