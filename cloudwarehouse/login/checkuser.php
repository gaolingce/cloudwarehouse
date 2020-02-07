<?php   
    
    $openid = $_GET["openid"];

    $conn = mysqli_connect("localhost", "root", "root", "cloudwarehouse");
    if (!$conn)
        echo "数据库连接失败！";
    else{
        $sql = "SELECT * FROM user WHERE openid = '$openid'";
        
        $result = mysqli_query($conn,$sql);

        if(!mysqli_num_rows($result)){

            echo"用户不存在，新建用户openid";
            $newUser = "INSERT INTO user (openid) VALUES ('$openid')" ;
            $result2 = mysqli_query($conn,$newUser);
                if(!($result2)){
                 echo"用户插入失败！";
             }
                else
                    echo"用户插入成功";
            }
            
            else{
                echo"用户已经存在";
            }
            

    }


?>