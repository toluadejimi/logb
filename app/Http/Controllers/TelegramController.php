<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\MainItem;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;
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



        $json = json_encode($request->all());





        $data = json_decode($json, true);

        if ($data === null) {
            return "Invalid JSON";
        }


        $message_text = $data['message']['text'];
        $user_id =  $data['message']['from']['id'];

        // $username = User::where('t_user_id', $user_id)->first()->username ?? null;
        // $balance = User::where('t_user_id', $user_id)->first()->wallet ?? null;
        // $username = User::where('t_user_id', $user_id)->first()->username ?? null;


        // if($username == null){



        // }


        if (str_contains($message_text, 'set')) {


            $message = "Welcome";

            $this->sendMessage([
                'chat_id' => $user_id,
                'text' => $message,
            ]);
        }

        if (str_contains($message_text, '@')) {


            $user_id =  $data['message']['from']['id'];
            $user_id = User::where('t_user_id', $user_id)->first()->t_user_id ?? null;
            if ($user_id == null) {


                $user_id =  $data['message']['from']['id'];

                User::where('email', $message_text)->update([
                    't_user_id' => $data['message']['from']['id']
                ]);

                $message = "Email has been registered\n
                /main_menu";

                $this->sendMessage([
                    'chat_id' => $user_id,
                    'text' => $message,
                ]);
            } else {

                $wallet = User::where('t_user_id', $data['message']['from']['id'])->first()->wallet ?? null;

                $amount = number_format($wallet, 2);
                $message = "Your Account Balance is :- NGN$amount";

                $this->sendMessage([
                    'chat_id' => $user_id,
                    'text' => $message,
                ]);
            }
        }


        if (str_contains($message_text, 'Buy_now')) {

            $p_id = preg_replace("/[^\d]/", "", $message_text);

            $log = MainItem::where('id', $p_id)->first()->name;
            $log_amount = MainItem::where('id', $p_id)->first()->amount;



            $wallet = User::where('t_user_id', $user_id)->first()->wallet;


            if($log_amount > $wallet){

                $message = "Insufficient Funds Fund your wallet. | click /fund_wallet to fund wallet";

                $this->sendMessage([
                    'chat_id' => $user_id,
                    'text' => $message,
                ]);

            }else{


            //MainItem::where('id', $p_id)->delete();

            $this->sendMessage([
                'chat_id' => $user_id,
                'text' => $log,
            ]);

            }








        }









        if ($message_text == "/fund_wallet") {


             $user_id =  $data['message']['from']['id'];


             $message ="Go to https://logmarketplace.com/fund-wallet";


            $this->sendMessage([
                'chat_id' => $user_id,
                'text' => $message,
            ]);

        }



        if ($message_text == "/buy_log") {

            $user_id =  $data['message']['from']['id'];


            $message =
                "Please select a service

            1. /GV - To Buy Google Voice  Logs\n
            2. /Facebook - To Buy Facebook Logs \n
            3. /Instgram -  To Buy Instaragm Logs\n
            4. /Talkatone - To Buy Talkatone Logs\n

            Go back to menu
            /main_menu \n\n";


            $this->sendMessage([
                'chat_id' => $user_id,
                'text' => $message,
            ]);
        }




        if ($message_text == "Hi" || $message_text == "/start" || $message_text == "hi" || $message_text == "/main_menu") {


            $message = "
            ==================================
            Welcome To LogsMarket
            One stop shop for all your logs
            ==================================
            \n
            /account_balance - Check your account balance\n
            /fund_wallet - Fund Your Wallet\n
            /buy_log - Buy Logs\n
            /contact - Contact Us


            ";

            $this->sendMessage([
                'chat_id' => $user_id,
                'text' => $message,
            ]);







        }


        if ($message_text == "/account_balance") {

            $user_id =  $data['message']['from']['id'];

            $username = User::where('t_user_id', $user_id)->first()->username ?? null;

            if ($username == null) {

                $message = "Please kindly reply with your email to proceed";

                $this->sendMessage([
                    'chat_id' => $user_id,
                    'text' => $message,
                ]);
            } else {


                $balance = User::where('t_user_id', $user_id)->first()->wallet ?? null;

                $amount = number_format($balance, 2);
                $message = "Your Account Balance is :- NGN$amount";

                $this->sendMessage([
                    'chat_id' => $user_id,
                    'text' => $message,
                ]);
            }
        }



        if ($message_text == "/GV") {


            $get_item = MainItem::select('des', 'id', 'amount')->where('product_id', 3)->take(10)->get() ?? null;

            if ($get_item->isEmpty()) {

                $message = "No Google Voice Logs available at the moment";

                $this->sendMessage([
                    'chat_id' => $data['message']['from']['id'],
                    'text' => $message,
                ]);
            }

            $formattedRow = [];
            foreach ($get_item as $value) {
                $formattedRow[] = "/Buy_now" . $value['id'] . " | " . $value['des'] . " | NGN " . $value['amount'];
            }
            $text = implode("\n", $formattedRow) . "\n";
            $filename = date('ymdhis') . 'data.txt';


            $message = "List of Available Google Voice Number \n\n $text";

            $this->sendMessage([
                'chat_id' => $data['message']['from']['id'],
                'text' => $message,
            ]);
        }







        if ($message_text == "/Facebook") {


            $get_item = MainItem::select('des', 'id', 'amount')->where('product_id', 1)->take(10)->get() ?? null;

            if ($get_item->isEmpty()) {

                $message = "No Facebook Logs available at the moment";

                $this->sendMessage([
                    'chat_id' => $data['message']['from']['id'],
                    'text' => $message,
                ]);
            } else {

                $formattedRow = [];
                foreach ($get_item as $value) {
                    $formattedRow[] = "/" . $value['id'] . " | " . $value['des'] . " | NGN " . $value['amount'];
                }
                $text = implode("\n", $formattedRow) . "\n";
                $filename = date('ymdhis') . 'data.txt';


                $message = "List of Available Facebook Logs \n\n $text";

                $this->sendMessage([
                    'chat_id' => $data['message']['from']['id'],
                    'text' => $message,
                ]);
            }
        }
    }




    private function sendMessage($data)
    {
        $token = env('TELEGRAM_BOT_TOKEN');

        $url = "https://api.telegram.org/bot$token/sendMessage";

        $response = Http::post($url, $data);
    }




    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function WelcomeMessage($message, $chat_id)
    {
        try {
            $message = $this->bot->sendMessage([
                'chat_id'      => $chat_id,
                'text'         => $message,
                'reply_markup' => [
                    'inline_keyboard' => [[[
                        'text' => '/Account Balance',
                    ]]],
                ],
            ]);
            // $message = $this->bot->sendMessage([
            //     'chat_id' => $this->chat_id,
            //     'text'    => 'Welcome To Code-180 Youtube Channel',
            // ]);
        } catch (Exception $e) {
            $message = 'Message: ' . $e->getMessage();
        }
        return Response::json($message);
    }
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
