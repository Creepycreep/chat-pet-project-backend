<?php

declare(strict_types=1);

namespace App\Domain\Chat;

use App\Domain\Message\Message;
use App\Domain\User\User;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
class Chat
{
    /** @psalm-suppress PossiblyUnusedProperty */
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    public DateTimeImmutable $createdAt;

    /** @psalm-suppress PossiblyUnusedProperty */
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    public Uuid $id;

    /**
     * @psalm-var Collection<int,Message> $messages
     *
     * @psalm-suppress PossiblyUnusedProperty
     */
    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'chat')]
    public Collection $messages;

    /**
     * @psalm-var Collection<int<2, max>,User> $participants
     *
     * @psalm-suppress PossiblyUnusedProperty
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'chats')]
    public Collection $participants;

    /**
     * @psalm-suppress PossiblyUnusedProperty
     */
    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->createdAt = new DateTimeImmutable();
        $this->messages = new ArrayCollection();
        $this->participants = new ArrayCollection();
    }
}
