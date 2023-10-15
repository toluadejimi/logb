<?php

namespace WeStacks\TeleBot\Objects;

/**
 * Represents a link to an MP3 audio file stored on the Telegram servers. By default, this audio file will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the audio.
 *
 * @property string               $type                  Type of the result, must be audio
 * @property string               $id                    Unique identifier for this result, 1-64 bytes
 * @property string               $audio_file_id         A valid file identifier for the audio file
 * @property string               $caption               Optional. Caption, 0-1024 characters after entities parsing
 * @property string               $parse_mode            Optional. Mode for parsing entities in the audio caption. See formatting options for more details.
 * @property MessageEntity[]      $caption_entities      Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
 * @property InlineKeyboardMarkup $reply_markup          Optional. Inline keyboard attached to the message
 * @property InputMessageContent  $input_message_content Optional. Content of the message to be sent instead of the audio
 */
class InlineQueryResultCachedAudio extends InlineQueryResult
{
    protected $attributes = [
        'type' => 'string',
        'id' => 'string',
        'audio_file_id' => 'string',
        'caption' => 'string',
        'parse_mode' => 'string',
        'caption_entities' => 'MessageEntity[]',
        'reply_markup' => 'InlineKeyboardMarkup',
        'input_message_content' => 'InputMessageContent',
    ];
}
