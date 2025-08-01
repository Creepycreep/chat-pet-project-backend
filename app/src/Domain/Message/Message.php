<?php

declare(strict_types=1);

namespace App\Domain\Message;

use App\Domain\Chat\Chat;
use App\Domain\User\User;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
class Message
{
    /** @psalm-suppress PossiblyUnusedProperty */
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'messages')]
    public User $author;

    /** @psalm-suppress PossiblyUnusedProperty */
    #[ORM\ManyToOne(targetEntity: Chat::class, inversedBy: 'messages')]
    public Chat $chat;

    /** @psalm-suppress PossiblyUnusedProperty */
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    public DateTimeImmutable $createdAt;

    /** @psalm-suppress PossiblyUnusedProperty */
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    public Uuid $id;

    /**
     * @psalm-var non-empty-string $text
     *
     * @psalm-suppress PossiblyUnusedProperty
     */
    #[ORM\Column(type: Types::TEXT)]
    public string $text;

    /**
     * @psalm-param non-empty-string $text
     *
     * @psalm-suppress PossiblyUnusedProperty
     */
    public function __construct(string $text, Chat $chat, User $author)
    {
        $this->id = Uuid::v4();
        $this->createdAt = new DateTimeImmutable();

        $this->chat = $chat;
        $this->author = $author;
        $this->text = $text;
    }
}
