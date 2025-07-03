<?php

declare(strict_types=1);

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;
use App\Domain\User\User;

readonly class CreateUserService
{
    public function __construct(public UserRepository $repository) {}

    /**
     * @psalm-param non-empty-string $nickname
     */
    public function create(string $nickname): User
    {
        $user = new User($nickname);

        $this->repository->add($user);

        return $user;
    }
}
