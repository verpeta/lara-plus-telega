<?php

namespace App\Services;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class TelegramAPIService
{
    public function __construct()
    {
    }

    public function hello()
    {
        dd("hello");
    }

    public function setWebhook($domain)
    {
        // http://db93-178-158-205-92.ngrok.io
        // https://api.telegram.org/bot(mytoken)/setWebhook?url=https://mywebpagetorespondtobot/mymethod
        return $this->doRequest('setWebhook', ['url' => $domain]);
    }

    public function getUpdates()
    {
        // http://db93-178-158-205-92.ngrok.io
        // https://api.telegram.org/bot(mytoken)/setWebhook?url=https://mywebpagetorespondtobot/mymethod
        return $this->doRequest('getWebhookInfo');
    }

    /**
     * Send text messages.
     *
     * <code>
     * $params = [
     *       'chat_id'                     => '',  // int|string - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *       'text'                        => '',  // string     - Required. Text of the message to be sent
     *       'parse_mode'                  => '',  // string     - (Optional). Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in your bot's message.
     *       'entities'                    => '',  // array      - (Optional). List of special entities that appear in the caption, which can be specified instead of parse_mode
     *       'disable_web_page_preview'    => '',  // bool       - (Optional). Disables link previews for links in this message
     *       'protect_content'             => '',  // bool       - (Optional). Protects the contents of the sent message from forwarding and saving
     *       'disable_notification'        => '',  // bool       - (Optional). Sends the message silently. iOS users will not receive a notification, Android users will receive a notification with no sound.
     *       'reply_to_message_id'         => '',  // int        - (Optional). If the message is a reply, ID of the original message
     *       'allow_sending_without_reply' => '',  // bool       - (Optional). Pass True, if the message should be sent even if the specified replied-to message is not found
     *       'reply_markup'                => '',  // object     - (Optional). One of either InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * ]
     * </code>
     */
    public function sendMessage(array $params)
    {
        $response = $this->doRequest('sendMessage', $params);

        return $response;
    }

    /**
     * @param string $method
     * @return void
     */
    private function getBasicUrl(string $method): string
    {
        return 'https://api.telegram.org/bot' . $this->getApiToken() . '/' . $method;
    }

    private function doRequest(string $method, array $params = []): PromiseInterface|Response
    {
        $url = $this->getBasicUrl($method);

        return Http::get($url, $params);
    }

    private function getApiToken()
    {
        return env('TELEGRAM_API_TOKEN');
    }
}
