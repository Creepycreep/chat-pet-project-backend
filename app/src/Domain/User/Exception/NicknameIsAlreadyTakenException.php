<?php

declare(strict_types=1);

namespace App\Domain\User\Exception;

use App\Domain\Common\Exception\ServiceException;

class NicknameIsAlreadyTakenException extends ServiceException
{
    public function getDescription(): string
    {
        return 'Nickname is already taken';
    }

    public function getType(): string
    {
        return 'nickname_is_already_taken';
    }
}
