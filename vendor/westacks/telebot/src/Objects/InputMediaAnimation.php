<?php

namespace WeStacks\TeleBot\Objects;

/**
 * Represents an animation file (GIF or H.264/MPEG-4 AVC video without sound) to be sent.
 *
 * @property string          $type             Type of the result, must be animation
 * @property InputFile       $media            File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://” to upload a new one using multipart/form-data under  name. More info on Sending Files »
 * @property InputFile       $thumbnail        Optional. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://” if the thumbnail was uploaded using multipart/form-data under . More info on Sending Files »
 * @property string          $caption          Optional. Caption of the animation to be sent, 0-1024 characters after entities parsing
 * @property string          $parse_mode       Optional. Mode for parsing entities in the animation caption. See formatting options for more details.
 * @property MessageEntity[] $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
 * @property int             $width            Optional. Animation width
 * @property int             $height           Optional. Animation height
 * @property int             $duration         Optional. Animation duration in seconds
 * @property bool         $has_spoiler      Optional. Pass True if the animation needs to be covered with a spoiler animation
 */
class InputMediaAnimation extends InputMedia
{
    protected $attributes = [
        'type' => 'string',
        'media' => 'InputFile',
        'thumbnail' => 'InputFile',
        'caption' => 'string',
        'parse_mode' => 'string',
        'caption_entities' => 'MessageEntity[]',
        'width' => 'integer',
        'height' => 'integer',
        'duration' => 'integer',
        'has_spoiler' => 'boolean',
    ];
}
