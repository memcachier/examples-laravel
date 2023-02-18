<?php

ob_start();
define('API_KEY','6023161200:AAEy8k0cifBNF4EqJb9mniYJXFsmuJD14l8');
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
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id = $update->callback_query->message->message_id;
$data = $update->callback_query->data;
$vvbot="BOT";
$web = substr(str_shuffle(QWERTYUIOPASDFGHJKLZXCVBNM),1,5);
 $_GET="$web"; 
  for($i = 0 ; $i = 10 ; $i++) {
  $dev_a = file_get_contents('http://t.me/'.$_GET['user'],null,null,0,1334);
preg_match('/property="og:description" content="(.*)">/',$dev_a,$match);
if($match[1] == ""){
bot('sendMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"@$web$vvbot صدتلك يوزر"]);}}
