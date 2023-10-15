<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use WeStacks\TeleBot\TeleBot;

class TelegramController extends Controller
{
    //+++++++++++++++++++++++++++++++++++++++
    private $bot;
    private $message_text;
    private $chat_id = 1316552414;


    //+++++++++++++++++++++++++++++++++++++++
    public function __construct()
    {
        $token = env('TELEGRAM_BOT_TOKEN');

        $this->bot = new TeleBot($token);
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function index()
    {
        return view('welcome');
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function telegram_webhook(Request $request)
    {

        //$data = $request->all();
        $data = json_encode($request->all());



        $message = $data;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.telegram.org/bot6140179825:AAGfAmHK6JQTLegsdpnaklnhBZ4qA1m2c64/sendMessage?chat_id=1316552414',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'chat_id' => "1316552414",
                'text' => $message,

            ),
            CURLOPT_HTTPHEADER => array(),
        ));

        $var = curl_exec($curl);
        curl_close($curl);

        $var = json_decode($var);

        // // Process the incoming data from Telegram
        // $message = $data['message']['text'];

        // // Construct the response message
        // $responseMessage = "You said: $message";

        // // Send the response back to the user on Telegram
        // $this->sendMessage([
        //     'chat_id' => $data['message']['chat']['id'],
        //     'text' => $responseMessage,
        // ]);

        // return response()->json(['message' => 'Webhook received and response sent']);
    }

    private function sendMessage($data)
    {
        $telegramToken = env('TELEGRAM_BOT_TOKEN');
        $url = "https://api.telegram.org/bot$telegramToken/sendMessage";

        $response = Http::post($url, $data);

        // You can add error handling or log the response if needed
        // For error handling, check $response->status() and $response->json()
    }


    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // public function sendMessage(Request $request)
    // {
    //     try {
    //         $message = $this->bot->sendMessage([
    //             'chat_id'      => $this->chat_id,
    //             'text'         => 'Welcome To Code-180 Youtube Channel',
    //             'reply_markup' => [
    //                 'inline_keyboard' => [[[
    //                     'text' => '@code-180',
    //                     'url'  => 'https://www.youtube.com/@code-180/videos',
    //                 ]]],
    //             ],
    //         ]);
    //         // $message = $this->bot->sendMessage([
    //         //     'chat_id' => $this->chat_id,
    //         //     'text'    => 'Welcome To Code-180 Youtube Channel',
    //         // ]);
    //     } catch (Exception $e) {
    //         $message = 'Message: ' . $e->getMessage();
    //     }
    //     return Response::json($message);
    // }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function sendPhoto(Request $request)
    {
        try {
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            // 1. https://anyurl/640
            // 2. fopen('local/file/path', 'r')
            // 3. fopen('https://picsum.photos/640', 'r'),
            // 4. new InputFile(fopen('https://picsum.photos/640', 'r'), 'test-image.jpg')
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            $message = $this->bot->sendPhoto([
                'chat_id' => $this->chat_id,
                'photo'   => [
                    'file'     => fopen(asset('public/upload/img.jpg'), 'r'),
                    'filename' => 'demoImg.jpg',
                ],
            ]);
        } catch (Exception $e) {
            $message = 'Message: ' . $e->getMessage();
        }
        return Response::json($message);
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function sendAudio(Request $request)
    {
        try {
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            // 1. https://picsum.photos/640
            // 2. fopen('local/file/path', 'r')
            // 3. fopen('https://picsum.photos/640', 'r'),
            // 4. new InputFile(fopen('https://picsum.photos/640', 'r'), 'test-image.jpg')
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            $message = $this->bot->sendAudio([
                'chat_id' => $this->chat_id,
                'audio'   => fopen(asset('public/upload/demo.mp3'), 'r'),
                'caption' => "Demo Audio File",
            ]);
        } catch (Exception $e) {
            $message = 'Message: ' . $e->getMessage();
        }
        return Response::json($message);
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function sendVideo(Request $request)
    {
        try {
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            // 1. https://picsum.photos/640
            // 2. fopen('local/file/path', 'r')
            // 3. fopen('https://picsum.photos/640', 'r'),
            // 4. new InputFile(fopen('https://picsum.photos/640', 'r'), 'test-image.jpg')
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            $message = $this->bot->sendVideo([
                'chat_id' => $this->chat_id,
                'video'   => fopen(asset('public/upload/Password.mp4'), 'r'),
            ]);
        } catch (Exception $e) {
            $message = 'Message: ' . $e->getMessage();
        }
        return Response::json($message);
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function sendVoice(Request $request)
    {
        try {
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            // 1. https://picsum.photos/640
            // 2. fopen('local/file/path', 'r')
            // 3. fopen('https://picsum.photos/640', 'r'),
            // 4. new InputFile(fopen('https://picsum.photos/640', 'r'), 'test-image.jpg')
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            $message = $this->bot->sendVoice([
                'chat_id' => $this->chat_id,
                'voice'   => fopen(asset('public/upload/demo.mp3'), 'r'),
            ]);
        } catch (Exception $e) {
            $message = 'Message: ' . $e->getMessage();
        }
        return Response::json($message);
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function sendDocument(Request $request)
    {
        try {
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            // 1. https://picsum.photos/640
            // 2. fopen('local/file/path', 'r')
            // 3. fopen('https://picsum.photos/640', 'r'),
            // 4. new InputFile(fopen('https://picsum.photos/640', 'r'), 'test-image.jpg')
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            $message = $this->bot->sendDocument([
                'chat_id'  => $this->chat_id,
                'document' => fopen(asset('public/upload/Test_Doc.pdf'), 'r'),
            ]);
        } catch (Exception $e) {
            $message = 'Message: ' . $e->getMessage();
        }
        return Response::json($message);
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function sendLocation(Request $request)
    {
        try {
            $message = $this->bot->sendLocation([
                'chat_id'   => $this->chat_id,
                'latitude'  => 19.6840852,
                'longitude' => 60.972437,
            ]);
        } catch (Exception $e) {
            $message = 'Message: ' . $e->getMessage();
        }
        return Response::json($message);
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function sendVenue(Request $request)
    {
        try {
            $message = $this->bot->sendVenue([
                'chat_id'   => $this->chat_id,
                'latitude'  => 19.6840852,
                'longitude' => 60.972437,
                'title'     => 'The New Word Of Code',
                'address'   => 'Address For The Place',
            ]);
        } catch (Exception $e) {
            $message = 'Message: ' . $e->getMessage();
        }
        return Response::json($message);
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function sendContact(Request $request)
    {
        try {
            $message = $this->bot->sendContact([
                'chat_id'      => $this->chat_id,
                'photo'        => 'https://picsum.photos/640',
                'phone_number' => '1234567890',
                'first_name'   => 'Code-180',
            ]);
        } catch (Exception $e) {
            $message = 'Message: ' . $e->getMessage();
        }
        return Response::json($message);
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function sendPoll(Request $request)
    {
        try {
            $message = $this->bot->sendPoll([
                'chat_id'  => $this->chat_id,
                'question' => 'What is best coding language for 2023',
                'options'  => ['python', 'javascript', 'typescript', 'php', 'java'],
            ]);
        } catch (Exception $e) {
            $message = 'Message: ' . $e->getMessage();
        }
        return Response::json($message);
    }

}
