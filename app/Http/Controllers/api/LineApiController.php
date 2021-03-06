<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LINE\LINEBot;
use LINE\LINEBot\Constant\HTTPHeader;
use LINE\LINEBot\SignatureValidator;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use Exception;

class LineApiController extends Controller
{
 public function webhook (Request $request)
    {
        $lineAccessToken = env('LINE_ACCESS_TOKEN', "");
        $lineChannelSecret = env('LINE_CHANNEL_SECRET', "");

        // 署名のチェック
        $signature = $request->headers->get(HTTPHeader::LINE_SIGNATURE);

        if (!SignatureValidator::validateSignature($request->getContent(), $lineChannelSecret, $signature)) {
            // TODO 不正アクセス
            return;
        }

        $httpClient = new CurlHTTPClient ($lineAccessToken);
        $lineBot = new LINEBot($httpClient, ['channelSecret' => $lineChannelSecret]);

        try {
            // イベント取得
            $events = $lineBot->parseEventRequest($request->getContent(), $signature);

            foreach ($events as $event) {
                // ログファイルの設定
                // $file = __DIR__ . "/log.txt"
                // file_put_contents($file, print_r($event, true) . PHP_EOL, FILE_APPEND);
                // 入力した文字取得
                $message = $event->getText();
                $message2 = "shorts $message";
                $replyToken = $event->getReplyToken();
                $app2 = app()->make('App\Http\Controllers\YouTubeController');
                $results = $app2->line_videoLists($message2);
                $id = $results->items[0]->id->videoId;
                $url="https://www.youtube.com/embed/$id";
                $textMessage = new TextMessageBuilder($url);
                $lineBot->replyMessage($replyToken, $textMessage);
            }
        } catch (Exception $e) {
            // TODO 例外
            return;
        }
        return;
    }
}
