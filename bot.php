<?php 

/*
by: MEMO_O1
CH : XX_l56l_XX
Ch2 : DEV_1IRAQ
*/

ob_start();
$API_KEY = '6023161200:AAEy8k0cifBNF4EqJb9mniYJXFsmuJD14l8'; //add your bot token
$sudo = 409154425; // add your id
$bot_id = 568041858; 
$e = "@TPME_BOT";
define('API_KEY',$API_KEY);
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
var_dump($update);
$message    = $update->message;
$from_id    = $message->from->id;
$text       = $message->text;
$chat_id    = $message->chat->id;
$new        = $message->new_chat_member;
$left       = $update->message->left_chat_member;
$contact    = $update->message->contact;
$audio      = $update->message->audio;
$location   = $update->message->location;
$memb       = $update->message->message_id;
$game       = $update->message->game; 
$user = $message->from->username; 
$name = $message->from->first_name;
$t =$message->chat->title;

$chat_id2 = $update->callback_query->message->chat->id;
$re_user = $update->message->reply_to_message->from->username;
$user_id = $update->message->from->id;
$re_name = $update->message->reply_to_message->from->first_name;
$re_msgid = $update->message->reply_to_message->message_id;
$url2 = "http://api.telegram.org/bot".API_KEY."/getChatMembersCount?chat_id=$chat_id";
$getmember = file_get_contents($url2);
$json2 = json_decode($getmember);
$result2 = $json2->result;  
$for        = $update->message->from->id;
$sticker    = $update->message->sticker;
$video      = $update->message->video;
$photo      = $update->message->photo;
$voice      = $update->message->voice;
$doc        = $update->message->document;
$fwd        = $update->message->forward_from;
$re         = $update->message->reply_to_message;
$re_id      = $update->message->reply_to_message->from->id;
$re_user    = $update->message->reply_to_message->from->username;
$re_msgid   = $update->message->reply_to_message->message_id;
$type       = $update->message->chat->type;
$mid        = $message->message_id;

$number     = str_word_count($text);
$numper     = strlen($text);
$set        = file_get_contents("data/$chat_id.txt");
$ex         = explode("\n", $set);
$photo1     = $ex[0];
$sticker1   = $ex[1];
$contact1   = $ex[2];
$doc1       = $ex[3];
$fwd1       = $ex[4];
$voice1     = $ex[5];
$link1      = $ex[6];
$audio1     = $ex[7];
$video1     = $ex[8];
$tag1       = $ex[9];
$mark1      = $ex[10];
$bots1      = $ex[11];
$commands = array('/add','/lock photo','/lock voice','/lock audio','/lock video','/lock link','/lock user','/lock sticker','/lock contact','/lock doc','/promote','/ban','/kick','/pin','/setname',"قفل الصور","قفل البصمات","قفل الصوت","قفل الفيديو","قفل الروابط","قفل الجهات","قفل الملفات","حظر","طرد","رفع ادمن","ضع اسم","تثبيت","/link","الرابط");
$s = file_get_contents("https://api.telegram.org/bot$API_KEY/getChatMember?chat_id=$chat_id&user_id=".$bot_id);
$ss = json_decode($s, true);
$bot = $ss['result']['status'];
if(in_array($text, $commands) and $bot != "administrator"){
  bot('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"🚫┇للأسف البوت ليس ادمن في المجموعة",
  'reply_to_message_id'=>$mid
    ]);
}
$get = file_get_contents("https://api.telegram.org/bot$API_KEY/getChatMember?chat_id=$chat_id&user_id=".$from_id);
$info = json_decode($get, true);
$you = $info['result']['status'];
$gp_get = file_get_contents("data/groups.txt");
$groups = explode("\n", $gp_get);
 

if ($type == "supergroup" and in_array($chat_id, $groups)){
  
  if($you != "creator" && $you != "administrator" && $from_id != $sudo){
    if($photo && $photo1 == "l"){
        bot('deleteMessage',[
            'chat_id'=>$chat_id,
            'message_id'=>$message->message_id
        ]);
    }

    if($voice and $voice1 == "l"){
      bot('deleteMessage',[
          'chat_id'=>$chat_id,
          'message_id'=>$message->message_id
      ]);
    } 
    if($audio && $audio1 == "l"){
      bot('deleteMessage',[
          'chat_id'=>$chat_id,
          'message_id'=>$message->message_id
      ]);
    }
    if($video && $video1 == "l"){
      bot('deleteMessage',[
          'chat_id'=>$chat_id,
          'message_id'=>$message->message_id
      ]);
    }
    if($link1 == "l" and preg_match('/^(.*)([Hh]ttp|[Hh]ttps|t.me)(.*)|([Hh]ttp|[Hh]ttps|t.me)(.*)|(.*)([Hh]ttp|[Hh]ttps|t.me)|(.*)[Tt]elegram.me(.*)|[Tt]elegram.me(.*)|(.*)[Tt]elegram.me|(.*)[Tt].me(.*)|[Tt].me(.*)|(.*)[Tt].me/',$text) ){
       bot('deleteMessage',[
         'chat_id'=>$chat_id,
         'message_id'=>$message->message_id
      ]);
    } 
    if($tag1 == "l" and  preg_match('/^(.*)@|@(.*)|(.*)@(.*)|(.*)#(.*)|#(.*)|(.*)#/',$text)){
       bot('deleteMessage',[
        'chat_id'=>$chat_id,
        'message_id'=>$message->message_id
       ]);
    }
    if($doc and $doc1 == "l"){
      bot('deleteMessage',[
          'chat_id'=>$chat_id,
          'message_id'=>$message->message_id
      ]);
    }
    if($sticker and $sticker1 == "l"){
      bot('deleteMessage',[
          'chat_id'=>$chat_id,
          'message_id'=>$message->message_id
      ]);
    }
    if($update->message->forward_from && $fwd1 == "l"){
      bot('deleteMessage',[
          'chat_id'=>$chat_id,
          'message_id'=>$message->message_id
      ]);
    }
    if($message->entities and $mark1 == "l"){
      bot('deleteMessage',[
          'chat_id'=>$chat_id,
          'message_id'=>$message->message_id
      ]);
    }
    if($new and $bots1 == "l"){
      $new_user = $new->username;
      if (preg_match('/^(.*)([Bb][Oo][Tt]/', $new_user)) {
        bot('kickChatMember',[
          'chat_id'=>$chat_id,
          'user_id'=>$new->id
          ]);
      }
    }
  }

if($bot == "administrator"){
if($you == "creator" or $you == "administrator") {
$re_user    = $update->message->reply_to_message->from->username;
  if($re  &&  $text == "مسح"){
    bot('deleteMessage',[
        'chat_id'=>$chat_id,
        'message_id'=>$re_msgid
    ]);
  }
  if($re and $re_id != $bot and $re_id != $sudo and $text=="/ban" or $text == "حظر" or $text == "/kick" or $text=="طرد"){
    bot('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"👤┇العضو ~⪼ ( $re_id ) 
☑┇تم حظره من المجموعه",
  'reply_to_message_id'=>$mid
      ]);
    bot('kickChatMember',[
        'chat_id'=>$chat_id,
        'user_id'=>$re_id
      ]);
  }
  if($re and $re_id != $bot and $re_id != $sudo and $text=="/unban" or $text == "الغاء حظر"){
    bot('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"👤┇العضو ~⪼ ( $re_id ) 
☑️ تم الغاء حظره من البوت",
  'reply_to_message_id'=>$mid
      ]);
    bot('unbanChatMember',[
        'chat_id'=>$chat_id,
        'user_id'=>$re_id
      ]);
    }
  if($text == "/promote" or $text == "رفع ادمن"){
      bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"👤┇العضو ~⪼ ( $re_id ) 
☑ ┇تم رفعه ادمن",
  'reply_to_message_id'=>$mid
      ]);
      bot('promoteChatMember',[
          'chat_id'=>$chat_id,
          'user_id'=>$re_id
        ]);
  }
  $ename = str_replace("/setname ", "$ename", $text);
  $aname = str_replace("وضع اسم ", "$aname", $text);
  if($text == "/setname $ename"){
    bot('setChatTitle',[
      'chat_id'=>$chat_id,
      'title'=>$ename 
      ]);
  }
   if($text == "وضع اسم $aname"){
     bot('setChatTitle',[
      'chat_id'=>$chat_id,
      'title'=>$aname 
      ]);
   }
   if($re and $text == "pin" or $text == "تثبيت"){
    bot('pinChatMessage',[
        'chat_id'=>$chat_id,
        'message_id'=>$re_msgid
      ]);
   }
   if($text == "/lock photo" or $text == "قفل الصور"){
    file_put_contents("data/$chat_id.txt", "l\n$sticker1\n$contact1\n$doc1\n$fwd1\n$voice1\n$link1\n$audio1\n$video1\n$tag1\n$mark1\n$bots1");
     bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم قفل الصور
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
 
   if($text == "/open photo" or $text == "فتح الصور"){
    file_put_contents("data/$chat_id.txt", "o\n$sticker1\n$contact1\n$doc1\n$fwd1\n$voice1\n$link1\n$audio1\n$video1\n$tag1\n$mark1\n$bots1");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم فتح الصور
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
 
    if($text == "/lock sticker" or $text == "قفل الملصقات"){
    file_put_contents("data/$chat_id.txt", "$photo1\nl\n$contact1\n$doc1\n$fwd1\n$voice1\n$link1\n$audio1\n$video1\n$tag1\n$mark1\n$bots1");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم قفل الملصقات
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
       if($text == "/open sticker" or $text == "فتح الملصقات"){
    file_put_contents("data/$chat_id.txt", "$photo1\no\n$contact1\n$doc1\n$fwd1\n$voice1\n$link1\n$audio1\n$video1\n$tag1\n$mark1\n$bots1");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم فتح الملصقات
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
       if($text == "/lock contact" or $text == "قفل الجهات"){
    file_put_contents("data/$chat_id.txt", "$photo1\n$sticker1\nl\n$doc1\n$fwd1\n$voice1\n$link1\n$audio1\n$video1\n$tag1\n$mark1\n$bots1");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم قفل الجهات
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
 if($text == "/open contact" or $text == "فتح الجهات"){
    file_put_contents("data/$chat_id.txt", "$photo1\n$sticker1\no\n$doc1\n$fwd1\n$voice1\n$link1\n$audio1\n$video1\n$tag1\n$mark1\n$bots1");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم فتح الجهات
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
   if($text == "/lock doc" or $text == "قفل الملفات"){
    file_put_contents("data/$chat_id.txt", "$photo1\n$sticker1\n$contact1\nl\n$fwd1\n$voice1\n$link1\n$audio1\n$video1\n$tag1\n$mark1\n$bots1");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم قفل الملفات
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
  if($text == "/open doc" or $text == "فتح الملفات"){
    file_put_contents("data/$chat_id.txt", "$photo1\n$sticker1\n$contact1\no\n$fwd1\n$voice1\n$link1\n$audio1\n$video1\n$tag1\n$mark1\n$bots1");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم فتح الملفات
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
if($text == "/lock fwd" or $text == "قفل التوجيه"){
    file_put_contents("data/$chat_id.txt", "$photo1\n$sticker1\n$contact1\n$doc1\nl\n$voice1\n$link1\n$audio1\n$video1\n$tag1\n$mark1\n$bots1");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم قفل التوجيه
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
   if($text == "/open fwd" or $text == "فتح التوجيه"){
    file_put_contents("data/$chat_id.txt", "$photo1\n$sticker1\n$contact1\n$doc1\no\n$voice1\n$link1\n$audio1\n$video1\n$tag1\n$mark1\n$bots1");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم فتح التوجيه
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
   if($text == "/lock voice" or $text == "قفل البصمات"){
    file_put_contents("data/$chat_id.txt", "$photo1\n$sticker1\n$contact1\n$doc1\n$fwd1\nl\n$link1\n$audio1\n$video1\n$tag1\n$mark1\n$bots1");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم قفل البصمات
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
     if($text == "/open voice" or $text == "فتح البصمات"){
    file_put_contents("data/$chat_id.txt", "$photo1\n$sticker1\n$contact1\n$doc1\n$fwd1\no\n$link1\n$audio1\n$video1\n$tag1\n$mark1\n$bots1");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم فتح البصمات
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
     if($text == "/lock link" or $text == "قفل الروابط"){
    file_put_contents("data/$chat_id.txt", "$photo1\n$sticker1\n$contact1\n$doc1\n$fwd1\n$voice1\nl\n$audio1\n$video1\n$tag1\n$mark1\n$bots1");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم قفل الروابط
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
   if($text == "/open link" or $text == "فتح الروابط"){
    file_put_contents("data/$chat_id.txt", "$photo1\n$sticker1\n$contact1\n$doc1\n$fwd1\n$voice1\no\n$audio1\n$video1\n$tag1\n$mark1\n$bots1");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم فتح الروابط
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
   if($text == "/lock audio" or $text == "قفل الصوت"){
    file_put_contents("data/$chat_id.txt", "$photo1\n$sticker1\n$contact1\n$doc1\n$fwd1\n$voice1\n$link1\nl\n$video1\n$tag1\n$mark1\n$bots1");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم قفل الصوت
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
   if($text == "/open audio" or $text == "فتح الصوت"){
    file_put_contents("data/$chat_id.txt", "$photo1\n$sticker1\n$contact1\n$doc1\n$fwd1\n$voice1\n$link1\no\n$video1\n$tag1\n$mark1\n$bots1");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم فتح الصوت
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
   if($text == "/lock video" or $text == "قفل الفيديو"){
    file_put_contents("data/$chat_id.txt", "$photo1\n$sticker1\n$contact1\n$doc1\n$fwd1\n$voice1\n$link1\n$audio1\nl\n$tag1\n$mark1\n$bots1");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم قفل الفيديو
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
   if($text == "/open video" or $text == "فتح الفيديو"){
    file_put_contents("data/$chat_id.txt", "$photo1\n$sticker1\n$contact1\n$doc1\n$fwd1\n$voice1\n$link1\n$audio1\no\n$tag1\n$mark1\n$bots1");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم فتح الفيديو
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
   if($text == "/lock user" or $text == "قفل المعرف"){
    file_put_contents("data/$chat_id.txt", "$photo1\n$sticker1\n$contact1\n$doc1\n$fwd1\n$voice1\n$link1\n$audio1\n$video1\nl\n$mark1\n$bots1");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم قفل المعرف
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
   if($text == "/open user" or $text == "فتح المعرف"){
    file_put_contents("data/$chat_id.txt", "$photo1\n$sticker1\n$contact1\n$doc1\n$fwd1\n$voice1\n$link1\n$audio1\n$video1\no\n$mark1\n$bots1");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم فتح المعرف
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
    if($text == "/lock mark" or $text == "قفل الماركدون"){
    file_put_contents("data/$chat_id.txt", "$photo1\n$sticker1\n$contact1\n$doc1\n$fwd1\n$voice1\n$link1\n$audio1\n$video1\n$tag1\nl\n$bots1");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم قفل الماركدون
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
   if($text == "/open mark" or $text == "فتح الماركدون"){
    file_put_contents("data/$chat_id.txt", "$photo1\n$sticker1\n$contact1\n$doc1\n$fwd1\n$voice1\n$link1\n$audio1\n$video1\n$tag1\no\n$bots1");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم فتح الماركدون
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
  if($text == "/lock bots" or $text == "قفل البوتات"){
    file_put_contents("data/$chat_id.txt", "$photo1\n$sticker1\n$contact1\n$doc1\n$fwd1\n$voice1\n$link1\n$audio1\n$video1\n$tag1\n$mark1\nl");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم قفل البوتات
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
   if($text == "/open bots" or $text == "فتح البوتات"){
    file_put_contents("data/$chat_id.txt", "$photo1\n$sticker1\n$contact1\n$doc1\n$fwd1\n$voice1\n$link1\n$audio1\n$video1\n$tag1\n$mark1\no");
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💬┇بواسطه ~⪼ ( [$name] )
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ 
☑┇تم فتح البوتات
🗑┇خاصية ~⪼ المسح",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
      ]);
   }
   if($text=="الاوامر"){
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"📮┇هناكـ {3} اوامر لعرضها
 ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉
🗑┇م1 ~> لعرض اوامر الحمايه

🚫┇م2 ~> لعرض اوامر الاداره

🚷┇م3 ~> لعرض اوامر المطور

 ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉",
      ]);
   }
   if($text=="م1"){
    bot('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"📮┇ اوامر حمايه المجموعه بالمسح
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉
🔒┇قفل ~⪼ لقفل امر
🔓┇فتح ~⪼ لفتح امر
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉
🔐┇الروابط
🔐┇المعرف
🔐┇التعديل
🔐┇المتحركه
🔐┇الملفات
🔐┇الصور
🔐┇الملصقات
🔐┇الفيديو
🔐┇التوجيه
🔐┇الصوت
🔐┇الجهات
🔐┇الماركدون
🔐┇البوتات
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉",
      ]);
  }
 }
}
if($text=="م2"){
    bot('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"🥈┇اوامر الاداره
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉
🚫┇كتم
🚫┇حظر
🚫┇طرد
🚹┇الغاء حظر
🚹┇الغاء كتم
🚹┇تثبيت
🗑┇اعدادات 

📮┇الرابط

🕕┇الوقت

┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉
🔘┇وضع + الاوامر الادناه

📝┇اسم
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉",
      ]);
  }
 }

if($text=="م3"){
    bot('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"🎖┇اوامر المطور
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉
✔️┇تفعيل
✖️┇تعطيل
💯┇اذاعه
⚠️┇مغادره

┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉",
      ]);
  }
 
 
if($text=="اعدادات" or $text=="/setting$e" or $text=="الاعدادات"){

  bot('sendMessage',['chat_id'=>$chat_id, 'text'=>"
  
☑️┇الأعدادات

🔒┇مقفول ~⪼ l
🔓┇مفتوح ~⪼ o

┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉

🖼┇الصور ~⪼ $photo1
🎀┇الملصقات ~⪼ $sticker1

📹┇الفيديو ~⪼ $video1
🔗┇الروابط ~⪼ $link1

☎️┇الجهات ~⪼ $contact1
🗂┇الملفات ~⪼ $doc1

↩️┇التوجيه ~⪼ $fwd1
🎙┇البصمات ~⪼ $bsma1

📣┇الصوت ~⪼ $audio1
Ⓜ️┇المعرف ~⪼ $tag1

🗯┇الماركدون ~⪼ $mark1
📟┇البوتات ~⪼ $bots1
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉
",
]);
}

$id = $message->from->id;
if($bot == "administrator"){
 if ($you == "administrator" or $you == "creator") {
if($text == "/add" or $text == "/add$e" or $text=="تفعيل"){
if(!in_array($chat_id, $groups)){
  file_put_contents("data/$chat_id.txt", "o\no\no\no\nl\no\nl\no\no\nl\no");
  file_put_contents("data/groups.txt", "$chat_id\n",FILE_APPEND);
$t =  $message->chat->title;
  bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"🎫┇ايديك ~⪼ ( $id )
☑┇تم تفعيل المجموعه { $t }",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
    ]);
 }
if (in_array($chat_id, $groups)) {
$t =  $message->chat->title;
  bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"❕┇المجموعه { $t } مفعله سابقا",
  'reply_to_message_id'=>$mid,
  'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
    ]);
 }
}
}
}

 if($text == "عدد الكروبات"){
  $c = count($groups);
  bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"📊┇عدد الكروبات ~⪼  { $c }"
    ]);
 }
if($text == "اذاعه" and $for == $sudo){
  file_put_contents("mode.txt", "bc");
  bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"☑️¦ حسننا الان ارسل الكليشه للاذاعه للمجموعات"
    ]);
}
$mode = file_get_contents("mode.txt");
if($text != "اذاعة" and $mode=="bc" and $for == $sudo){
  for ($i=0; $i < count($groups); $i++) { 
    bot('sendMessage',[
      'chat_id'=>$groups[$i],
      'text'=>" $text"
    ]);
  }
  unlink("mode.txt");
}
$id   = $message->from->id; 
$user = $message->from->username; 
$name = $message->from->first_name; 
if($text=="موقعي" and $you == "creator"){
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"انت منشى 🔗 في المجموعةه ☑️ 
📡 معرفك :- @$user
🔗 ايديك :- $id
🔥 اسمك :- $name
"
]);
}
if($text=="موقعي" and  $you == "administrator"){
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"انت ادمن 🔗 في المجموعةه ☑️ 
📡 معرفك :- @$user
🔗 ايديك :- $id
🔥 اسمك :- $name"
]);
}
if($text=="موقعي" and  $you == "member"){
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"انت عضو 🔗 في المجموعةه ☑️ 
📡 معرفك :- @$user
🔗 ايديك :- $id
🔥 اسمك :- $name"
]);
}
 
$rnd = rand(1,999999999999999999);
if($text=="معلوماتي" or $text == "ايدي" or $text == "/id" or $text == "id"){
$re = bot("getUserProfilePhotos",["user_id"=>$id,"limit"=>1,"offset"=>0]);
$res = $re->result->photos[0][2]->file_id;
$pa = bot("getFile",["file_id"=>$res]);
$path = $pa->result->file_path;
file_put_contents("$rnd.jpg",file_get_contents("https://api.telegram.org/file/bot".$API_KEY."/".$path));
$uphoto = "http://devmemo1.000webhostapp.com/$rnd.jpg"; // يوزر استضافتك
bot("sendPhoto",[
'chat_id'=>$chat_id,
"photo"=>$uphoto,
'caption'=>"
🎫┇ايديك ~⪼ ( $id )
📜┇معرفك ~⪼ @$user
📨┇رسائل المجموعه ~⪼ { $message->message_id }
🔘┇اسمك ~⪼ $name
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($re and $text == "جلب صورته"){
  $g = bot("getUserProfilePhotos",["user_id"=>$re_id,"limit"=>1,"offset"=>0]);
$r = $g->result->photos[0][2]->file_id;
$pa = bot("getFile",["file_id"=>$r]);
$path = $pa->result->file_path;
file_put_contents("$rnd.jpg",file_get_contents("https://api.telegram.org/file/bot".$API_KEY."/".$path));
$uphoto = "http://alsaednnn.000webhostapp.com/$rnd.jpg"; // بوزر استضافتك
bot("sendPhoto",[
'chat_id'=>$chat_id,
"photo"=>$uphoto,
]);
unlink("$rnd.jpg");
}

$New_member = $message->new_chat_member;
$usser = $New_member->username;
$id = $New_member->id; 
$id_bot = 568041858;
if(preg_match('/^(.*)([Bb][Oo][Tt])/',$usser) and $New_member and $id != $id_bot){
bot('kickChatMember',[
'chat_id'=>$chat_id,
'user_id'=>$id
]);
}

if($text == "/link" or $text == "الرابط"){
    $export = json_decode(file_get_contents("https://api.telegram.org/bot$API_KEY/exportChatInviteLink?chat_id=$chat_id"));
    $l = $export->result;
    bot('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"📮┇رابط المجموعه
$l",
      'disable_web_page_preview'=>true,
      'reply_to_message_id'=>$message->message_id,
      ]);
  }


$get_id = explode("\n", file_get_contents( ids.txt ));
if(!in_array($from_id, $get_id)){
file_put_contents( ids.txt , "$from_id \n", FILE_APPEND);
}
if($text == "طرد المتفاعلين"){
for($zh=0;$zh<count($get_id);$zh++){
bot( kickChatMember ,[
 chat_id =>$chat_id,
 user_id =>$get_id[$zh],
]);
}
}

if($text == 'المطور' or $text == "مطور"){
bot('sendContact',[
'chat_id'=>$chat_id,
'phone_number'=>"+9647815864486",
'first_name'=>"م̶̶ـ̶̶ـ̶̶ي̶̶م̶̶ـ̶̶ـ̶̶و 34K ™`☻",
'last_name'=>"ٵڵٵڼـࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲٞ࣫࣫࣫࣫࣫࣫࣫࣫࣫࣫࣫࣫࣫࣫҉ৡـࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲٞ࣫࣫࣫࣫࣫࣫࣫࣫࣫࣫࣫࣫࣫࣫ैۖـښـࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲٞ࣫࣫࣫࣫࣫࣫࣫࣫࣫࣫࣫࣫࣫࣫҉ৡـࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲࣲैۖـٱڹ 📿 ٵلڕجُيُـُैُۖـُـُـُـُࣩࣩࣩࣩࣩࣩࣩࣩࣩࣩࣩࣩࣩࣩࣩࣩࣩࣩࣧࣧࣧࣧࣧࣧࣧࣧࣧࣧࣧۖـُـُـُـࣩࣩࣩࣩࣩࣩࣧࣧࣧࣧࣧࣧࣧࣧࣧࣧࣧم",
'reply_to_message_id'=>$message->message_id, 
]);
}




if($text == "رابط حذف" or $text == "رابط الحذف" or $text == "اريد احذف الحساب" or $text == "رابط الحذف"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>" 🗑┇رابط حذف التلي  ⬇️
‼️┇احذف ولا ترجع عيش حياتك
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉
🔎┇ https://telegram.org/deactivate
",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "شلونك" or $text == "شلونكم"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"• اَٰلْٰـحٌٰمٍٰـﮧﮧدِٰاَٰلْٰلْٰهَٰہۧ وٍّ୭اَٰنٍٰتّٰـهَٰہۧ 😼💛ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "بوت"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"• تّٰفِٰـضـﮧلْٰ حٌٰبٌِٰـہيَٰ 🌚💫ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "🙄"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"• نٍٰـہزًَلْٰ عٍِّيَٰـنٍٰكٍٰ عٍِّيَٰـﮧبٌِٰ🌚😹ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "🌚"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"• فِٰـﮧدِٰيَٰتّٰ صُِخّٰـﮧاَٰمٍٰكٍٰ🙊👄ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "🌝"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"• مٍٰنٍٰـﮧوٍّ໑رِٰ حٌٰبٌِٰـعٍِّمٍٰـہرِٰيَٰ😽💚ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "احبج"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"•جًِّـﮧذَْاَٰبٌِٰ يَٰـرِٰيَٰدِٰ يَٰطَُِـہكٍٰجًِّ😹🌞⚡️ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "تشاكي"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"• نٍٰـعٍِّـﮧﮧمٍٰ تّٰفِٰـہضلْٰ 🍁🌛ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "انجب"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"• صُِـﮧاَٰرِٰ سٌٍتّٰـﮧاَٰدِٰيَٰ🐸❤️ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "😐"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"• شَُـبٌِٰيَٰـكٍٰ صُِـﮧﮧاَٰفِٰنٍٰ عٍِّ خّٰاَٰلْٰتّٰـہكٍٰ😹🖤ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "😒"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"• شَُبٌِٰيَٰـﮧكٍٰ كٍٰاَٰلْٰـﮧبٌِٰ خّٰلْٰقٍٰتّٰـﮧكٍٰ😟🐈ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "😳"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"• هَٰہۧـاَٰ بٌِٰسٌٍ لْٰاَٰ شَُفِٰـﮧتّٰ عٍِّمٍٰتّٰـﮧكٍٰ اَٰلْٰعٍِّـﮧوٍّ໑بٌِٰهَٰہۧ😐😹ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "🙁"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"• تّٰعٍِّـﮧاَٰلْٰ اَٰشَُكٍٰيَٰلْٰـﮧيَٰ هَٰہۧمٍٰوٍّمٍٰـﮧكٍٰ لْٰيَٰـشَُ • ضاَٰيَٰـﮧجًِّ🙁💔ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "😹"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"• نٍٰشَُـﮧاَٰلْٰلْٰهَٰہۧ دِٰاَٰيَٰمٍٰـﮧهَٰہۧ💆🏻‍♂💘ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "🙂"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"• ثِْْكٍٰيَٰـﮧلْٰ نٍٰهَٰہۧنٍٰهَٰہۧنٍٰهَٰہۧنٍٰهَٰہۧ🐛ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "هلو"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"• هَٰہۧـﮧﮧلْٰاَٰوٍّ໑اَٰتّٰ 🌝☄ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "المدرسه"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"• لْٰتّٰجًِّيَٰـﮧبٌِٰ اَٰسٌٍمٍٰـﮧهَٰہۧ لْٰاَٰ اَٰطَُِـﮧرِٰدِٰكٍٰ🌞✨ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "هلاو"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"• هَٰہۧـہ୪وٍّ୭اَٰتّٰ حٌٰبٌِٰـﮧيَٰ 🤗🌟ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "احبك"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"•حٌٰبٌِٰيَٰبٌِٰـﮧيَٰ وٍّنٍٰـﮧيَٰ هَٰہۧــمٍٰ😻👅ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "اكرهك"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"•دِٰيَٰلْٰـﮧهَٰہۧ شَُـﮧوٍّ୭نٍٰ اَٰطَُِيَٰـقٍٰكٍٰ نٍٰـيَٰ 🙎🏼‍♂🖤ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "دي"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"• خّٰلْٰيَٰنٍٰـﮧيَٰ اَٰحٌٰبٌِٰـﮧكٍٰ 😾ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "شسمك"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"• اَٰسٌٍمٍٰـﮧهَٰہۧ عٍِّبٌِٰـﮧوٍّ໑سٌٍيَٰ لْٰـوٍّ૭سٌٍہيَٰ😾😹💛ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "صباح الخير"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"• صُِبٌِٰاَٰحٌٰـہكٍٰ عٍِّسٌٍـہلْٰ يَٰعٍِّسٌٍـﮧلْٰ😼🤞ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "مساء الخير"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"• مٍٰسٌٍـﮧاَٰء اَٰلْٰحٌٰـﮧبٌِٰ يَٰحٌٰہبٌِٰحٌٰہبٌِٰ🌛🔥ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "تحبني"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"• مٍٰـﮧاَٰدِٰرِٰيَٰ اَٰفِٰكٍٰـﮧرِٰ🙁😹ֆ",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "السورس"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"👋┇اهلا بك في بوت ميمو 🦁ֆ
💯┇البوت مبتكر من سورس تشاكي 
🔱┇تم عمله على هيئة ملف php 

🌐 ┇TEAM MEMO

◀┇قناة البوت ~⪼ @XX_l56l_XX
◀┇قناه تطوير ~⪼@DEV_1IRAQ",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "رفع الادمنيه"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"📊┇ تم رفع ادمنيه المجموعه في البوت",
'reply_to_message_id'=>$message->message_id, 
]);
}

/*
by: MEMO_O1
CH : XX_l56l_XX
Ch2 : DEV_1IRAQ
*/
