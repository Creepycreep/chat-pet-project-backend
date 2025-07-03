<?php

declare(strict_types=1);

namespace App\Domain\User;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
#[ORM\Table(name: '`user`')]
class User
{
    /** @psalm-suppress PossiblyUnusedProperty */
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    public DateTimeImmutable $createdAt;

    /** @psalm-suppress PossiblyUnusedProperty */
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    public Uuid $id;

    /**
     * @psalm-var non-empty-string $nickname
     *
     * @psalm-suppress PossiblyUnusedProperty
     */
    #[ORM\Column(type: Types::STRING, length: 255)]
    public string $nickname;

    //    /**
    //     * @psalm-var Collection<int,Message> $messages
    //     *
    //     * @psalm-suppress PossiblyUnusedProperty
    //     */
    //    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'user')]
    //    public Collection $messages;

    /**
     * @psalm-param non-empty-string $nickname
     *
     * @psalm-suppress PossiblyUnusedProperty
     */
    public function __construct(string $nickname)
    {
        $this->id = Uuid::v4();
        $this->createdAt = new DateTimeImmutable();

        $this->nickname = $nickname;
    }
}
