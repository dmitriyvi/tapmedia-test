<?php

namespace App\Services\Uuid;

use App\Interfaces\Uuid\UuidGeneratorInterface;
use Webpatser\Uuid\Uuid;

/**
 * Class UuidGenerator
 * @package App\Services\Uuid
 */
class UuidGenerator implements UuidGeneratorInterface
{

    /**
     * @return Uuid
     * @throws \Exception
     */
    public function getUuid(): Uuid
    {
        return Uuid::generate(4);
    }
}
