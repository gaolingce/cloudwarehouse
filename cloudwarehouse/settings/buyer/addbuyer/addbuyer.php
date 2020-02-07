
<?php

    $openid = $_GET["openid"];
    $name = $_GET["name"];
    $conn = mysqli_connect("localhost", "root", "root", "cloudwarehouse");
    
    if (!$conn)
        echo "数据库连接失败！";
    else{
        $sql = "INSERT INTO buyer ( buyerName , openid ) VALUES ( '$name' , '$openid')";
        $result = mysqli_query($conn,$sql);
        if(!($result)){
            echo"插入失败";
        }
        else
            echo"插入成功";

    }
    echo $name;
?>