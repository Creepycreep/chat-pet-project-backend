<?php

declare(strict_types=1);

namespace App\Tests\Builder;

use App\Domain\Common\Enum\RolesEnum;
use App\Domain\Common\ValueObject\Email;
use App\Domain\Office\Office;
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
        $user = $this->createUserService->create('Liza');

        $this->entityManager->flush();

        return $user;
    }
}
