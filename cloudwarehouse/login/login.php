
<?php
//声明CODE，获取小程序传过来的CODE
$code = $_GET["code"];
//配置appid
$appid = "wxaf74f4bf9a40154d";
//配置appscret
$secret = "306fe16ef72ed457046a9b7c303a63cf";
//api接口
$api = "https://api.weixin.qq.com/sns/jscode2session?appid={$appid}&secret={$secret}&js_code={$code}&grant_type=authorization_code";
//获取GET请求
function httpGet($url){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_URL, $url);
    $res = curl_exec($curl);
    curl_close($curl);
    return $res;
}
//发送
$str = httpGet($api);
echo $str;

?>

