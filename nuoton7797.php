<?php

ob_start();

$API_KEY = '1624545639:AAFLBQt4ZLqdwdOPXLTS1aCglXjlbG8WUeU';
define('API_KEY',$API_KEY);
function bndr($method,$datas=[]{
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}else{
return json_decode($res);
}
}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$text = $ message->text;
$chat_id = $message->chat->id

if($text =='/start'){
bndr('sendMessage',[
'chat_id'=>$chat_id,
'text'=>'أهلاً بكم في الفهرس، لا يزال البوت قيد التطوير، لا تقم بحظر البوت رجاءً كي يصلك تنبيه عند تفعيل البوت'
]);
}
if($text =='/help'){
bndr('sendMessage',[
'chat_id'=>$chat_id,
'text'=>'هدف البوت هو وضع فهرس لأغلبية القنوات العربية الهادفة والمسلية ووضعها أمام المستخدمين ليتمكنوا من الاشتراك بالقنوات التي تهمهم بدلا من البحث عنها عشوائيا، إن موعد انتهاء تطوير البوت غير محدد بعدد نظراً للوقت الطويل الذي تستهلكه البرمجة'
]);
}

?>
