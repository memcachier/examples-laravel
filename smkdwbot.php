<?php

ob_start();
//--------
$token = "[*[6023161200:AAEy8k0cifBNF4EqJb9mniYJXFsmuJD14l8]*]"; # Token
$IDBOT = "[*[6023161200]*]";
$userbot = "[*[@ss0ebot]*]";



define('API_KEY',$token);
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



# Short
$update = json_decode(file_get_contents("php://input"));
$message = $update->message;
$txt = $message->caption;
$text = $message->text;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
$new = $message->new_chat_members;
$message_id = $message->message_id;
$type = $message->chat->type;
$name = $message->from->first_name;

if(isset($update->callback_query)){
$up = $update->callback_query;
$chat_id = $up->message->chat->id;
$from_id = $up->from->id;
$user = $up->from->username;
$name = $up->from->first_name;
$message_id = $up->message->message_id;
$data = $up->data;
}

if(isset($update->inline_query)){
$chat_id = $update->inline_query->chat->id;
$from_id = $update->inline_query->from->id;
$name = $update->inline_query->from->first_name.' '.$update->inline_query->from->last_name;
$text_inline = $update->inline_query->query;
$mes_id = $update->inline_query->inline_message_id; 
$user = strtolower($update->inline_query->from->username); 
}

@$infobots = json_decode(file_get_contents("../../botmake/infobots.json"),true);


$namebot=$infobots["info"][$userbot]["namebot"];
$idbot=$infobots["info"][$userbot]["idbot"];

$admin=$infobots["info"][$userbot]["admin"];

mkdir("data");
 //ايديك
$reply = $message->reply_to_message->message_id;
$rep = $message->reply_to_message->forward_from; 

require_once("../../test/type.php");



