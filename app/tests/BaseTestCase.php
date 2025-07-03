<?php

declare(strict_types=1);

namespace App\Tests;

use App\Domain\User\Service\CreateUserService;
use PHPUnit\Framework\Attributes\CoversClass;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * @internal
 */
#[CoversClass(CreateUserService::class)]
abstract class BaseTestCase extends WebTestCase
{
    /**
     * @template TService of object
     *
     * @psalm-param class-string<TService> $id
     *
     * @psalm-return TService
     *
     * @throws ServiceNotFoundException
     */
    public function getService(string $id): object
    {
        /** @psalm-var object|null $service */
        $service = static::getContainer()->get($id);

        if (null === $service) {
            throw new ServiceNotFoundException($id);
        }

        if (!$service instanceof $id) {
            throw new RuntimeException();
        }

        return $service;
    }
}
