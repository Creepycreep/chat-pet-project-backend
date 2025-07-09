<?php

declare(strict_types=1);

namespace App\Tests\Functional\Domain\Chat;

use App\Domain\Chat\Service\CreateChatService;
use App\Tests\BaseTestCase;
use App\Tests\Builder\UserBuilder;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * @internal
 */
#[CoversClass(CreateChatService::class)]
final class CreateChatServiceTest extends BaseTestCase
{
    public function testSuccess(): void
    {
        $user1 = $this->getService(UserBuilder::class)->build();
        $user2 = $this->getService(UserBuilder::class)->build();

        $chat = $this->getService(CreateChatService::class)->create([$user1, $user2]);

        $this->getService(EntityManagerInterface::class)->flush();
        $this->getService(EntityManagerInterface::class)->refresh($user1);
        $this->getService(EntityManagerInterface::class)->refresh($user2);

        self::assertTrue($chat->participants->contains($user1));
        self::assertTrue($chat->participants->contains($user2));

        self::assertTrue($user1->chats->contains($chat));
        self::assertTrue($user2->chats->contains($chat));
    }
}
