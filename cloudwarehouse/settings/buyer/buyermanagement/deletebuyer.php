<?php   

$id = $_GET["id"];
$conn = mysqli_connect("localhost", "root", "root", "cloudwarehouse");
if (!$conn)
    echo "数据库连接失败！";
else{
    $sql = "UPDATE buyer SET openid = concat(openid,'_deleted'), buyerName = concat(buyerName,'_deleted') WHERE buyerId = '$id'";
    $result = mysqli_query($conn,$sql);
    if(!($result)){
        echo"删除失败";
    }
    else
        echo"删除成功";
}
?>