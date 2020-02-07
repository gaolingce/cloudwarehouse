
<?php

$openid = $_GET["openid"];
$conn = mysqli_connect("localhost", "root", "root", "cloudwarehouse");

if (!$conn)
    echo "数据库连接失败！";
else{
    $sql_name = "SELECT wh_commodityId FROM warehouse WHERE openid = '$openid'";
    $result_name = mysqli_query($conn,$sql_name);

    $name = array();
	while($row = mysqli_fetch_row($result_name)) {
        $name[]=$row;  
    } 
    for($i = 0;$i<sizeof($name);$i++)
    {
    $sql_getUnit = "SELECT commodityUnit_conversion,commodityName FROM commodity WHERE commodityId = '{$name[$i][0]}'";
        $result_unit = mysqli_query($conn,$sql_getUnit);
        $as =  mysqli_fetch_row($result_unit);
         $name[$i][3] = $as[0];
         $name[$i][4] = $as[1];

         $sql_getBag = "SELECT wh_commodityBag FROM warehouse WHERE wh_commodityId = '{$name[$i][0]}'";
         $result_bag = mysqli_query($conn,$sql_getBag);
         $box = mysqli_fetch_row($result_bag);
            $name[$i][1] = intval(floor($box[0]/$as[0]));
            $name[$i][2] = $box[0] % $as[0];
        
    }

    array_multisort(array_column($name,'1'),SORT_ASC,$name); 

     echo json_encode($name);
     
    

}
?>