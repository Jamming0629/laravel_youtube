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
 public function callback(Request $request)
{

    /** @var LINEBot $bot */
    $bot = app('line-bot');

    $signature = $_SERVER['HTTP_'.LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
    if (!LINEBot\SignatureValidator::validateSignature($request->getContent(), env('LINE_CHANNEL_SECRET'), $signature)) {
        abort(400);
    }

    $events = $bot->parseEventRequest($request->getContent(), $signature);
    foreach ($events as $event) {
        $reply_token = $event->getReplyToken();
        $reply_message = 'その操作はサポートしてません。.[' . get_class($event) . '][' . $event->getType() . ']';

        switch (true){
            //友達登録＆ブロック解除
            case $event instanceof LINEBot\Event\FollowEvent:
                $service = new FollowService($bot);
                $reply_message = $service->execute($event)
                    ? '友達登録されたからLINE ID引っこ抜いたわー'
                    : '友達登録されたけど、登録処理に失敗したから、何もしないよ';

                break;
            //メッセージの受信
            case $event instanceof LINEBot\Event\MessageEvent\TextMessage:
                $service = new RecieveTextService($bot);
                $reply_message = $service->execute($event);
                break;

            //位置情報の受信
            case $event instanceof LINEBot\Event\MessageEvent\LocationMessage:
                $service = new RecieveLocationService($bot);
                $reply_message = $service->execute($event);
                break;

            //選択肢とか選んだ時に受信するイベント
            case $event instanceof LINEBot\Event\PostbackEvent:
                break;
            //ブロック
            case $event instanceof LINEBot\Event\UnfollowEvent:
                break;
            default:
                $body = $event->getEventBody();
                logger()->warning('Unknown event. ['. get_class($event) . ']', compact('body'));
        }

        $bot->replyText($reply_token, $reply_message);
    }
    }
}
