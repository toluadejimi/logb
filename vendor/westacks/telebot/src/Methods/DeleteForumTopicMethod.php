<?php

namespace WeStacks\TeleBot\Methods;

use WeStacks\TeleBot\Contracts\TelegramMethod;

/**
 * Use this method to delete a forum topic along with all its messages in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_delete_messages administrator rights. Returns True on success.
 *
 * @property int    $chat_id                __Required: Yes__. Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
 * @property int    $message_thread_id      __Required: Yes__. Unique identifier for the target message thread of the forum topic
 */
class DeleteForumTopicMethod extends TelegramMethod
{
    protected string $method = 'deleteForumTopic';

    protected string $expect = 'boolean';

    protected array $parameters = [
        'chat_id' => 'string',
        'message_thread_id' => 'integer',
    ];

    public function mock($arguments)
    {
        return true;
    }
}
