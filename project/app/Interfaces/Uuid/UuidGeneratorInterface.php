<?php
namespace App\Interfaces\Uuid;

use Webpatser\Uuid\Uuid;

interface UuidGeneratorInterface
{
    /**
     * @return Uuid
     * @throws \Exception
     */
    public function getUuid(): Uuid;
}
