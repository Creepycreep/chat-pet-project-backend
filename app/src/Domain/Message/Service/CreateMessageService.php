<?php

declare(strict_types=1);

namespace App\Domain\Message\Service;

use App\Domain\Message\Message;
use App\Domain\Message\Repository\MessageRepository;

readonly class CreateMessageService
{
    public function __construct(public MessageRepository $repository) {}

    /**
     * @psalm-param non-empty-string $text
     */
    public function create(string $text): Message
    {
        $message = new Message($text);

        $this->repository->add($message);

        return $message;
    }
}
