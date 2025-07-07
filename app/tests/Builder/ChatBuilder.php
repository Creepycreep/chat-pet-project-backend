<?php

declare(strict_types=1);

namespace App\Tests\Builder;

use App\Domain\Chat\Chat;
use App\Domain\Chat\Service\CreateChatService;
use Doctrine\ORM\EntityManagerInterface;

class ChatBuilder
{
    public function __construct(
        private readonly CreateChatService $createChatService,
        private readonly EntityManagerInterface $entityManager,
    ) {}

    public function build(): Chat
    {
        $user = $this->createChatService->create();

        $this->entityManager->flush();

        return $user;
    }
}
