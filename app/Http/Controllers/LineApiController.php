<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;
use App\Models\User;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class LineApiController extends Controller
{
    protected $access_token;
    protected $channel_secret;

    public function __construct()
    {
        // :point_down: アクセストークン
        $this->access_token = env('LINE_ACCESS_TOKEN');
        // :point_down: チャンネルシークレット
        $this->channel_secret = env('LINE_CHANNEL_SECRET');
    }
    // Webhook受取処理
    public function postWebhook(Request $request) {
 
        $http_client = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->access_token);
        $bot         = new \LINE\LINEBot($http_client, ['channelSecret' => $this->channel_secret]);
        
        $signature = $request->headers->get(HTTPHeader::LINE_SIGNATURE);
        if(!signature){
            return;
        }
        
        $events = $bot->parseEventRequest($request->getContent(),$signature);
        foreach($events as $event){
            $lien_id = $event->getUserId();
            $replyToken = $event->getReplyToken();
            if ($reply_token == '00000000000000000000000000000000') {
                Log::info('Succeeded');
                return;
            }
            switch($event){
                case($event instanceof FollowEvent):
                    $message='友達登録ありがとう';
                    $response = $bot->replyText($replyToken,$message);
                    return;
                
                case($event instanceof UnfollowEvent):
                    return;
                    
                case($event instanceof StickerMessage):
                    $message = 'スタンプありがとう';
                    $response = $bot->replyText($replyToken,$message);
                    return;
                    
                case($event instanceof TextMessage):
                    $send_Text = $event->getText();
                    $message = $send_Text;
                    $response = $bot->replyText($replyToken,$message);
                    return;
            }
        }
        
    }
    
    // メッセージ送信用
    public function sendMessage(Request $request) {
    }
}
