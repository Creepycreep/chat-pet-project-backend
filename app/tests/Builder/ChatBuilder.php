<?php

declare(strict_types=1);

namespace App\Tests\Builder;

use App\Domain\Chat\Chat;
use App\Domain\Chat\Service\CreateChatService;
use App\Domain\User\User;
use Doctrine\ORM\EntityManagerInterface;

class ChatBuilder
{
    private ?User $user = null;

    public function __construct(
        private readonly CreateChatService $createChatService,
        private readonly UserBuilder $userBuilder,
        private readonly EntityManagerInterface $entityManager,
    ) {}

    public function build(): Chat
    {
        $chat = $this->createChatService->create([$this->user ?? $this->userBuilder->build()]);

        $this->entityManager->flush();

        return $chat;
    }

    //    public function withUser(User $user): self
    //    {
    //        $this->user = $user;
    //
    //        return $this;
    //    }
}
