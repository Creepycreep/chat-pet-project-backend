<?php

declare(strict_types=1);

namespace App\Tests\Builder;

use App\Domain\User\Service\CreateUserService;
use App\Domain\User\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;

class UserBuilder
{
    public function __construct(
        private readonly CreateUserService $createUserService,
        private readonly EntityManagerInterface $entityManager,
    ) {}

    public function build(): User
    {
        $name = 'user-' . Uuid::v4()->toRfc4122();
        $user = $this->createUserService->create($name);

        $this->entityManager->flush();

        return $user;
    }
}
