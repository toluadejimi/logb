<?php

namespace WeStacks\TeleBot\Methods;

use WeStacks\TeleBot\Contracts\TelegramMethod;
use WeStacks\TeleBot\Objects\InputSticker;

/**
 * Use this method to add a new sticker to a set created by the bot. The format of the added sticker must match the format of the other stickers in the set. Emoji sticker sets can have up to 200 stickers. Animated and video sticker sets can have up to 50 stickers. Static sticker sets can have up to 120 stickers. Returns True on success.
 *
 * @property int          $user_id       __Required: Yes__. User identifier of sticker set owner
 * @property string       $name          __Required: Yes__. Sticker set name
 * @property InputSticker $sticker       __Required: Yes__. A JSON-serialized object with information about the added sticker. If exactly the same sticker had already been added to the set, then the set isn't changed.
 */
class AddStickerToSetMethod extends TelegramMethod
{
    protected string $method = 'addStickerToSet';

    protected string $expect = 'boolean';

    protected array $parameters = [
        'user_id' => 'string',
        'name' => 'string',
        'sticker' => 'InputSticker',
    ];

    public function mock($arguments)
    {
        return true;
    }
}
