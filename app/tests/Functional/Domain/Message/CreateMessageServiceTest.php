<?php

declare(strict_types=1);

namespace App\Tests\Functional\Domain\Message;

use App\Domain\Message\Service\CreateMessageService;
use App\Tests\BaseTestCase;
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
        /**
         * @psalm-var non-empty-string $text
         */
        $text = 'message';
        $message = $this->getService(CreateMessageService::class)->create($text);
        $this->getService(EntityManagerInterface::class)->flush();

        self::assertSame($text, $message->text);
    }
}
