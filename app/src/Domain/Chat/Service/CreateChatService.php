<?php

declare(strict_types=1);

namespace App\Domain\Chat\Service;

use App\Domain\Chat\Chat;
use App\Domain\Chat\Repository\ChatRepository;
use App\Domain\User\User;

readonly class CreateChatService
{
    public function __construct(public ChatRepository $repository) {}

    /**
     * @psalm-param list<User> $participants
     */
    public function create(array $participants): Chat
    {
        $chat = new Chat();

        foreach ($participants as $participant) {
            $chat->participants->add($participant);
            $participant->chats->add($chat);
        }

        $this->repository->add($chat);

        return $chat;
    }
}
