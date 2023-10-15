<?php

namespace WeStacks\TeleBot\Methods;

use WeStacks\TeleBot\Contracts\TelegramMethod;

/**
 * Use this method to hide the 'General' topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights. The topic will be automatically closed if it was open. Returns True on success.
 *
 * @property int    $chat_id                __Required: Yes__. Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
 */
class HideGeneralForumTopicMethod extends TelegramMethod
{
    protected string $method = 'hideGeneralForumTopic';

    protected string $expect = 'boolean';

    protected array $parameters = [
        'chat_id' => 'string',
    ];

    public function mock($arguments)
    {
        return true;
    }
}
