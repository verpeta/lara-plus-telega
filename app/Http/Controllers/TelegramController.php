<?php

namespace App\Http\Controllers;

use App\Services\TelegramAPIService;
use App\TelegramChat;
use DateTime;
use Illuminate\Http\Request;

class TelegramController extends Controller
{
    public function test(TelegramAPIService $API)
    {
        return $API->setWebhook('https://038a-178-158-205-92.ngrok.io/webhook');
        //        dd(TelegramChat::all());
    }

    public function updates(TelegramAPIService $API)
    {
        return $API->getUpdates();
    }

    public function webhook(Request $request, TelegramAPIService $API)
    {
        $bodyContent = json_decode($request->getContent(), true);

        file_put_contents('webhooks_log.txt', json_encode($bodyContent) . PHP_EOL, FILE_APPEND);

        /** @var TelegramChat $chat */
        $chat = TelegramChat::firstOrCreate(
            [
                'username' => $bodyContent['message']['chat']['username'],
                'chat_id' => $bodyContent['message']['chat']['id'],
            ]
        );
        $chat->last_message_at = (new DateTime())->format('Y-m-d H:i:s');
        $chat->save();
        $API->sendMessage([
            'chat_id' => $bodyContent['message']['chat']['id'],
            'text' => 'Hello '. $chat->username .')',
        ]);

        return 'ok';
    }

    public function index()
    {
        file_put_contents('bob.txt', json_encode($_REQUEST) . PHP_EOL, FILE_APPEND);

        return 'ok';
    }
}
