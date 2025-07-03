<?php

declare(strict_types=1);

namespace App\Domain\User\Repository;

use App\Domain\User\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    /**
     * @psalm-suppress PossiblyUnusedParam
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @psalm-suppress PossiblyUnusedParam
     */
    public function add(User $user): void
    {
        $this->getEntityManager()->persist($user);
    }
}
