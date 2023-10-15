<?php

namespace WeStacks\TeleBot\Objects;

use WeStacks\TeleBot\Contracts\TelegramObject;

/**
 * This object describes a sticker to be added to a sticker set.
 *
 * @property InputFile    $sticker       The added sticker. Pass a file_id as a String to send a file that already exists on the Telegram servers, pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data. Animated and video stickers can't be uploaded via HTTP URL. [More information on Sending Files »](https://core.telegram.org/bots/api#sending-files)
 * @property string[]     $emoji_list    List of 1-20 emoji associated with the sticker
 * @property MaskPosition $mask_position Optional. Position where the mask should be placed on faces. For “mask” stickers only.
 * @property string[]     $keywords      Optional. List of 0-20 search keywords for the sticker with total length of up to 64 characters. For “regular” and “custom_emoji” stickers only.
 */
class InputSticker extends TelegramObject
{
    protected $attributes = [
        'sticker' => 'InputFile',
        'emoji_list' => 'string[]',
        'mask_position' => 'MaskPosition',
        'keywords' => 'string[]',
    ];
}
