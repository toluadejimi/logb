<?php

namespace WeStacks\TeleBot\Objects;

use WeStacks\TeleBot\Contracts\TelegramObject;

/**
 * This object represents a service message about a voice chat scheduled in the chat.
 *
 * @property int $start_date Point in time (Unix timestamp) when the voice chat is supposed to be started by a chat administrator
 */
class VideoChatScheduled extends TelegramObject
{
    protected $attributes = [
        'start_date' => 'integer',
    ];
}
