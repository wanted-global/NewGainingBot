<?php
ob_start();
define('API_KEY','توكنك');
echo file_get_contents("https://api.telegram.org/bot".API_KEY."/setwebhook?url=".$_SERVER['SERVER_NAME']."".$_SERVER['SCRIPT_NAME']);

function bot($method,$datas=[]){
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

$Dev = array("572206438");
$usernamebot = "bot";
$channel = "yyycy";
$admin = 000;
$channelcode = "codebot";
$token = API_KEY;

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$username = $message->from->username;
$textmassage = $message->text;
$firstname = $update->callback_query->from->first_name;
$usernames = $update->callback_query->from->username;
$chatid = $update->callback_query->message->chat->id;
$fromid = $update->callback_query->from->id;
$name = $update->message->from->first_name;
$membercall = $update->callback_query->id;

$nammee = $update->callback_query->from->first_name;
$data = $update->callback_query->data;
$messageid = $update->callback_query->message->message_id;
$tc = $update->message->chat->type;
$gpname = $update->callback_query->message->chat->title;
$forward_from = $update->message->forward_from;
$forward_from_id = $forward_from->id;
$forward_from_username = $forward_from->username;
$forward_from_first_name = $forward_from->first_name;
$reply = $update->message->reply_to_message->forward_from->id;
$reply_username = $update->message->reply_to_message->forward_from->username;
$reply_first = $update->message->reply_to_message->forward_from->first_name;

$forchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$channel."&user_id=".$from_id));
$tch = $forchannel->result->status;
$forchannelq = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$channel."&user_id=".$fromid));
$tchq = $forchannelq->result->status;

function SendMessage($chat_id, $text){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$text,
'parse_mode'=>'MarkDown']);
}
 function Forward($berekoja,$azchejaei,$kodompayam)
{
bot('ForwardMessage',[
'chat_id'=>$berekoja,
'from_chat_id'=>$azchejaei,
'message_id'=>$kodompayam
]);
}
function  getUserProfilePhotos($token,$from_id) {
  $url = 'https://api.telegram.org/bot'.$token.'/getUserProfilePhotos?user_id='.$from_id;
  $result = file_get_contents($url);
  $result = json_decode ($result);
  $result = $result->result;
  return $result;
}
function getChatMembersCount($chat_id,$token) {
  $url = 'https://api.telegram.org/bot'.$token.'/getChatMembersCount?chat_id=@'.$chat_id;
  $result = file_get_contents($url);
  $result = json_decode ($result);
  $result = $result->result;
  return $result;
}
function getChatstats($chat_id,$token) {
  $url = 'https://api.telegram.org/bot'.$token.'/getChatAdministrators?chat_id=@'.$chat_id;
  $result = file_get_contents($url);
  $result = json_decode ($result);
  $result = $result->ok;
  return $result;
}

@$user = json_decode(file_get_contents("data/user.json"),true);
@$juser = json_decode(file_get_contents("data/$from_id.json"),true);
@$cuser = json_decode(file_get_contents("data/$fromid.json"),true);

if(!in_array($from_id, $user["userlist"]) == true) {
$user["userlist"][]="$from_id";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
    }

if(in_array($from_id, $user["blocklist"])) {
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"أنت محظور من البوت 🚫
بسبب عدم اتباعك للقوانين.

-",
'reply_markup'=>json_encode(['KeyboardRemove'=>[
],'remove_keyboard'=>true
])
    		]);
}
if(preg_match("/^\/(start) (code)_(.*)/s",$textmassage)){
   preg_match("/^\/(start) (code)_(.*)/s",$textmassage,$matchaa);
  $codematch = $matchaa[3];
  $code = $user["codecoin"];
  if ($codematch == $code) {
  $coincode = $user["howcoincode"];

           bot('sendmessage',[
          	'chat_id'=>$chat_id,
          	'text'=>"تم الحصول على النقاط بنجاح ✅

  تمت إضافة $coincode إلى حسابك 💰
  ",
                 'reply_markup'=>json_encode([
                     'inline_keyboard'=>[
  				   [
               ['text'=>"رجوع ↪️",'callback_data'=>'panel']
  				   ],
                       ]
                 ])
   ]);
   bot('sendmessage',[
    'chat_id'=>"@$channelcode",
    'text'=>"تهانينا 💸❗️
حصل [ $first_name ]
على الهدية : $code
التي قيمتها ($coincode)
ألف مبارك 💐

-"
]);
  unset($user["codecoin"]);
  unset($user["howcoincode"]);
  $user = json_encode($user,true);
  file_put_contents("data/user.json",$user);
  $coin = $juser["userfild"]["$from_id"]["coin"];
  $coinplus = $coin + $coincode;
  $juser["userfild"]["$from_id"]["coin"]="$coinplus";
  $juser = json_encode($juser,true);
  file_put_contents("data/$from_id.json",$juser);
  }
  else
  {
  	bot('sendmessage',[
          	'chat_id'=>$chat_id,
          	'text'=>"لم تنجح العملية :(

  ⚠️ بسبب خطأ في الرمز أو تم أخذه من قبل شخص آخر",
                 'reply_markup'=>json_encode([
                     'inline_keyboard'=>[
  				   [
               ['text'=>"رجوع ↪️",'callback_data'=>'panel']
  				   ],
                       ]
                 ])
   ]);
  }
}
if($textmassage=="/start" && $tc == "private" and !preg_match("/^\/(start) (code)_(.*)/s",$textmassage)){
if(in_array($from_id, $user["userlist"]) == true) {
bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"اهلاً بك: [$name](tg://user?id=$chat_id)

🔘 في بوت زيادة الأعضاء

▪️قم بزيادة أعضاء قناتك وزيادة متابعيك

⚙️|أنشئ رابطك وقم بالاشتراك بالقنوات
💡| وقم بعمل تمويل لقناتك
-",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
   	'reply_markup'=>json_encode([
  	'inline_keyboard'=>[
                 [['text'=>"تجميع نقاط",'callback_data'=>'takecoinn'],['text'=>"تمويل قناتك 📣",'callback_data'=>'takemember']],
           [['text'=>"حسابك 👤",'callback_data'=>'accont']],
           [['text'=>"الدعم",'callback_data'=>'sup'],['text'=>"شرح البوت 📰",'callback_data'=>'learn']],
	  	],
	  	'resize_keyboard'=>true,
  	])
  	]);

$arr = $user['finance'];
$channel = array_rand($arr);
$channelincoin = $arr[$channel][1];
$channelssssss = $arr[$channel][0];
$join = file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=$channelssssss&user_id=".$from_id);
if((strpos($join,'"status":"left"') or strpos($join,'"Bad Request: USER_ID_INVALID"') or strpos($join,'"status":"kicked"')) !== false){
if(!in_array($channelssssss, $juser["userfild"]["$from_id"]["channeljoin"])) {
if($channelincoin > 0){
$text_add = "انضم إلى القناة ".$arr[$channel][0]." ✅
 واحصل على 10 نقاط 💰";
           bot('sendmessage',[
          	'chat_id'=>$chat_id,
          	'text'=>$text_add,
                 'reply_markup'=>json_encode([
                     'inline_keyboard'=>[
  				   [
               ['text'=>"تحقق من الانضمام ♻️",'callback_data'=>"finance_".$channel]
  				   ],
                       ]
                 ])
   ]);
}else {
@$usernew = json_decode(file_get_contents("data/user.json"),true);
unset($usernew['finance'][$channel]);
$usernew = json_encode($usernew,true);
file_put_contents("data/user.json",$usernew);
}
}
}
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
else
{
  bot('sendmessage',[
  	'chat_id'=>$chat_id,
  	'text'=>"اهلاً بك: [$name](tg://user?id=$chat_id)

  🔘 في بوت زيادة الأعضاء

  ▪️قم بزيادة أعضاء قناتك وزيادة متابعيك

  ⚙️|أنشئ رابطك وقم بالاشتراك بالقنوات
  💡| وقم بعمل تمويل لقناتك
  -",
  'parse_mode'=>"MarkDown",
  'disable_web_page_preview'=>true,
     	'reply_markup'=>json_encode([
    	'inline_keyboard'=>[
                 [['text'=>"تجميع نقاط",'callback_data'=>'takecoinn'],['text'=>"تمويل قناتك 📣",'callback_data'=>'takemember']],
           [['text'=>"حسابك 👤",'callback_data'=>'accont']],
           [['text'=>"الدعم",'callback_data'=>'sup'],['text'=>"شرح البوت 📰",'callback_data'=>'learn']],

  	  	],
  	  	'resize_keyboard'=>true,
    	])
    	]);
$arr = $user['finance'];
$channel = array_rand($arr);
$channelincoin = $arr[$channel][1];
$channelssssss = $arr[$channel][0];
$join = file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=$channelssssss&user_id=".$from_id);
if((strpos($join,'"status":"left"') or strpos($join,'"Bad Request: USER_ID_INVALID"') or strpos($join,'"status":"kicked"')) !== false){
if(!in_array($channelssssss, $juser["userfild"]["$from_id"]["channeljoin"])) {
if($channelincoin > 0){
$text_add = "انضم إلى القناة ".$arr[$channel][0]." ✅
 واحصل على 10 نقاط 💰";
           bot('sendmessage',[
          	'chat_id'=>$chat_id,
          	'text'=>$text_add,
                 'reply_markup'=>json_encode([
                     'inline_keyboard'=>[
  				   [
               ['text'=>"تحقق من الانضمام ♻️",'callback_data'=>"finance_".$channel]
  				   ],
                       ]
                 ])
   ]);
}else {
@$usernew = json_decode(file_get_contents("data/user.json"),true);
unset($usernew['finance'][$channel]);
$usernew = json_encode($usernew,true);
file_put_contents("data/user.json",$usernew);
}
}
}
$juser = json_decode(file_get_contents("data/$from_id.json"),true);
$juser["userfild"]["$from_id"]["invite"]="0";
$juser["userfild"]["$from_id"]["coin"]="0";
$juser["userfild"]["$from_id"]["setchannel"]="لا يوجد !";
$juser["userfild"]["$from_id"]["setmember"]="لا يوجد !";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
}
elseif(strpos($textmassage , '/start ') !== false   and !preg_match("/^\/(start) (code)_(.*)/s",$textmassage)) {
$start = str_replace("/start ","",$textmassage);
if(in_array($from_id, $user["userlist"])) {
  bot('sendmessage',[
  	'chat_id'=>$chat_id,
  	'text'=>"اهلاً بك: [$name](tg://user?id=$chat_id)

  🔘 في بوت زيادة الاعضاء

  ▪️قم بزيادة أعضاء قناتك وزيادة متابعيك

  ⚙️|أنشئ رابطك وقم بالاشتراك بالقنوات
  💡| وقم بعمل تمويل لقناتك
  -",
  'parse_mode'=>"MarkDown",
  'disable_web_page_preview'=>true,
     	'reply_markup'=>json_encode([
    	'inline_keyboard'=>[
                 [['text'=>"تجميع نقاط",'callback_data'=>'takecoinn'],['text'=>"تمويل قناتك 📣",'callback_data'=>'takemember']],
           [['text'=>"حسابك 👤",'callback_data'=>'accont']],
           [['text'=>"الدعم",'callback_data'=>'sup'],['text'=>"شرح البوت 📰",'callback_data'=>'learn']],

  	  	],
  	  	'resize_keyboard'=>true,
    	])
    	]);
$arr = $user['finance'];
$channel = array_rand($arr);
$channelincoin = $arr[$channel][1];
$channelssssss = $arr[$channel][0];
$join = file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=$channelssssss&user_id=".$from_id);
if((strpos($join,'"status":"left"') or strpos($join,'"Bad Request: USER_ID_INVALID"') or strpos($join,'"status":"kicked"')) !== false){
if(!in_array($channelssssss, $juser["userfild"]["$from_id"]["channeljoin"])) {
if($channelincoin > 0){
$text_add = "انضم إلى القناة ".$arr[$channel][0]." ✅
 واحصل على 10 نقاط 💰";
           bot('sendmessage',[
          	'chat_id'=>$chat_id,
          	'text'=>$text_add,
                 'reply_markup'=>json_encode([
                     'inline_keyboard'=>[
  				   [
               ['text'=>"تحقق من الانضمام ♻️",'callback_data'=>"finance_".$channel]
  				   ],
                       ]
                 ])
   ]);
}else {
@$usernew = json_decode(file_get_contents("data/user.json"),true);
unset($usernew['finance'][$channel]);
$usernew = json_encode($usernew,true);
file_put_contents("data/user.json",$usernew);
}
}
}
}
else
{
$juser = json_decode(file_get_contents("data/$from_id.json"),true);
$inuser = json_decode(file_get_contents("data/$start.json"),true);
$member = $inuser["userfild"]["$start"]["invite"];
$coin = $inuser["userfild"]["$start"]["coin"];
$memberplus = $member + 1;
$coinplus = $coin  + 1;
bot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"اهلاً بك: [$name](tg://user?id=$chat_id)

🔘 في بوت زيادة الأعضاء

▪️قم بزيادة أعضاء قناتك وزيادة متابعيك

⚙️|أنشئ رابطك وقم بالاشتراك بالقنوات
💡| وقم بعمل تمويل لقناتك
-",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
    'reply_markup'=>json_encode([
    'inline_keyboard'=>[
              [['text'=>"تجميع نقاط",'callback_data'=>'takecoinn'],['text'=>"تمويل قناتك 📣",'callback_data'=>'takemember']],
           [['text'=>"حسابك 👤",'callback_data'=>'accont']],
           [['text'=>"الدعم",'callback_data'=>'sup'],['text'=>"شرح البوت 📰",'callback_data'=>'learn']],

      ],
      'resize_keyboard'=>true,
    ])
    ]);
$arr = $user['finance'];
$channel = array_rand($arr);
$channelincoin = $arr[$channel][1];
$channelssssss = $arr[$channel][0];
$join = file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=$channelssssss&user_id=".$from_id);
if((strpos($join,'"status":"left"') or strpos($join,'"Bad Request: USER_ID_INVALID"') or strpos($join,'"status":"kicked"')) !== false){
if(!in_array($channelssssss, $juser["userfild"]["$from_id"]["channeljoin"])) {
if($channelincoin > 0){
$text_add = "انضم إلى القناة ".$arr[$channel][0]." ✅
 واحصل على 10 نقاط 💰";
           bot('sendmessage',[
          	'chat_id'=>$chat_id,
          	'text'=>$text_add,
                 'reply_markup'=>json_encode([
                     'inline_keyboard'=>[
  				   [
               ['text'=>"تحقق من الانضمام ♻️",'callback_data'=>"finance_".$channel]
  				   ],
                       ]
                 ])
   ]);
}else {
@$usernew = json_decode(file_get_contents("data/user.json"),true);
unset($usernew['finance'][$channel]);
$usernew = json_encode($usernew,true);
file_put_contents("data/user.json",$usernew);
}
}
}
$inuser["userfild"]["$start"]["invite"]="$memberplus";
$inuser["userfild"]["$start"]["coin"]="$coinplus";
$inuser = json_encode($inuser,true);
file_put_contents("data/$start.json",$inuser);
$juser["userfild"]["$from_id"]["invite"]="0";
$juser["userfild"]["$from_id"]["coin"]="0";
$juser["userfild"]["$from_id"]["setchannel"]="لا يوجد !";
$juser["userfild"]["$from_id"]["setmember"]="لا يوجد !";
$juser["userfild"]["$from_id"]["inviter"]="$start";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
}
elseif($cuser["userfild"]["$fromid"]["channeljoin"] == true){
$allchannel = $cuser["userfild"]["$fromid"]["channeljoin"];
for($z = 0;$z <= count($allchannel) -1;$z++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$allchannel[$z]."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}
}
if($allchannel[$z] == true){
if(in_array($allchannel[$z], $user["channellist"])) {
     bot('answercallbackquery', [
              'callback_query_id' =>$membercall,
            'text' => "تم خصم نقطتين من نقاطك بسبب مغادرة @$allchannel[$z] القناة ⚠️",
            'show_alert' =>false
         ]);
unset($cuser["userfild"]["$fromid"]["channeljoin"][$z]);
$cuser["userfild"]["$fromid"]["channeljoin"]=array_values($cuser["userfild"]["$fromid"]["channeljoin"]);
$coin = $cuser["userfild"]["$fromid"]["coin"];
$pluscoin = $coin - 2;
$cuser["userfild"]["$fromid"]["coin"]="$pluscoin";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
}

if($allchannel[$z] == true){
if(in_array($allchannel[$z], $user["channellist"])) {
     bot('SendMessage', [
              'chat_id'=>$chatid,
            'text' => "⚠️ عذرا عزيزي ❗️
لقد قمت بمغادرة قنوات ولا يمكنك طلب أعضاء 🚫.
إلا عند رجوعك إلى القنوات 📜

▪️ملاحضة:- عند مغادرتك أي من القنوات يتم خصم نقطتين لكل قناة

▪️اشترك واستعد قنواتك 🌐
@$allchannel[$z]

▪️بعدها اضغط على تحديث",
            'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [['text'=>"تحديث",'callback_data'=>'takecoin']]
                     ]
               ])
         ]);
unset($cuser["userfild"]["$fromid"]["channeljoin"][$z]);
$cuser["userfild"]["$fromid"]["channeljoin"]=array_values($cuser["userfild"]["$fromid"]["channeljoin"]);
$coin = $cuser["userfild"]["$fromid"]["coin"];
$pluscoin = $coin - 2;
$cuser["userfild"]["$fromid"]["coin"]="$pluscoin";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
}
}
if($data=="learn"){
 bot('editmessagetext',[
          'chat_id'=>$chatid,
       'message_id'=>$messageid,
       'text'=>"📰 | شرح البوت.

💡طريقة عمل البوت تكون بتحويل النقاط الى اعضاء يتم اضافتهم الى قناتك .

🔘 تكسب النقاط من خلال :
 - الانضمام بقنوات = 2 نقطة 💰: يعطيك 2 مقابل انضمامك لقناة واحده,
⚠️ في حال كنت قد غادرت إحدى القنوات التي أخذت نقاط مقابل الانضمام فيها يتم خصم نقاط منك ولن تتمكن من التجميع أيضا ,

- مشاركة الرابط = 1 نقطة 💰: يعطيك 1 مقابل كل شخص جديد يدخل البوت من خلال رابطك.


بعد أن تقوم بجمع 10 نقاط على الأقل اضغط على ( تمويل قناتك 📣 )
 يتم تحويل النقاط الى اعضاء بهذا المقياس :
 2 = 1 👤
 20 = 10 👤
بعد أن تقوم بطلب الأعضاء 👤 سيتم إضافة قناتك في  ( الاشتراك بالقنوات ),
  سينضم الأعضاء بقناتك مقابل نقطتين لكل عضو .

بعد اكتمال دخول الأعضاء سيتم إعلامك بانتهاء طلبك وانتهاء دخول العدد الذي طلبته 👤
:)",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
         ]);
}
if($data=="panel"){
  bot('editmessagetext',[
          'chat_id'=>$chatid,
       'message_id'=>$messageid,
       'text'=>"اهلاً بك: [$nammee](tg://user?id=$chatid)

     🔘 في بوت زيادة الأعضاء

     ▪️قم بزيادة أعضاء قناتك وزيادة متابعيك

     ⚙️|أنشئ رابطك وقم بالاشتراك بالقنوات
     💡| وقم بعمل تمويل لقناتك
     -",
     'parse_mode'=>"MarkDown",
     'disable_web_page_preview'=>true,
         'reply_markup'=>json_encode([
         'inline_keyboard'=>[
                [['text'=>"تجميع نقاط",'callback_data'=>'takecoinn'],['text'=>"تمويل قناتك 📣",'callback_data'=>'takemember']],
           [['text'=>"حسابك 👤",'callback_data'=>'accont']],
           [['text'=>"الدعم",'callback_data'=>'sup'],['text'=>"شرح البوت 📰",'callback_data'=>'learn']],
           ],
           'resize_keyboard'=>true,

         ])
         ]);
$cuser = json_decode(file_get_contents("data/$fromid.json"),true);
$cuser["userfild"]["$fromid"]["file"]="none";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}

elseif($data=="takecoinn" ){
  bot('editmessagetext',[
                  'chat_id'=>$chatid,
       'message_id'=>$messageid,
                 'text'=>"▪️حسنا ♥️.
▪️ماذا تريد أن تفعل الآن .؟
-",
                 'reply_markup'=>json_encode([
                     'inline_keyboard'=>[
  				   [
  				   ['text'=>"الاشتراك بالقنوات",'callback_data'=>"takecoin"],['text'=>"مشاركة الرابط",'callback_data'=>'member']
  				   ],
             [
               ['text'=>"رمز الهدية 💰",'callback_data'=>'code']
             ],
             [
               ['text'=>"رجوع ↪️",'callback_data'=>'panel']
             ],
  [
  				   ],
                       ]
                 ])
  	]);
}
elseif($data=="code"){
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"رمز الهدية 💰

قم بجلبه من قناة ( @$channelcode ) وأرسله إلى هنا ⚙️
💡للحصول على نقاط مجانية",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
$cuser["userfild"]["$fromid"]["file"]="takecodecoin";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'takecodecoin') {
$code = $user["codecoin"];
if ($textmassage == $code) {
$coincode = $user["howcoincode"];
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"تم الحصول على النقاط بنجاح ✅

تمت إضافة $coincode إلى حسابك 💰
",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
             ['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
unset($user["codecoin"]);
unset($user["howcoincode"]);
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
$coin = $juser["userfild"]["$from_id"]["coin"];
$coinplus = $coin + $coincode;
$juser["userfild"]["$from_id"]["coin"]="$coinplus";
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
else
{
	bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"لم تنجح العملية :(

⚠️بسبب خطأ في الرمز أو تم أخذه من قبل شخص آخر",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
             ['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
}
}
elseif($data=="takecoin" ){
$rules = $cuser["userfild"]["$fromid"]["acceptrules"];
if($rules == false){
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"انتظر عزيزي ♥️'
عليك قراءة جميع القنوانين :-
▪️كل اشتراك بقناة تحصل على نقطة واحدة
▪️إذا قمت بمغادرة قناة فإنه يتم خصم نقطتين من كل قناة تغادرها
▪️عند إضافة قناة غير أخلاقية يتم حذفها وحظرك من استخدام البوت

▫️ملاحظة:- إذا كانت لديك مشكلة مع قناة أو عند ظهور قناة منحرفة
عليك التبليغ من خلال كلمة الدعم ويتم حذفها مباشرة.

 اضغط الآن على بدء التجميع ☑️",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"بدء التجميع",'callback_data'=>"takecoin"],['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
[
				   ],
                     ]
               ])
	]);
$cuser["userfild"]["$fromid"]["acceptrules"]="true";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
		   }
else
{
if($tchq != 'member' && $tchq != 'creator' && $tchq != 'administrator'){
$join = $cuser["userfild"]["$fromid"]["canceljoin"];
if($join == false){
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"▪️عزيزي اشترك بالقناة الرئيسية ( - )
⚠️ عند اشتراكك ستحصل على نقطتين .

بعد الاشتراك اضغط على كلمة [التالي 💰]",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [['text'=>"اشتراك",'url'=>"https://t.me/$channel"]],
                     [['text'=>"التالي 💰",'callback_data'=>'mainchannel'],['text'=>"مشترك مسبقا ❗️",'callback_data'=>'takecoin']],
                     [['text'=>"رجوع ↪️",'callback_data'=>'panel']],
                     ]
               ])
			   ]);
$cuser["userfild"]["$fromid"]["canceljoin"]="true";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
else
{
$allchannel = $user["channellist"];
for($z = 0;$z <= count($allchannel);$z++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[$z]."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}
}
if ($allchannel[$z] == true){
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$name = $getchat["result"]["title"];
$username = $getchat["result"]["username"];
$id = $getchat["result"]["id"];
if($username != "" and $username != null){
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"اشترك بالقناة ،♥️
▫️اسم القناة [ $name ]
▫️معرف القناة ( @$username  )

ثم اضغط على التالي 💰",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [['text'=>"اشتراك",'url'=>"https://t.me/$username"]],
                   [['text'=>"التالي 💰",'callback_data'=>'truechannel'],['text'=>"تخطي 🗑",'callback_data'=>'nextchannel']],
                   [['text'=>"ابلاغ 📛",'callback_data'=>'badchannel'],['text'=>"رجوع ↪️",'callback_data'=>'panel']]
                     ]
               ])
			   ]);
$cuser["userfild"]["$fromid"]["getjoin"]="$username";
$cuser["userfild"]["$fromid"]["arraychannel"]="$z";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}else
{
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"انتهت القنوات المضافة 📩'
يرجى المحاولة مرة أخرى .
اضغط على تحديث أو رجوع ↪️❗️",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"تحديث",'callback_data'=>'takecoin'],['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
}
else
{
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"انتهت القنوات المضافة 📩'
يرجى المحاولة مرة أخرى .
اضغط على تحديث أو رجوع ↪️❗️",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"تحديث",'callback_data'=>'takecoin'],['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
}
}
else
{
$allchannel = $user["channellist"];
for($z = 0;$z <= count($allchannel);$z++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[$z]."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}
}
if ($allchannel[$z] == true){
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$name = $getchat["result"]["title"];
$username = $getchat["result"]["username"];
$id = $getchat["result"]["id"];
if($username != "" and $username != null){
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"اشترك بالقناة ،♥️
▫️اسم القناة [ $name ]
▫️معرف القناة ( @$username  )

ثم اضغط على التالي 💰",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [['text'=>"اشتراك",'url'=>"https://t.me/$username"]],
                   [['text'=>"التالي 💰",'callback_data'=>'truechannel'],['text'=>"تخطي 🗑",'callback_data'=>'nextchannel']],
                   [['text'=>"ابلاغ 📛",'callback_data'=>'badchannel'],['text'=>"رجوع ↪️",'callback_data'=>'panel']]
                     ]
               ])
			   ]);
$cuser["userfild"]["$fromid"]["getjoin"]="$username";
$cuser["userfild"]["$fromid"]["arraychannel"]="$z";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}else
{
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"انتهت القنوات المضافة 📩'
يرجى المحاولة مرة أخرى .
اضغط على تحديث أو رجوع ↪️❗️",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"تحديث",'callback_data'=>'takecoin'],['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
}
else
{
  bot('editmessagetext',[
                  'chat_id'=>$chatid,
       'message_id'=>$messageid,
                 'text'=>"انتهت القنوات المضافة 📩'
  يرجى المحاولة مرة أخرى .
  اضغط على تحديث أو رجوع ↪️❗️",
                 'reply_markup'=>json_encode([
                     'inline_keyboard'=>[
  				   [
  				   ['text'=>"تحديث",'callback_data'=>'takecoin'],['text'=>"رجوع ↪️",'callback_data'=>'panel']
  				   ],
                       ]
                 ])
  			   ]);
}
}
}
}
elseif($data=="truechannel" ){
$getjoinchannel = $cuser["userfild"]["$fromid"]["getjoin"];
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$getjoinchannel."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
        bot('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "عذرا ❗️
اشترك بالقناة أولا :)
ثم اضغط على التالي",
            'show_alert' =>true
        ]);
}
else
{
$cuser = json_decode(file_get_contents("data/$fromid.json"),true);
$coin = $cuser["userfild"]["$fromid"]["coin"];
$arraychannel = $cuser["userfild"]["$fromid"]["arraychannel"];
$coinchannel = $user["setmemberlist"];
$channelincoin = $coinchannel[$arraychannel];
$downchannel = $channelincoin - 1;
$pluscoin = $coin + 1;
bot('answercallbackquery', [
           'callback_query_id' =>$membercall,
           'text' => "شكرا لاشتراكك بالقناة ♥️،
تم إضافة النقطة إلى نقاطك :
عدد النقاط :- ( $pluscoin )⚠️،",
           'show_alert' =>false
          ]);
$cuser["userfild"]["$fromid"]["channeljoin"][]="$getjoinchannel";
$cuser["userfild"]["$fromid"]["coin"]="$pluscoin";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
if($downchannel > 0){
@$user = json_decode(file_get_contents("data/user.json"),true);
$user["setmemberlist"]["$arraychannel"]="$downchannel";
$user["setmemberlist"]=array_values($user["setmemberlist"]);
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
@$user = json_decode(file_get_contents("data/user.json"),true);
$allchannel = $user["channellist"];
for($z = 0;$z <= count($allchannel);$z++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[$z]."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}
}
if ($allchannel[$z] == true){
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$name = $getchat["result"]["title"];
$username = $getchat["result"]["username"];
$id = $getchat["result"]["id"];
if($username != "" and $username != null){
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"اشترك بالقناة ،♥️
▫️اسم القناة [ $name ]
▫️معرف القناة ( @$username  )

ثم اضغط على التالي 💰",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [['text'=>"اشتراك",'url'=>"https://t.me/$username"]],
                   [['text'=>"التالي 💰",'callback_data'=>'truechannel'],['text'=>"تخطي 🗑",'callback_data'=>'nextchannel']],
                   [['text'=>"ابلاغ 📛",'callback_data'=>'badchannel'],['text'=>"رجوع ↪️",'callback_data'=>'panel']]
                     ]
               ])
			   ]);
$cuser = json_decode(file_get_contents("data/$fromid.json"),true);
$cuser["userfild"]["$fromid"]["getjoin"]="$username";
$cuser["userfild"]["$fromid"]["arraychannel"]="$z";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}else
{
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"انتهت القنوات المضافة 📩'
يرجى المحاولة مرة أخرى .
اضغط على تحديث أو رجوع ↪️❗️",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"تحديث",'callback_data'=>'takecoin'],['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
}
else
{
  bot('editmessagetext',[
                  'chat_id'=>$chatid,
       'message_id'=>$messageid,
                 'text'=>"انتهت القنوات المضافة 📩'
  يرجى المحاولة مرة أخرى .
  اضغط على تحديث أو رجوع ↪️❗️",
                 'reply_markup'=>json_encode([
                     'inline_keyboard'=>[
  				   [
  				   ['text'=>"تحديث",'callback_data'=>'takecoin'],['text'=>"رجوع ↪️",'callback_data'=>'panel']
  				   ],
                       ]
                 ])
  			   ]);
}
}
else
{
    $chhhhhhanel = $user["channellist"]["$arraychannel"];
    if($chhhhhhanel != "" and $chhhhhhanel != null){
	bot('sendmessage',[
	'chat_id'=>"-1001241680413",
	'text'=>"✅ تم إكمال تمويل القناة : ".$user["channellist"]["$arraychannel"],
  	]);
	bot('sendmessage',[
	'chat_id'=>$user["admin"]["$arraychannel"],
	'text'=>"✅ تم إكمال تمويل القناة : ".$user["channellist"]["$arraychannel"],
	                 'reply_markup'=>json_encode([
                     'inline_keyboard'=>[
  				   [
  				 ['text'=>"القائمة الرئيسية ⚙️",'callback_data'=>'panel']
  				   ],
                       ]
                 ])
  	]);
    }
unset($user["setmemberlist"]["$arraychannel"]);
unset($user["channellist"]["$arraychannel"]);
unset($user["admin"]["$arraychannel"]);
$user["channellist"]=array_values($user["channellist"]);
$user["setmemberlist"]=array_values($user["setmemberlist"]);
$user["admin"]=array_values($user["admin"]);
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
@$user = json_decode(file_get_contents("data/user.json"),true);
$allchannel = $user["channellist"];
for($z = 0;$z <= count($allchannel);$z++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[$z]."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}
}
if ($allchannel[$z] == true){
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$name = $getchat["result"]["title"];
$username = $getchat["result"]["username"];
$id = $getchat["result"]["id"];
if($username != "" and $username != null){
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"اشترك بالقناة ،♥️
▫️اسم القناة [ $name ]
▫️معرف القناة ( @$username  )

ثم اضغط على التالي 💰",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [['text'=>"اشتراك",'url'=>"https://t.me/$username"]],
                   [['text'=>"التالي 💰",'callback_data'=>'truechannel'],['text'=>"تخطي 🗑",'callback_data'=>'nextchannel']],
                   [['text'=>"ابلاغ 📛",'callback_data'=>'badchannel'],['text'=>"رجوع ↪️",'callback_data'=>'panel']]
                     ]
               ])
			   ]);
$cuser = json_decode(file_get_contents("data/$fromid.json"),true);
$cuser["userfild"]["$fromid"]["getjoin"]="$username";
$cuser["userfild"]["$fromid"]["arraychannel"]="$z";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}else
{
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"انتهت القنوات المضافة 📩'
يرجى المحاولة مرة أخرى .
اضغط على تحديث أو رجوع ↪️❗️",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"تحديث",'callback_data'=>'takecoin'],['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
}
else
{
  bot('editmessagetext',[
                  'chat_id'=>$chatid,
       'message_id'=>$messageid,
                 'text'=>"انتهت القنوات المضافة 📩'
  يرجى المحاولة مرة أخرى .
  اضغط على تحديث أو رجوع ↪️❗️",
                 'reply_markup'=>json_encode([
                     'inline_keyboard'=>[
  				   [
  				   ['text'=>"تحديث",'callback_data'=>'takecoin'],['text'=>"رجوع ↪️",'callback_data'=>'panel']
  				   ],
                       ]
                 ])
  			   ]);
}
}
}
}
elseif($data=="nextchannel" ){
 bot('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => " انتظر قليلا ⏳،",
            'show_alert' =>false
        ]);
$arraychannel = $cuser["userfild"]["$fromid"]["arraychannel"];
$plusarraychannel = $arraychannel + 1 ;
$allchannel = $user["channellist"];
for($z = $plusarraychannel;$z <= count($allchannel);$z++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[$z]."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}
}
if ($allchannel[$z] == true){
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$name = $getchat["result"]["title"];
$username = $getchat["result"]["username"];
$id = $getchat["result"]["id"];
if($username != "" and $username != null){
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"اشترك بالقناة ،♥️
▫️اسم القناة [ $name ]
▫️معرف القناة ( @$username  )

ثم اضغط على التالي 💰",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [['text'=>"اشتراك",'url'=>"https://t.me/$username"]],
                   [['text'=>"التالي 💰",'callback_data'=>'truechannel'],['text'=>"تخطي 🗑",'callback_data'=>'nextchannel']],
                   [['text'=>"ابلاغ 📛",'callback_data'=>'badchannel'],['text'=>"رجوع ↪️",'callback_data'=>'panel']]
                     ]
               ])
			   ]);
$cuser["userfild"]["$fromid"]["getjoin"]="$username";
$cuser["userfild"]["$fromid"]["arraychannel"]="$z";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}else
{
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"انتهت القنوات المضافة 📩'
يرجى المحاولة مرة أخرى .
اضغط على تحديث أو رجوع ↪️❗️",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"تحديث",'callback_data'=>'takecoin'],['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
}
else
{
  bot('editmessagetext',[
                  'chat_id'=>$chatid,
       'message_id'=>$messageid,
                 'text'=>"انتهت القنوات المضافة 📩'
  يرجى المحاولة مرة أخرى .
  اضغط على تحديث أو رجوع ↪️❗️",
                 'reply_markup'=>json_encode([
                     'inline_keyboard'=>[
  				   [
  				   ['text'=>"تحديث",'callback_data'=>'takecoin'],['text'=>"رجوع ↪️",'callback_data'=>'panel']
  				   ],
                       ]
                 ])
  			   ]);
}
}
elseif($data=="mainchannel" ){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$channel."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
  bot('answercallbackquery', [
      'callback_query_id' =>$membercall,
      'text' => "عذرا ❗️
اشترك بالقناة أولا :)
ثم اضغط على التالي",
      'show_alert' =>true
  ]);
}
else
{
$coin = $cuser["userfild"]["$fromid"]["coin"];
$pluscoin = $coin + 2;
bot('answercallbackquery', [
           'callback_query_id' =>$membercall,
           'text' => "شكرا لاشتراكك بالقناة ♥️،
تم إضافة النقطة إلى نقاطك :
عدد النقاط :- ( $pluscoin )⚠️،",
           'show_alert' =>false
          ]);
$cuser["userfild"]["$fromid"]["coin"]="$pluscoin";
$cuser["userfild"]["$fromid"]["channeljoin"][]="$channel";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
@$user = json_decode(file_get_contents("data/user.json"),true);
$allchannel = $user["channellist"];
for($z = 0;$z <= count($allchannel);$z++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[$z]."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
$omm = $allchannel[$z];
break;
}
}
if ($allchannel[$z] == true){
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$name = $getchat["result"]["title"];
$username = $getchat["result"]["username"];
$id = $getchat["result"]["id"];
if($username != "" and $username != null){
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"اشترك بالقناة ،♥️
▫️اسم القناة [ $name ]
▫️معرف القناة ( @$username  )

ثم اضغط على التالي 💰",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [['text'=>"اشتراك",'url'=>"https://t.me/$username"]],
                   [['text'=>"التالي 💰",'callback_data'=>'truechannel'],['text'=>"تخطي 🗑",'callback_data'=>'nextchannel']],
                   [['text'=>"ابلاغ 📛",'callback_data'=>'badchannel'],['text'=>"رجوع ↪️",'callback_data'=>'panel']]
                     ]
               ])
			   ]);
$cuser = json_decode(file_get_contents("data/$fromid.json"),true);
$cuser["userfild"]["$fromid"]["getjoin"]="$username";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"انتهت القنوات المضافة 📩'
يرجى المحاولة مرة أخرى .
اضغط على تحديث أو رجوع ↪️❗️",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"تحديث",'callback_data'=>'takecoin'],['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
else
{
  bot('editmessagetext',[
                  'chat_id'=>$chatid,
       'message_id'=>$messageid,
                 'text'=>"انتهت القنوات المضافة 📩'
  يرجى المحاولة مرة أخرى .
  اضغط على تحديث أو رجوع ↪️❗️",
                 'reply_markup'=>json_encode([
                     'inline_keyboard'=>[
  				   [
  				   ['text'=>"تحديث",'callback_data'=>'takecoin'],['text'=>"رجوع ↪️",'callback_data'=>'panel']
  				   ],
                       ]
                 ])
  			   ]);
}
}
}
elseif($data=="badchannel"){
$getjoinchannel = $cuser["userfild"]["$fromid"]["getjoin"];
	 bot('answercallbackquery', [
	            'callback_query_id' =>$membercall,
            'text' => "تم إرسال الإبلاغ إلى مبرمج البوت, سيقوم بمراجعة القناة ومعرفة محتوى القناة ،
نشكرك للتعاون معنا  ♥️ !",
            'show_alert' =>true
        ]);
	bot('sendmessage',[
	'chat_id'=>"-1001241680413",
	'text'=>"ابلاغ جديد!

القناة : @$getjoinchannel
معرف المبلغ : @$usernames
-",
  	]);
}
elseif($data=="accont"){
$invite = $cuser["userfild"]["$fromid"]["invite"];
$coin = $cuser["userfild"]["$fromid"]["coin"];
$setchannel = $cuser["userfild"]["$fromid"]["setchannel"];
$setmember = $cuser["userfild"]["$fromid"]["setmember"];
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"إليك إحصائيات نقاطك 👇🏿،

◾️ عدد النقاط :- ( $coin )
▫️ آخر قناة قمت بتمويلها :- $setchannel
◾️ عدد الأعضاء الذين قمت بطلبهم للقناة :- $setmember
▫️ عدد الذين قاموا باستخدام رابطك : $invite
-",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [['text'=>"تحويل نقاط 🎒",'callback_data'=>'sendcoin']],
                     [['text'=>"إحصائيات قنواتك",'callback_data'=>'#']],
                     [['text'=>"اشتركت بها 📻",'callback_data'=>'mechannel'],['text'=>"تم تمويلها 💰",'callback_data'=>'order']],
                     [['text'=>"رجوع ↪️",'callback_data'=>'panel']],
                     ]
               ])
			   ]);
}
elseif($data=="mechannel"){
$allchannel = $cuser["userfild"]["$fromid"]["channeljoin"];
for($z = 0;$z <= count($allchannel)-1;$z++){
$result = $at.$result."📢 "."@".$allchannel[$z]."\n";
}
if($result == true){
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
	'text'=>قائمة القنوات المشترك بها 📻 !

$result

ملاحظة: عند مغادرتك قناة يتم خصم نقطتين من النقاط الخاصة بك !.",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
				   ]
            ])
  	]);
}
else
{
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
	'text'=>"أنت لم تقم بتجميع نقاط حتى ⚠️ !
عليك تجميع نقاط أولا ومن ثم طلب أعضاء ❗️",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"تجميع 📻",'callback_data'=>'takecoin'],['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
				   ]
            ])
  	]);
}
}
elseif($data=="order"){
$i=0;$allchannel = $cuser["userfild"]["$fromid"]["listorder"];

$keyboard = [];
$keyboard["inline_keyboard"] = [];
    foreach($allchannel as $row){
        $keyboard["inline_keyboard"][$i]=[];
        $dataa = explode("-",$row);
        $usernamechannel = str_replace("@","",$dataa[0]);
        $members = str_replace("> ","",$dataa[1]);
                $Ibotton = ["text" => $dataa[0], "callback_data" => "manachs_".$usernamechannel."_".$members];
                $keyboard["inline_keyboard"][$i][] = $Ibotton;
            $i++;
        }
        $Ibotton = ['text'=>"رجوع ↪️",'callback_data'=>'panel'];
        $keyboard["inline_keyboard"][$i][] = $Ibotton;
$reply_markup=json_encode($keyboard);
if($reply_markup == true){
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
	'text'=>"لسته القنوات التي قمت بتمويلها 📻 !
-",
               'reply_markup'=>$reply_markup
  	]);
}
else
{
$coin = $cuser["userfild"]["$fromid"]["coin"];
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
	'text'=>"أنت لم تقم بتمويل أي قناة ❗️
اجمع نقاط أولا من ثم اشترِ أعضاء
وموّل قناتك مجانا من خلال البوت 🎒💰.",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"شراء الأعضاء 💰",'callback_data'=>'takemember'],['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
				   ]
            ])
  	]);
}
}
if(preg_match("/^(manachs)_(.*)_(.*)/s",$data)){
   preg_match("/^(manachs)_(.*)_(.*)/s",$data,$matchaa);
  $channel = $matchaa[2];
 $members = $matchaa[3];
$setchannel = $channel;

$howmember = getChatMembersCount($setchannel,$token);
$endmember = $howmember + $members;
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
	'text'=>"▪️ عدد أعضاء القناة : $howmember
▪️ عدد الأعضاء بعد التمويل : $endmember
:)️",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
[['text'=>"حذف القناة",'callback_data'=>'deletechannel_'.$channel]],
				   [
['text'=>"رجوع ↪️",'callback_data'=>'order']
				   ]
				   ]
            ])
  	]);
}
if(preg_match("/^(deletechannel)_(.*)/s",$data)){
   preg_match("/^(deletechannel)_(.*)/s",$data,$matchaa);
$channel = "@".$matchaa[2];

$how = array_search($channel,$user["channellist"]);
unset($user["setmemberlist"][$how]);
unset($user["channellist"][$how]);
unset($user["admin"][$how]);
$user["channellist"]=array_values($user["channellist"]);
$user["setmemberlist"]=array_values($user["setmemberlist"]);
$user["admin"]=array_values($user["admin"]);

$user = json_encode($user,true);
file_put_contents("data/user.json",$user);

$invite = $cuser["userfild"]["$fromid"]["invite"];
$coin = $cuser["userfild"]["$fromid"]["coin"];
$setchannel = $cuser["userfild"]["$fromid"]["setchannel"];
$setmember = $cuser["userfild"]["$fromid"]["setmember"];
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"إليك إحصائيات نقاطك 👇🏿،

◾️ عدد النقاط :- ( $coin )
▫️ آخر قناة قمت بتمويلها :- $setchannel
◾️ عدد الأعضاء الذي قمت بطلبهم للقناة :- $setmember
▫️ عدد الذين قاموا باستخدام رابطك : $invite

- تم حذف القناة من الدعم فقط",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [['text'=>"تحويل نقاط 🎒",'callback_data'=>'sendcoin']],
                     [['text'=>"إحصائيات قنواتك",'callback_data'=>'#']],
                     [['text'=>"اشتركت بها 📻",'callback_data'=>'mechannel'],['text'=>"تم تمويلها 💰",'callback_data'=>'order']],
                     [['text'=>"رجوع ↪️",'callback_data'=>'panel']],
                     ]
               ])
			   ]);
}
elseif($data=="member"){
$invite = $cuser["userfild"]["$fromid"]["invite"];
$coin = $cuser["userfild"]["$fromid"]["coin"];
		bot('sendMessage',[
	'chat_id'=>$chatid,
	'text'=>"بوت زيادة أعضاء القناة 💰

▪️زيادة أعضاء قناتك حقيقي (100%)
▪️ضمان عدم مغادرة الأعضاء لقناتك
▪️اشترك بلبوت واستمتع الآن ..

زيادة لبوتك مضمونة و حقيقة تصل إلى ٥٠٠ عضو 📻❗️

انضم من خلال الاشتراك بالرابط ~>
https://t.me/$usernamebot?start=$fromid",
    		]);
	bot('sendmessage',[
	'chat_id'=>$chatid,
	'text'=>"شارك الرابط الخاص بك 💰'
بدون الاشتراك بالقنوات ⚠️،
وبدون تجميع نقاط بنفسك تحصل على نقطة لكل اشتراك ❗️

نقاطك :- ( $coin )
المشتركين بالرابط الخاص بك :- ( $invite )",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
				   ]
            ])
  	]);
}
elseif($data=="sendcoin"){
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
	'text'=>"عند إرسال نقاط إلى صديق آخر ❗️
يجب أن يكون مشترك في البوت 💰
بعدها أرسل الأيدي أو إرسال توجيه من رسائله .",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
				   ]
            ])
  	]);
$cuser["userfild"]["$fromid"]["file"]="sendcoin";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'sendcoin') {
$coin = $juser["userfild"]["$from_id"]["coin"];
if($forward_from == true){
if($forward_from_id != $from_id){
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"معلومات التحويل 💰 :-
• تم العثور على المستخدم، معلومات المستخدم 👤:

▫️ الاسم :-  $forward_from_first_name
◾️ المعرف :- @$forward_from_username
▫️ الأيدي :- $forward_from_id

أرسل عدد النقاط المراد تحويلها .
نقاطك 💰 ( $coin )",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
$juser["userfild"]["$from_id"]["file"]="setsendcoin";
$juser["userfild"]["$from_id"]["sendcoinid"]="$forward_from_id";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
else
{
	bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"لا يمكن إرسال نقاطك إلى نفسك ❗️
أرسل أيدي المستخدم فقط
أو أرسل توجيه من رسائله ☑️",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
}
}
else
{
if($textmassage != $from_id){
if(is_numeric($textmassage)){
$stat = file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=$textmassage&user_id=".$textmassage);
$statjson = json_decode($stat, true);
$status = $statjson['ok'];
if($status == 1){
$name = $statjson['result']['user']['first_name'];
$username = $statjson['result']['user']['username'];
$id = $statjson['result']['user']['id'];
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"معلومات التحويل 💰 :-
• تم العثور على المستخدم، معلومات المستخدم 👤:

▫️ الاسم :-  $name
◾️ المعرف :- @$usrrname
▫️ الأيدي :- $id

أرسل عدد النقاط المراد تحويلها .
نقاطك 💰 ( $coin )",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
$juser["userfild"]["$from_id"]["file"]="setsendcoin";
$juser["userfild"]["$from_id"]["sendcoinid"]="$textmassage";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
else
{
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"الأيدي خطأ ❗️
إن لم تتأكد من الأيدي أرسل توجيه من رسائله",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
}
}
else
{
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"الأيدي خطأ ❗️
إن لم تتأكد من الأيدي أرسل توجيه من رسائله 📎
من ثم التأكد أن العضو مشترك بالبوت.",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
}
}
else
{
	bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"لا يمكن إرسال نقاط لنفسك 🚫.",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
}
}
}
elseif($juser["userfild"]["$from_id"]["file"] == "setsendcoin"){
$coin = $juser["userfild"]["$from_id"]["coin"];
$userid = $juser["userfild"]["$from_id"]["sendcoinid"];
$inuser = json_decode(file_get_contents("data/$userid.json"),true);
$coinuser = $inuser["userfild"]["$userid"]["coin"];
if($textmassage <= $coin && $coin > 0){
$coinplus = $coin - $textmassage;
$sendcoinplus = $coinuser + $textmassage;
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"تم إرسال النقاط ( $textmassage ) بنجاح ☑️💰

معلومات المرسل 👇🏻
▫️ أيدي العضو  :- $userid
▫️ نقاطك الآن :- $coinplus",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
				   ]
            ])
  	]);
		bot('sendmessage',[
	'chat_id'=>$userid,
	'text'=>"عزيزي  ♥️.

قام ( @$username ) .
بتحويل نقاط إليك قدرها ( $textmassage ) 💰.
-",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
				   ]
            ])
  	]);
$juser["userfild"]["$from_id"]["file"]="none";
$juser["userfild"]["$from_id"]["coin"]="$coinplus";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
$inuser["userfild"]["$userid"]["coin"]="$sendcoinplus";
$inuser = json_encode($inuser,true);
file_put_contents("data/$userid.json",$inuser);
}
else
{
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"أنت لاتمتلك هذه النقاط ❗️
أقصى عدد بمقدورك تحويله هو ( $coin ) 💰",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
				   ]
            ])
  	]);
}
}

elseif($data=="takemember"){
$coin = $cuser["userfild"]["$fromid"]["coin"];
if($coin >= 10){
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"أرسل معرف القناة الآن ♥️.",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
$cuser["userfild"]["$fromid"]["file"]="setchannel";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
else
{
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"نقاطك ( $coin ) 💰

يجب أن تطلب أعضاء أقل أو يساوي عدد النقاط ❗️",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
             ['text'=>"تجميع نقاط",'callback_data'=>'takecoinn'],['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'setchannel') {
if(preg_match('/^(@)(.*)/s',$textmassage)){
$coin = $juser["userfild"]["$from_id"]["coin"];
$max = $coin / 2;
$maxmember = floor($max);
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"تم تأكيد الطلب ✅
قناتك :- $textmassage
أرسل الآن عدد الأعضاء المطلوب 👨🏻.

نقاطك :- $coin 💰",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
$juser["userfild"]["$from_id"]["file"]="setmember";
$juser["userfild"]["$from_id"]["setchannel"]="$textmassage";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
else
{
	bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"تأكد من معرف القناة ❗️
أرسل المعرف الصحيح مثل :- @$channel .",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'setmember') {
$coin = $juser["userfild"]["$from_id"]["coin"];
$setchanel = $juser["userfild"]["$from_id"]["setchannel"];
$max = $coin / 2;
$maxmember = floor($max);
if($maxmember >= $textmassage){
$howmember = getChatMembersCount($setchanel,$token);
$endmember = $howmember + $textmassage;
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"معلومات طلبك 📩

▪️ معرف القناة : *$setchanel* ،
▪️ العدد المطلوب : *$textmassage* ،
▪️ عدد أعضاء القناة : *$howmember* ،
▪️ عدد الأعضاء بعد التمويل : *$endmember* ،

ارفع البوت أدمن حتى يتم تمويل القناة 🔬.",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"تأكيد ☑️",'callback_data'=>'trueorder'],['text'=>"رجوع ↪️",'callback_data'=>'panel'],
				   ],
                     ]
               ])
 ]);
$juser["userfild"]["$from_id"]["file"]="none";
$juser["userfild"]["$from_id"]["setmember"]="$textmassage";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
else
{
	bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"نقاطك ( $coin ) 💰
أقصى عدد يمكن أن تطلبه ( $maxmember ) ❗️
يرجى إرسال $maxmember أو أقل منه 💡",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
}
}
elseif($data=="trueorder"){
$setchannel = $cuser["userfild"]["$fromid"]["setchannel"];
if(!in_array($setchannel, $user["channellist"])) {
$admin = getChatstats(@$setchannel,$token);
if($admin != true){
	       bot('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "ارفع البوت أدمن أولا ❗️
حتى يتم التمويل بشكل جيد 💰",
            'show_alert' =>true
        ]);
}
else
{
    	bot('sendmessage',[
	'chat_id'=>"-1001241680413",
	'text'=>"✅ تم إضافة قناة جديدة للبوت : $setchannel",
  	]);
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"تم تنفيذ الطلب بنجاح 📎☑️
يمكنك طلب الهدايا أيضا ♥️.
ملاحظة: إذا قمت بمخالفة قوانين وقواعد وتعليمات البوت سوف نقوم بحذف قناتك تأكد من الذهاب إلى المساعدة والقواعد تجنب الحظر ، 🚫 !
-",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel'],
				   ],
                     ]
               ])
			   ]);
$coin = $cuser["userfild"]["$fromid"]["coin"];
$setchannel = $cuser["userfild"]["$fromid"]["setchannel"];
$setmember = $cuser["userfild"]["$fromid"]["setmember"];
$pluscoin = $setmember * 2;
$coinplus = $coin - $pluscoin;
$cuser["userfild"]["$fromid"]["coin"]="$coinplus";
$cuser["userfild"]["$fromid"]["listorder"][]="$setchannel -> $setmember";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
$user["channellist"][]="$setchannel";
$user["setmemberlist"][]="$setmember";
$user["admin"][]="$fromid";

$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
}
}else {
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
	'text'=>"عذراً القناة ضمن تمويل بالفعل ⚠️",
   	'reply_markup'=>json_encode([
  	'inline_keyboard'=>[
           [['text'=>"تجميع نقاط",'callback_data'=>'takecoinn'],['text'=>"تمويل قناتك 📣",'callback_data'=>'takemember']],
           [['text'=>"حسابك 👤",'callback_data'=>'accont']],
           [['text'=>"الدعم",'callback_data'=>'sup'],['text'=>"شرح البوت 📰",'callback_data'=>'learn']],
	  	],
	  	'resize_keyboard'=>true,
  	])
  	]);
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
}
elseif($data=="sup"){
bot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"▫️ الدعم وحل المشاكل الموجودة بالبوت 📩
▫️ الرجاء إرسال الشكاوى أو المشاكل الموجودة بالبوت ليتم تصحيحها أرسل مشكلتك برسالة واحدة فضلا ❗️
▫️عند وجود مشكلة يرجى أخذ لقطة شاشة للمشكلة وإرسالها هنا
-",
                'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
$cuser["userfild"]["$fromid"]["file"]="sendsup";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'sendsup') {
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"تم إيصال رسالتك ☑️
انتظر الرد بأسرع وقت ♥️.",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
bot('ForwardMessage',[
'chat_id'=>$Dev[0],
'from_chat_id'=>$chat_id,
'message_id'=>$message_id
]);
}
	elseif($update->message && $update->message->reply_to_message && in_array($from_id,$Dev) && $tc == "private"){
	bot('sendmessage',[
        "chat_id"=>$chat_id,
        "text"=>"تم إيصال الرسالة إلى العضو  📩"
		]);
	bot('sendmessage',[
        "chat_id"=>$reply,
        "text"=>"$textmassage",
'parse_mode'=>'MarkDown'
		]);
}
if(file_get_contents("data/$fromid.txt") == "true"){
$pluscoin = file_get_contents("data/".$fromid."coin.txt");
$inviter = $cuser["userfild"]["$fromid"]["inviter"];
$invitercoin = $pluscoin / 100 * 20;
	       bot('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "إضافة النقود الآن 💰",
            'show_alert' =>false
        ]);
		         bot('sendmessage',[
        	'chat_id'=>$inviter,
        	'text'=>"تم إضافة ( $invitercoin 💰 ) بنجاح ☑️",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
$coin = $cuser["userfild"]["$fromid"]["coin"];
$coinplus = $coin + $pluscoin;
$cuser["userfild"]["$fromid"]["coin"]="$coinplus";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
$inuser = json_decode(file_get_contents("data/$inviter.json"),true);
$coininviter = $inuser["userfild"]["$inviter"]["coin"];
$coinplusinviter = $coininviter + $invitercoin ;
$inuser["userfild"]["$inviter"]["coin"]="$coinplusinviter";;
$inuser = json_encode($inuser,true);
file_put_contents("data/$inviter.json",$inuser);
unlink("data/".$fromid."coin.txt");
unlink("data/$fromid.txt");
}


//panel admin
elseif($textmassage=="/update"){
if ($tc == "private") {
if (in_array($from_id,$Dev)){
$order = $user["channellist"];
$ordercount = count($user["channellist"]);
for($z = 0;$z <= count($order)-1;$z++){
$admin = getChatstats(@$order[$z],$token);
if($admin != true){
$how = array_search($order[$z],$user["channellist"]);
unset($user["setmemberlist"][$how]);
unset($user["channellist"][$how]);
unset($user["admin"][$how]);
$user["channellist"]=array_values($user["channellist"]);
$user["setmemberlist"]=array_values($user["setmemberlist"]);
$user["admin"]=array_values($user["admin"]);

$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
}
}
unlink('Member.txt');
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"تم تحديث البوت وحذف الملفات المؤقتة ✅"
 ]);
}
}
}

elseif($textmassage=="/admin"){
if ($tc == "private") {
if (in_array($from_id,$Dev)){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"لوحة تحكم المشرفين 🌐",
         'reply_to_message_id'=>$message_id,
         'reply_markup'=>json_encode([
             'inline_keyboard'=>[
               [['text'=>"الإحصائيات 👤",'callback_data'=>'admin_members'],['text'=>"القنوات 📣",'callback_data'=>'admin_channels']],
        [['text'=>"إذاعة رسالة",'callback_data'=>'admin_send'],['text'=>"إذاعة توجية",'callback_data'=>'admin_fwd']],
        [['text'=>"إذاعة للقنوات",'callback_data'=>'admin_sendch'],['text'=>"إذاعة نقاط",'callback_data'=>'admin_bcconmem']],
        [['text'=>"حظر عضو ⛔️",'callback_data'=>'admin_ban'],['text'=>"حذف قناة 🗑",'callback_data'=>'admin_deletech']],
        [['text'=>"زيادة نقاط",'callback_data'=>'admin_sendcon'],['text'=>"خصم نقاط",'callback_data'=>'admin_deletecon']],
        [['text'=>"عمل هدية 🎁",'callback_data'=>'admin_code'],['text'=>"إرسال نقاط 🆒",'callback_data'=>'admin_bccon']],
[['text'=>"إضافة تمويل 💳",'callback_data'=>'admin_addfinance'],['text'=>"الممولات",'callback_data'=>'admin_listfinance']],
        [['text'=>"نسخة احتياطية",'callback_data'=>'admin_backup']]
               ]
         ])
 ]);
}
}
}
elseif($data =="paneladmin"){
if (in_array($fromid,$Dev)){
  bot('editmessagetext',[
                  'chat_id'=>$chatid,
       'message_id'=>$messageid,
  'text'=>"لوحة تحكم المشرفين 🌐",
           'reply_to_message_id'=>$message_id,
           'reply_markup'=>json_encode([
               'inline_keyboard'=>[
                 [['text'=>"الإحصائيات 👤",'callback_data'=>'admin_members'],['text'=>"القنوات 📣",'callback_data'=>'admin_channels']],
          [['text'=>"إذاعة رسالة",'callback_data'=>'admin_send'],['text'=>"إذاعة توجية",'callback_data'=>'admin_fwd']],
          [['text'=>"إذاعة للقنوات",'callback_data'=>'admin_sendch'],['text'=>"إذاعة نقاط",'callback_data'=>'admin_bcconmem']],
          [['text'=>"حظر عضو ⛔️",'callback_data'=>'admin_ban'],['text'=>"حذف قناة 🗑",'callback_data'=>'admin_deletech']],
          [['text'=>"زيادة نقاط",'callback_data'=>'admin_sendcon'],['text'=>"خصم نقاط",'callback_data'=>'admin_deletecon']],
          [['text'=>"عمل هدية 🎁",'callback_data'=>'admin_code'],['text'=>"إرسال نقاط 🆒",'callback_data'=>'admin_bccon']],
[['text'=>"إضافة تمويل 💳",'callback_data'=>'admin_addfinance'],['text'=>"الممولات",'callback_data'=>'admin_listfinance']],
          [['text'=>"نسخة احتياطية",'callback_data'=>'admin_backup']]
                 ]
           ])
   ]);
$cuser["userfild"]["$fromid"]["file"]="none";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
}
elseif($data == "admin_addfinance"){
if (in_array($fromid,$Dev)){
  bot('editmessagetext',[
                  'chat_id'=>$chatid,
       'message_id'=>$messageid,
		'text'=>"أرسل معرف القناة ليتم تمويلها ( مدفوع ) 📣",
    'reply_markup'=>json_encode([
        'inline_keyboard'=>[
    [
    ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
    ],
          ]
    ])
		]);
$cuser["userfild"]["$fromid"]["file"]="addfinance";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
		}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'addfinance') {
  $checkadmin = getChatstats($textmassage,$token);
  if($checkadmin == true){
  bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"جيد !
الآن أرسل عدد الأعضاء الذين تريد تمويلهم 👤
-",
      'reply_to_message_id'=>$message_id,
      'reply_markup'=>json_encode([
        'inline_keyboard'=>[
    [
    ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
    ],
          ]
    ])
   ]);
$juser["idforsend"]="$textmassage";
$juser["userfild"]["$from_id"]["file"]="addfinance_2";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}else {
  bot('sendmessage',[
            'chat_id'=>$chat_id,
   'text' => "ارفع البوت مشرف أولا ❗️
حتى يعمل الأمر بشكل جيد 💰",
'reply_markup'=>json_encode([
  'inline_keyboard'=>[
[
['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
],
    ]
])
]);
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'addfinance_2') {
$id = $juser["idforsend"];
$user["finance"][]=[$id,$textmassage];
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"جاري تمويل [$textmassage] للقناة [$id] ✅",
	  'reply_to_message_id'=>$message_id,
    'reply_markup'=>json_encode([
  'inline_keyboard'=>[
[
['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
],
    ]
])
 ]);

$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
if(preg_match("/^(coin)_(.*)_(.*)/s",$data)){
   preg_match("/^(coin)_(.*)_(.*)/s",$data,$matchaa);
  $channel = $matchaa[2];
  $coinpluss = $matchaa[3];
  $join = file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=$channel&user_id=".$fromid);
  if((strpos($join,'"status":"left"') or strpos($join,'"Bad Request: USER_ID_INVALID"') or strpos($join,'"status":"kicked"'))=== false){
    bot('deleteMessage',[
   'chat_id'=>$chatid,
   'message_id'=>$messageid
       ]);
 bot('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "تم إعطاءك ($coinpluss) 💰",
            'show_alert' =>false
        ]);
    $inuser = json_decode(file_get_contents("data/$fromid.json"),true);
    $coin = $inuser["userfild"]["$fromid"]["coin"];
    $coinplus = $coin + $coinpluss;
    $inuser["userfild"]["$fromid"]["coin"]="$coinplus";
    $inuser = json_encode($inuser,true);
    file_put_contents("data/$fromid.json",$inuser);
}else {
  bot('answercallbackquery', [
    'callback_query_id' =>$membercall,
    'text' => "عذرا ❗️
اشترك بالقناة أولا :)
-",
    'show_alert' =>true
]);
}
}
elseif($data=="admin_bcconmem"){
  if (in_array($fromid,$Dev)){
    bot('editmessagetext',[
                    'chat_id'=>$chatid,
         'message_id'=>$messageid,
		'text'=>"أرسل معرف القناة 📣",
    'reply_markup'=>json_encode([
        'inline_keyboard'=>[
    [
    ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
    ],
          ]
    ])
		]);
$cuser["userfild"]["$fromid"]["file"]="setchmembers";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
		}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'setchmembers') {
  $checkadmin = getChatstats($textmassage,$token);
  if($checkadmin == true){
  bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"جيد, الآن أرسل عدد النقاط 💰
التي يحصلها المستخدم عند الاشتراك ✅
-",
      'reply_to_message_id'=>$message_id,
      'reply_markup'=>json_encode([
        'inline_keyboard'=>[
    [
    ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
    ],
          ]
    ])
   ]);
$user["coinbc"]="$textmassage";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
$juser["userfild"]["$from_id"]["file"]="setchmembers2";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}else {
  bot('sendmessage',[
            'chat_id'=>$chat_id,
   'text' => "ارفع البوت مشرف أولا ❗️
حتى يعمل الأمر بشكل جيد 💰",
'reply_markup'=>json_encode([
  'inline_keyboard'=>[
[
['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
],
    ]
])
]);
}
}

elseif ($juser["userfild"]["$from_id"]["file"] == 'setchmembers2') {
$code = $user["coinbc"];

$numbers = $user["userlist"];
foreach($numbers as $key){
 $user = file_get_contents('Member.txt');
    $members = explode("\n",$user);
    if (!in_array($key,$members)){
      $add_user = file_get_contents('Member.txt');
      $add_user .= $key."\n";
     file_put_contents('Member.txt',$add_user);
bot('sendmessage',[
          'chat_id'=>$key,
          'text'=>"📩 اشترك بالقناة :- $code
واضغط للحصول على [ $textmassage ] نقاط 💰.",
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
  [
  ['text'=>"اشترك ✅",'callback_data'=>'coin_'.$code.'_'.$textmassage]
  ],
        ]
  ])
 ]);
}
}

$all = count($user["userlist"]);
bot('sendmessage',[
          'chat_id'=>$chat_id,
          'text'=>"جيد, ✅
القناة : $code
النقاط : $textmassage

تم النشر إلى [$all] مستخدم بنجاح 👤
-",
    'reply_to_message_id'=>$message_id,
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
  [
  ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
  ],
        ]
  ])
 ]);
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
elseif($data=="admin_members"){
if (in_array($fromid,$Dev)){
$all = count($user["userlist"]);
$order = count($user["channellist"]);
bot('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "عدد المستخدمين 👤 [$all]
عدد القنوات 📣 [$order]",
            'show_alert' =>true
        ]);
		}
}
elseif($data == "admin_ban"){
if (in_array($fromid,$Dev)){
  bot('editmessagetext',[
                  'chat_id'=>$chatid,
       'message_id'=>$messageid,
		'text'=>"أرسل رسالة موجهة أو أيدي العضو ✉️
ليتم حظره من البوت ⛔️
-",
    'reply_markup'=>json_encode([
        'inline_keyboard'=>[
    [
    ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
    ],
          ]
    ])
		]);
$cuser["userfild"]["$fromid"]["file"]="block";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
		}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'block') {
if ($forward_from == true) {
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"العضو تم حظره بنجاح ✅

الأيدي : $forward_from_id
اسم المستخدم : @$forward_from_username
-",
	  'reply_to_message_id'=>$message_id,
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
  [
  ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
  ],
        ]
  ])
 ]);
$juser["blocklist"][]="$forward_from_id";
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
else
{
  bot('sendmessage',[
   'chat_id'=>$chat_id,
   'text'=>"العضو تم حظره بنجاح ✅

الأيدي : $textmassage
-",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[
['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
],
 ]
])
]);
$juser["blocklist"][]="$textmassage";
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
}
elseif ($data == "admin_send" ) {
if (in_array($fromid,$Dev)){
  $all = count($user["userlist"]);

  bot('editmessagetext',[
            'chat_id'=>$chatid,
 'message_id'=>$messageid,
        	'text'=>"أرسل رسالتك ليتم إرسالها إلى [$all] مستخدم ✅
-",
    'reply_markup'=>json_encode([
        'inline_keyboard'=>[
    [
    ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
    ],
          ]
    ])
 ]);
$cuser["userfild"]["$fromid"]["file"]="sendtoall";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
}
elseif ($data == "admin_sendch" ) {
if (in_array($fromid,$Dev)){
  $all = count($user["channellist"]);
  bot('editmessagetext',[
            'chat_id'=>$chatid,
 'message_id'=>$messageid,
        	'text'=>"أرسل رسالتك ليتم إرسالها إلى [$all] قناة ✅
-",
    'reply_markup'=>json_encode([
        'inline_keyboard'=>[
    [
    ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
    ],
          ]
    ])
 ]);

$cuser["userfild"]["$fromid"]["file"]="sendtochs";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);

}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'sendtochs') {
$juser["userfild"]["$from_id"]["file"]="sendtochs2";
$juser["idforsend"]="$textmassage";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);

bot('sendmessage',[
 'chat_id'=>$chat_id,
        'text'=>"جيد !

الآن أرسل الأزرار بالطريقة الآتية:
TEXT = LINK + TEXT = LINK
TEXT = LINK
-",
  'reply_markup'=>json_encode([
      'inline_keyboard'=>[
  [
  ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
  ],
        ]
  ])
]);
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'sendtochs2') {
$texttt = $juser["idforsend"];

  $i=0;
    $keyboard = [];
    $keyboard["inline_keyboard"] = [];
    $rows = explode("\n",$textmassage);
        foreach($rows as $row){
            $j=0;
            $keyboard["inline_keyboard"][$i]=[];
            $bottons = explode("+",$row);
                foreach($bottons as $botton){
                    $data = explode("=",$botton."=");
                    $Ibotton = ["text" => trim($data[0]), "url" => trim($data[1])];
                    $keyboard["inline_keyboard"][$i][$j] = $Ibotton;
                    $j++;
                }
                $i++;
            }

    $reply_markup=json_encode($keyboard);

$order = $user["channellist"];
for($z = 0;$z <= count($order);$z++){
     $user = file_get_contents('Member.txt');
    $members = explode("\n",$user);
    if (!in_array($order[$z],$members)){
      $add_user = file_get_contents('Member.txt');
      $add_user .= $order[$z]."\n";
     file_put_contents('Member.txt',$add_user);

$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$order[$z]");
$getchat = json_decode($url, true);
$id = $getchat["result"]["id"];

     bot('sendmessage',[
          'chat_id'=>$id,
		  'text'=>"$texttt",
        'reply_markup'=>($reply_markup)
        ]);
}
}
        $all = count($user["channellist"]);
bot('sendmessage',[
 'chat_id'=>$chat_id,
        'text'=>"تم إرسال رسالتك إلى [$all] قناة بنجاح 👋🏻",
  'reply_markup'=>json_encode([
      'inline_keyboard'=>[
  [
  ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
  ],
        ]
  ])
]);

$juser["userfild"]["$from_id"]["file"]="nonde";
$juser["idforsend"]="";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'sendtoall') {
$juser["userfild"]["$from_id"]["file"]="none";
$numbers = $user["userlist"];
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
for($z = 0;$z <= count($numbers)-1;$z++){


 $user = file_get_contents('Member.txt');
    $members = explode("\n",$user);
    if (!in_array($numbers[$z],$members)){
      $add_user = file_get_contents('Member.txt');
      $add_user .= $numbers[$z]."\n";
     file_put_contents('Member.txt',$add_user);
     bot('sendmessage',[
          'chat_id'=>$numbers[$z],
		  'text'=>"$textmassage",
        ]);
}
  }
        $all = count($user["userlist"]);
bot('sendmessage',[
 'chat_id'=>$chat_id,
        'text'=>"تم إرسال رسالتك إلى [$all] مستخدم بنجاح 👋🏻",
  'reply_markup'=>json_encode([
      'inline_keyboard'=>[
  [
  ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
  ],
        ]
  ])
]);
}
elseif ($data == "admin_fwd" ) {
if (in_array($fromid,$Dev)){
  $all = count($user["userlist"]);
  bot('editmessagetext',[
            'chat_id'=>$chatid,
 'message_id'=>$messageid,
        	'text'=>"أرسل رسالة التوجيه ليتم إرسالها إلى [$all] مستخدم ✅
-",
    'reply_markup'=>json_encode([
        'inline_keyboard'=>[
    [
    ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
    ],
          ]
    ])
 ]);
$cuser["userfild"]["$fromid"]["file"]="fortoall";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'fortoall') {
$juser["userfild"]["$from_id"]["file"]="none";
$numbers = $user["userlist"];
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
for($z = 0;$z <= count($numbers)-1;$z++){
     $user = file_get_contents('Member.txt');
    $members = explode("\n",$user);
    if (!in_array($numbers[$z],$members)){
      $add_user = file_get_contents('Member.txt');
      $add_user .= $numbers[$z]."\n";
     file_put_contents('Member.txt',$add_user);

Forward($numbers[$z], $chat_id,$message_id);
}
}
$all = count($user["userlist"]);
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"تم إرسال رسالتك إلى [$all] مستخدم بنجاح 👋🏻",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[
['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
],
]
])
]);
}
elseif($data=="admin_channels"){
if (in_array($fromid,$Dev)){
$order = $user["channellist"];
$ordercount = count($user["channellist"]);
for($z = 0;$z <= count($order)-1;$z++){
$result = $result.$order[$z]."\n";
}
bot('editmessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
		'text'=>"📣 القنوات الجاري تمويلها($ordercount):
$result",
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[
['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
],
      ]
])
		]);
		}
}
elseif($data=="admin_listfinance"){
if (in_array($fromid,$Dev)){
$arr = $user['finance'];
$out = "" ;
for($z = 0;$z <= count($arr);$z++){
if($arr[$z][0] != null and $arr[$z][0] != ""){
$out = $out.$arr[$z][0]." - ".$arr[$z][1]."\n";
}
}
bot('editmessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
		'text'=>"📣 القنوات الجاري تمويلها:
$out",
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[
['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
],
      ]
])
		]);
		}
}

elseif($data == "admin_deletech"){
if (in_array($fromid,$Dev)){
  bot('editmessagetext',[
                  'chat_id'=>$chatid,
       'message_id'=>$messageid,
		'text'=>"أرسل معرف القناة ليتم حذفها 🗑
-",
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[
['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
],
      ]
])
		]);
$cuser["userfild"]["$fromid"]["file"]="remorder";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
		}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'remorder') {
$how = array_search($textmassage,$user["channellist"]);
unset($user["setmemberlist"][$how]);
unset($user["channellist"][$how]);
unset($user["admin"][$how]);
$user["channellist"]=array_values($user["channellist"]);
$user["setmemberlist"]=array_values($user["setmemberlist"]);
$user["admin"]=array_values($user["admin"]);

$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"تم حذف القناة بنجاح 🗑",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[
['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
],
      ]
])
]);
}
elseif($data == "admin_sendcon"){
if (in_array($fromid,$Dev)){
  bot('editmessagetext',[
                  'chat_id'=>$chatid,
       'message_id'=>$messageid,
		'text'=>"أرسل رسالة موجهة أو أيدي العضو ✉️
ليتم زيادة نقاطه 💰
-",
    'reply_markup'=>json_encode([
        'inline_keyboard'=>[
    [
    ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
    ],
          ]
    ])
		]);
$cuser["userfild"]["$fromid"]["file"]="adminsendcoin";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
		}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'adminsendcoin') {
if ($forward_from == true) {
  bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"جيد, الآن أرسل عدد النقاط 💰

  الأيدي : $forward_from_id
  اسم المستخدم : @$forward_from_username
  -",
      'reply_to_message_id'=>$message_id,
      'reply_markup'=>json_encode([
        'inline_keyboard'=>[
    [
    ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
    ],
          ]
    ])
   ]);
$juser["idforsend"]="$forward_from_id";
$juser["userfild"]["$from_id"]["file"]="sethowsendcoin";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
else
{
	         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"جيد, الآن أرسل عدد النقاط 💰

الأيدي : $textmassage
-",
	  'reply_to_message_id'=>$message_id,
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
  [
  ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
  ],
        ]
  ])
 ]);
$juser["idforsend"]="$textmassage";
$juser["userfild"]["$from_id"]["file"]="sethowsendcoin";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'sethowsendcoin') {
$id = $juser["idforsend"];
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"تم إرسال [$textmassage] إلى العضو [$id] بنجاح 💰✅",
	  'reply_to_message_id'=>$message_id,
    'reply_markup'=>json_encode([
  'inline_keyboard'=>[
[
['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
],
    ]
])
 ]);
          bot('sendmessage',[
        	'chat_id'=>$id,
        	'text'=>"تم إرسال  $textmassage نقطه هدية من البوت 💰

🌷",
			               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
$inuser = json_decode(file_get_contents("data/$id.json"),true);
$coin = $inuser["userfild"]["$id"]["coin"];
$coinplus = $coin + $textmassage;
$inuser["userfild"]["$id"]["coin"]="$coinplus";
$inuser = json_encode($inuser,true);
file_put_contents("data/$id.json",$inuser);

$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
elseif($data == "admin_deletecon"){
if (in_array($fromid,$Dev)){
  bot('editmessagetext',[
                    'chat_id'=>$chatid,
         'message_id'=>$messageid,
      'text'=>"أرسل رسالة موجهة أو أيدي العضو ✉️
  ليتم خصم نقاطه 🗑
  -",
      'reply_markup'=>json_encode([
          'inline_keyboard'=>[
      [
      ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
      ],
            ]
      ])
      ]);
$cuser["userfild"]["$fromid"]["file"]="adminsendcoin2";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
		}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'adminsendcoin2') {
if ($forward_from == true) {
  bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"جيد, الآن أرسل عدد النقاط التي تريد خصمها 💰

  الأيدي : $forward_from_id
  اسم المستخدم : @$forward_from_username
  -",
      'reply_to_message_id'=>$message_id,
      'reply_markup'=>json_encode([
        'inline_keyboard'=>[
    [
    ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
    ],
          ]
    ])
   ]);
$juser["idforsend"]="$forward_from_id";
$juser["userfild"]["$from_id"]["file"]="sethowsendcoin2";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
else
{
 bot('sendmessage',[
          'chat_id'=>$chat_id,
          'text'=>"جيد, الآن أرسل عدد النقاط التي تريد خصمها 💰

الأيدي : $textmassage
-",
    'reply_to_message_id'=>$message_id,
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
  [
  ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
  ],
        ]
  ])
 ]);
$juser["idforsend"]="$textmassage";
$juser["userfild"]["$from_id"]["file"]="sethowsendcoin2";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'sethowsendcoin2') {
$id = $juser["idforsend"];
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"تم خصم [$textmassage] من العضو [$id] بنجاح 💰✅",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[
['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
],
]
])
]);
          bot('sendmessage',[
        	'chat_id'=>$id,
        	'text'=>"تم خصم [$textmassage] من نقاطك من قبل البوت 💰

-",
			               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
$inuser = json_decode(file_get_contents("data/$id.json"),true);
$coin = $inuser["userfild"]["$id"]["coin"];
$coinplus = $coin - $textmassage;
$inuser["userfild"]["$id"]["coin"]="$coinplus";
$inuser = json_encode($inuser,true);
file_put_contents("data/$id.json",$inuser);

$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}

if(preg_match("/^\/(newcode) (.*)/s",$textmassage)){
   preg_match("/^\/(newcode) (.*)/s",$textmassage,$matchaa);
if (in_array($from_id,$Dev)){

$Rand = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), -8);
$user["howcoincode"]=$matchaa[2];
$user["codecoin"]="$Rand";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"تم صناعة الهدية ( $Rand )
التي قيمتها ( ".$matchaa[2]." )

بنجاح ✅",
 ]);
}
}
elseif($data == "admin_code"){
if (in_array($fromid,$Dev)){
$Rand = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), -8);
bot('editmessagetext',[
                  'chat_id'=>$chatid,
       'message_id'=>$messageid,
 'text'=>"تم صناعة هدية 🎁
رمز الهدية : $Rand

الآن أرسل عدد نقاط الهدية 💰
-",
'reply_markup'=>json_encode([
  'inline_keyboard'=>[
[
['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
],
    ]
])
]);
$user["codecoin"]="$Rand";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
$cuser["userfild"]["$fromid"]["file"]="howcodecoin";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'howcodecoin') {
$code = $user["codecoin"];
         bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"تم إرسال الهدية إلى القناة [@$channelcode] ✅
-",
'reply_markup'=>json_encode([
   'inline_keyboard'=>[
[
['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
],
     ]
])
 ]);
          bot('sendmessage',[
        	'chat_id'=>"@$channelcode",
        	'text'=>"هدية جديدة, قيمتها [$textmassage] 💰",
          'reply_markup'=>json_encode([
  'inline_keyboard'=>[
[
['text'=>"اضغط هنا",'url'=>"https://t.me/$usernamebot?start=code_".$code]
],
    ]
])
 ]);
$user["howcoincode"]="$textmassage";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
elseif ($data == "admin_bccon") {
if (in_array($fromid,$Dev)){
  bot('editmessagetext',[
                    'chat_id'=>$chatid,
         'message_id'=>$messageid,
      'text'=>"أرسل عدد النقاط التي تريد إرسالها للكل 💰؟
-",
      'reply_markup'=>json_encode([
          'inline_keyboard'=>[
      [
      ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
      ],
            ]
      ])
      ]);
$cuser["userfild"]["$fromid"]["file"]="sendcointoall";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
}
elseif ($data == "admin_backup" ) {
if (in_array($fromid,$Dev)){
$user = (file_get_contents("data/user.json"));
file_put_contents("backup.json",$user);
bot('senddocument',[
'chat_id'=>$chatid,
'document'=>new CURLFile("backup.json"),
'caption'=>"النسخة الاحتياطية 📦"
 ]);
bot('sendmessage',[
          'chat_id'=>$chatid,
          'text'=>"تم إرسال النسخة الاحتياطية بنجاح 🗂✅",
    'reply_to_message_id'=>$messageid + 1,
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
  [
  ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
  ],
        ]
  ])
 ]);
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'sendcointoall') {
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
$numbers = $user["userlist"];
$all = count($user["userlist"]);

bot('sendmessage',[
          'chat_id'=>$chat_id,
          'text'=>"تم إرسال [$textmassage] نقطة لكل الأعضاء [$all] بنجاح ✅",
    'reply_to_message_id'=>$message_id,
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
  [
  ['text'=>"رجوع ↪️",'callback_data'=>'paneladmin']
  ],
        ]
  ])
 ]);
for($z = 0;$z <= count($numbers)-1;$z++){
     $user = file_get_contents('Member.txt');
    $members = explode("\n",$user);
    if (!in_array($numbers[$z],$members)){
      $add_user = file_get_contents('Member.txt');
      $add_user .= $numbers[$z]."\n";
     file_put_contents('Member.txt',$add_user);
   bot('sendmessage',[
          'chat_id'=>$numbers[$z],
		  'text'=>"تم إعطاءك [$textmassage] نقاط هدية من البوت 💰

-",
          'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"رجوع ↪️",'callback_data'=>'panel']
				   ],
                     ]
               ])
        ]);
$juser = json_decode(file_get_contents("data/$numbers[$z].json"),true);
$coin = $juser["userfild"]["$numbers[$z]"]["coin"];
$coinplus = $coin + $textmassage;
$juser["userfild"]["$numbers[$z]"]["coin"]="$coinplus";
$juser = json_encode($juser,true);
file_put_contents("data/$numbers[$z].json",$juser);
}
}
}
elseif($update->message->text != true){
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"▪️يرجى استخدام البوت فقط ❗️
▪️باستخدام الأزرار وارسال ( /start )
▪️للاستفسار وشراء نقاط راسلنا : @Gangsters_Boss",
	  	]);
}
if($textmassage=="/wow"){
   $message_id = $update->message->message_id;
   bot('sendMessage',[
   'chat_id'=>$chat_id,
   'text'=>"-_-"
]);
for($i=1;$i<=10;$i++){
sleep(1);
$str = str_repeat("➖", $i);
$strx = $str."".$i."0%";
  bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id +1,
   'text'=>"$strx"
        ]);
}
  bot('editMessageText',[
   'chat_id'=>$chat_id,
    'message_id'=>$message_id +1,
   'text'=>"Done ✅"
        ]);
}
$settings = $juser["userfild"]["$from_id"]["file"];
if($textmassage){
if($settings == "none"){
$arr = $user['finance'];
$channel = array_rand($arr);
$channelincoin = $arr[$channel][1];
$channelssssss = $arr[$channel][0];
$join = file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=$channelssssss&user_id=".$from_id);
if((strpos($join,'"status":"left"') or strpos($join,'"Bad Request: USER_ID_INVALID"') or strpos($join,'"status":"kicked"')) !== false){
if(!in_array($channelssssss, $juser["userfild"]["$from_id"]["channeljoin"])) {
if($channelincoin > 0){
$text_add = "انضم إلى القناة ".$arr[$channel][0]." ✅
 واحصل على 10 نقاط 💰";
           bot('sendmessage',[
          	'chat_id'=>$chat_id,
          	'text'=>$text_add,
                 'reply_markup'=>json_encode([
                     'inline_keyboard'=>[
  				   [
               ['text'=>"تحقق من الانضمام ♻️",'callback_data'=>"finance_".$channel]
  				   ],
                       ]
                 ])
   ]);
}else {
@$usernew = json_decode(file_get_contents("data/user.json"),true);
unset($usernew['finance'][$channel]);
$usernew = json_encode($usernew,true);
file_put_contents("data/user.json",$usernew);
}
}
}
}
}

if(preg_match("/^(finance)_(.*)/s",$data)){
   preg_match("/^(finance)_(.*)/s",$data,$matchaa);
  $numarr = $matchaa[2];
  $arr = $user['finance'];
  $channel = $arr[$numarr][0];
  $join = file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=$channel&user_id=".$fromid);
  if((strpos($join,'"status":"left"') or strpos($join,'"Bad Request: USER_ID_INVALID"') or strpos($join,'"status":"kicked"'))=== false){

$member = $arr[$numarr][1];
$downchannel = $member - 1;

if($downchannel <= 0){
@$usernew = json_decode(file_get_contents("data/user.json"),true);
unset($usernew['finance'][$numarr]);
$usernew = json_encode($usernew,true);
file_put_contents("data/user.json",$usernew);
}else {

@$usernew = json_decode(file_get_contents("data/user.json"),true);
$usernew['finance'][$numarr] = [$channel,$downchannel];
$usernew = json_encode($usernew,true);
file_put_contents("data/user.json",$usernew);
}

 bot('deleteMessage',[
   'chat_id'=>$chatid,
   'message_id'=>$messageid
       ]);
 bot('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "تم الانضمام بنجاح ✅
وتم إعطاءك [10] نقاط إلى حسابك 💰
-",
            'show_alert' =>true
        ]);
    $inuser = json_decode(file_get_contents("data/$fromid.json"),true);
    $coin = $inuser["userfild"]["$fromid"]["coin"];
    $inuser["userfild"]["$fromid"]["channeljoin"][]="$channel";
    $coinplus = $coin + 10;
    $inuser["userfild"]["$fromid"]["coin"]="$coinplus";
    $inuser = json_encode($inuser,true);
    file_put_contents("data/$fromid.json",$inuser);
}else {
  bot('answercallbackquery', [
    'callback_query_id' =>$membercall,
    'text' => "عذرا ❗️
اشترك بالقناة أولا:)
-",
    'show_alert' =>true
]);
}
}
unlink("error_log");


?>
