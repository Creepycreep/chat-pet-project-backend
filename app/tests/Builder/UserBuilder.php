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
    private ?Email $email = null;

    /** @psalm-var non-empty-string|null $name */
    private ?string $name = null;

    /** @psalm-var array<int, Office> */
    private array $offices = [];

    /** @psalm-var non-empty-string|null $password */
    private ?string $password = null;

    private RolesEnum $role = RolesEnum::USER;

    public function __construct(
        private readonly CreateUserService $createUserService,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function asAdmin(): self
    {
        $this->role = RolesEnum::ADMIN;

        return $this;
    }

    public function build(): User
    {
        $user = $this->createUserService->create(
            name: $this->name ?? 'Иванов Иван',
            email: $this->email ?? Email::tryCreateFromString(Uuid::v4()->toRfc4122() . '@example.com'),
            plainPassword: $this->password ?? '12345678',
            offices: $this->offices,
            role: $this->role,
        );

        $this->entityManager->flush();

        return $user;
    }

    public function withEmail(Email $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @psalm-param non-empty-string $name
     */
    public function withName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @psalm-param array<int, Office> $offices
     */
    public function withOffices(array $offices): self
    {
        $this->offices = $offices;

        return $this;
    }

    /**
     * @psalm-param non-empty-string $password
     */
    public function withPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
