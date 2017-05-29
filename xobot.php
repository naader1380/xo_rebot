<?php

ob_start();

define('API_KEY','320553356:AAHul_HJMhOIi5TlsgmBTuScFEX2Br50URU');
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
$boolean = file_get_contents('booleans.txt');
$booleans= explode("\n",$boolean);
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$message_id = $message->message_id;
$chat_id = $message->chat->id;
$fname = $message->chat->first_name;
$uname = $message->chat->username;
$text = $message->text;
$fadmin = $message->from->id;
$step= file_get_contents("data/$fadmin/type.txt","a+");
$chatid = $update->callback_query->message->chat->id;
$data = $update->callback_query->data;
$reply = $update->message->reply_to_message->forward_from->id;
$forward = $update->message->forward_from;
$query=$update->callback_query;
$inline=$update->inline_query;
$channel_forward = $update->channel_post->forward_from;
$channel_text = $update->channel_post->text;
$messageid = $update->callback_query->message->message_id;



$sta1="سلام این ربات قابلیت حرف زدن دارد 
جهت مکامله کلمه ای بفرستید";


$sta2= json_encode(['inline_keyboard'=>[
    [['text'=>'سازنده' ,'url'=>"http://telegram.me/megaphp"]],

    
]]);

if ($text == "/start"){
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>$sta1,
            'parse_mode'=>"HTML",
            'reply_markup'=>$sta2,
            
        ]);

}else{
$text=urlencode($text);
$g=json_decode(file_get_contents("http://sandbox.api.simsimi.com/request.p?key=59346dd3-d669-44ef-9e1a-5da843467489&lc=en&ft=1.0&text=$text"));
$t=$g->response;
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>$t
]);
}

?>
