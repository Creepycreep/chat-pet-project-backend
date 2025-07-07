<?php

declare(strict_types=1);

namespace App\Domain\Message\Repository;

use App\Domain\Message\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Message>
 */
class MessageRepository extends ServiceEntityRepository
{
    /**
     * @psalm-suppress PossiblyUnusedParam
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    /**
     * @psalm-suppress PossiblyUnusedParam
     */
    public function add(Message $message): void
    {
        $this->getEntityManager()->persist($message);
    }
}
