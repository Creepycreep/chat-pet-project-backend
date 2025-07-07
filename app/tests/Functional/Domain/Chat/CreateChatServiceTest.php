<?php

declare(strict_types=1);

namespace App\Tests\Functional\Domain\User;

use App\Domain\User\Service\CreateUserService;
use App\Tests\BaseTestCase;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * @internal
 */
#[CoversClass(CreateUserService::class)]
final class CreateUserServiceTest extends BaseTestCase
{
    public function testSuccess(): void
    {
        /**
         * @psalm-var non-empty-string $nickname
         */
        $nickname = 'Liza';
        $user = $this->getService(CreateUserService::class)->create($nickname);
        $this->getService(EntityManagerInterface::class)->flush();

        self::assertSame($nickname, $user->nickname);
    }
}
