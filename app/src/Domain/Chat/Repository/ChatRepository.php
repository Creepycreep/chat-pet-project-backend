<?php

declare(strict_types=1);

namespace App\Domain\Chat\Repository;

use App\Domain\Chat\Chat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Chat>
 */
class ChatRepository extends ServiceEntityRepository
{
    /**
     * @psalm-suppress PossiblyUnusedParam
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chat::class);
    }

    /**
     * @psalm-suppress PossiblyUnusedParam
     */
    public function add(Chat $chat): void
    {
        $this->getEntityManager()->persist($chat);
    }
}
