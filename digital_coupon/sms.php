<?php
header("Content-Type:text/html;charset=utf-8");
include("connection.php");

$car=$_POST['car'];
$phone_find=mysqli_query($conn,"SELECT * FROM driver INNER JOIN car ON driver.Driver_ID=car.Driver_ID WHERE Car_plat_No='$car'");
$phone_result=mysqli_fetch_assoc($phone_find);
$phone=$phone_result['Driver_Mobile'];
$name=$phone_result['Driver_Name'];
$apikey = "7d019f9b9f96bd5d3cd4b216cd071201"; //修改为您的apikey(https://www.yunpian.com)登录官网后获取
$mobile = $phone; //请用自己的手机号代替
$text="【MMU】您的验证码是1234";
$ch = curl_init();

/* 设置验证方式 */

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:text/plain;charset=utf-8', 'Content-Type:application/x-www-form-urlencoded','charset=utf-8'));

/* 设置返回结果为流 */
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

/* 设置超时时间*/
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

/* 设置通信方式 */
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// 取得用户信息
$json_data = get_user($ch,$apikey);
$array = json_decode($json_data,true);

// 发送短信
$data=array('text'=>$text,'apikey'=>$apikey,'mobile'=>$mobile);
$json_data = send($ch,$data);
$array = json_decode($json_data,true);

// 发送模板短信
// 需要对value进行编码
$data=array('tpl_id'=>'1898460','tpl_value'=>('#name#').'='.urlencode($name),'apikey'=>$apikey,'mobile'=>$mobile);
print_r ($data);
$json_data = tpl_send($ch,$data);
$array = json_decode($json_data,true);



curl_close($ch);

/***************************************************************************************/
//获得账户
function get_user($ch,$apikey){
    curl_setopt ($ch, CURLOPT_URL, 'https://sms.yunpian.com/v2/user/get.json');
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('apikey' => $apikey)));
    return curl_exec($ch);
}
function send($ch,$data){
    curl_setopt ($ch, CURLOPT_URL, 'https://sms.yunpian.com/v2/sms/single_send.json');
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    return curl_exec($ch);
}
function tpl_send($ch,$data){
    curl_setopt ($ch, CURLOPT_URL, 'https://sms.yunpian.com/v2/sms/tpl_single_send.json');
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    return curl_exec($ch);
}

?>