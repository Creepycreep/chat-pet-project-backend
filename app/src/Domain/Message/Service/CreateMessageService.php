<?php

declare(strict_types=1);

namespace App\Domain\Message\Service;

use App\Domain\Chat\Chat;
use App\Domain\Message\Message;
use App\Domain\Message\Repository\MessageRepository;
use App\Domain\User\User;

readonly class CreateMessageService
{
    public function __construct(public MessageRepository $repository)
    {
    }

    /**
     * @psalm-param non-empty-string $text
     */
    public function create(string $text, Chat $chat, User $user): Message
    {
        $message = new Message(text: $text, chat: $chat, author: $user);

        $this->repository->add($message);

        return $message;
    }
}
