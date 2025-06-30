<?php

declare(strict_types=1);

namespace App\Tests\Functional\Domain\Message;

use App\Domain\Message\Service\CreateMessageService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @internal
 */
#[CoversClass(CreateMessageService::class)]
final class CreateMessageServiceTest extends WebTestCase
{
    public function testSuccess(): void
    {
        $text = 'message';
        $message = static::getContainer()->get(CreateMessageService::class)->create($text);
        static::getContainer()->get(EntityManagerInterface::class)->flush();

        self::assertSame($text, $message->text);
    }
}
