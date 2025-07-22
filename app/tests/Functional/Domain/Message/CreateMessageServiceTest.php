<?php

declare(strict_types=1);

namespace App\Tests\Functional\Domain\Message;

use App\Domain\Message\Service\CreateMessageService;
use App\Tests\BaseTestCase;
use App\Tests\Builder\ChatBuilder;
use App\Tests\Builder\UserBuilder;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * @internal
 */
#[CoversClass(CreateMessageService::class)]
final class CreateMessageServiceTest extends BaseTestCase
{
    public function testSuccess(): void
    {
        $user = $this->getService(UserBuilder::class)->build();
        $chat = $this->getService(ChatBuilder::class)->build();
        /**
         * @psalm-var non-empty-string $text
         */
        $text = 'message';
        $message = $this->getService(CreateMessageService::class)->create(text: $text, chat: $chat, user: $user);

        $this->getService(EntityManagerInterface::class)->flush();
        $this->getService(EntityManagerInterface::class)->refresh($chat);

        self::assertSame($text, $message->text);
        self::assertTrue($message->id->equals($chat->messages[0]?->id));
    }
}
