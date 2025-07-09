<?php

declare(strict_types=1);

namespace App\Tests\Builder;

use App\Domain\User\Service\CreateUserService;
use App\Domain\User\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;

class UserBuilder
{
    /** @psalm-var non-empty-string|null $nickname */
    private ?string $nickname = null;

    public function __construct(
        private readonly CreateUserService $createUserService,
        private readonly EntityManagerInterface $entityManager,
    ) {}

    public function build(): User
    {
        $user = $this->createUserService->create(nickname: $this->nickname ?? 'user-' . Uuid::v4()->toRfc4122());

        $this->entityManager->flush();

        return $user;
    }

    /**
     * @psalm-param non-empty-string $name
     */
    public function withName(string $name): self
    {
        $this->nickname = $name;

        return $this;
    }
}
