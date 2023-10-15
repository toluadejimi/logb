<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// 1. https://api.telegram.org/bot6672089802:AAElshUyomrixNlnmiJNb7g75v9ku5YG3zc/getUpdates
// 2. https://api.telegram.org/bot6672089802:AAElshUyomrixNlnmiJNb7g75v9ku5YG3zc/setWebhook?url=https://telegram.logmarketplace.com/api/webhook
// 3. https://api.telegram.org/bot6672089802:AAElshUyomrixNlnmiJNb7g75v9ku5YG3zc/getWebhookInfo
// 4. https://api.telegram.org/bot<Your-token>/deleteWebhook
