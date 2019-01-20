<?php

namespace Tests\Unit;

use App\Entities\Click;
use App\Interfaces\Click\ClickRepositoryInterface;
use App\Interfaces\Uuid\UuidGeneratorInterface;
use App\Services\Uuid\UuidGenerator;
use Tests\TestCase;

/**
 * Class ExampleTest
 * @package Tests\Unit
 */
class ExampleTest extends TestCase
{
    public function testClick()
    {
        $uuidGenerator = app(UuidGeneratorInterface::class);
        $clickRepository = app(ClickRepositoryInterface::class);

        $this->assertIsObject($uuidGenerator);

        $uuid = $uuidGenerator->getUuid();

        $this->assertObjectHasAttribute('string',$uuid);
        $this->assertIsString($uuid->string);

        $this->assertIsObject($clickRepository);

        $uuidString = $uuid->string;
        $userAgent = 'userAgent';
        $ip = '127.0.0.1';
        $referer = '127.0.0.2';
        $param1 = '100';
        $param2 = '100';
        $badDomain = 0;


        // Test creating Click
        $newClickEnity = $clickRepository->create(
            $uuidString,
            $userAgent,
            $ip,
            $referer,
            $param1,
            $param2,
            $badDomain
        );

        $this->assertInstanceOf(Click::class, $newClickEnity);

        // Test findAll Click
        $clickEntitiesAll = $clickRepository->findAll();

        $this->assertIsArray($clickEntitiesAll);

        // Test findOneByData Click
        $clickEntityExist = $clickRepository->findOneByData(
            $userAgent,
            $ip,
            $referer,
            $param1
        );
        $this->assertInstanceOf(Click::class, $clickEntityExist);

        // Test findOneByData with wrong data
        $param1Wrong = 9999;
        $clickEntityNotExist = $clickRepository->findOneByData(
            $userAgent,
            $ip,
            $referer,
            $param1Wrong
        );
        $this->assertNull($clickEntityNotExist);

        // Test incrementError Click
        $oldErrorFieldValue = $clickEntityExist->getError();
        $clickRepository->incrementError($clickEntityExist);
        $newErrorFieldValue = $clickEntityExist->getError();

        $this->assertNotEquals($oldErrorFieldValue,$newErrorFieldValue);

        // Test setBadDomain Click
        $oldBadDomainFieldValue = $clickEntityExist->getBadDomain();
        $clickRepository->setBadDomain($clickEntityExist);
        $newBadDomainFieldValue = $clickEntityExist->getBadDomain();

        $this->assertNotEquals($oldBadDomainFieldValue,$newBadDomainFieldValue);
    }
}
