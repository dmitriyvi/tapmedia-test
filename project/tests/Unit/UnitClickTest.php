<?php

namespace Tests\Unit;

use App\Entities\Click;
use App\Interfaces\Click\ClickRepositoryInterface;
use Tests\TestCase;

/**
 * Class UnitClickTest
 * @package Tests\Unit
 */
class UnitClickTest extends TestCase
{
    protected $clickRepository;
    protected $uuidString = '14d742e4-5364-464d-81f1-47468d7d1212';
    protected $userAgent = 'userAgent';
    protected $ip = '127.0.0.1';
    protected $referer = 'https://91919191919xxx.com/';
    protected $param1 = '100';
    protected $param2 = '100';
    protected $badDomain = 0;

    protected function setUp()
    {
        parent::setUp();

        $this->clickRepository = app(ClickRepositoryInterface::class);
    }

    public function testCreateClick()
    {
        // Test creating Click
        $newClickEntity = $this->clickRepository->create(
            $this->uuidString,
            $this->userAgent,
            $this->ip,
            $this->referer,
            $this->param1,
            $this->param2,
            $this->badDomain
        );
        $this->assertInstanceOf(Click::class, $newClickEntity);
    }

    public function testFindAllClick()
    {
        // Test findAll Click
        $clickEntitiesAll = $this->clickRepository->findAll();
        $this->assertIsArray($clickEntitiesAll);
        $this->assertContainsOnlyInstancesOf(Click::class, $clickEntitiesAll);
    }

    public function testFindByOneClick()
    {
        // Test findOneByData Click
        $clickEntityExist = $this->clickRepository->findOneByData(
            $this->userAgent,
            $this->ip,
            $this->referer,
            $this->param1
        );
        $this->assertInstanceOf(Click::class, $clickEntityExist);
    }

    public function testFindByOneWithWrongDataClick()
    {
        // Test findOneByData with wrong data
        $param1Wrong = 9999;
        $clickEntityNotExist = $this->clickRepository->findOneByData(
            $this->userAgent,
            $this->ip,
            $this->referer,
            $param1Wrong
        );
        $this->assertNull($clickEntityNotExist);
    }

    public function testIncrementErrorClick()
    {
        $clickEntityExist = $this->clickRepository->findOneByData(
            $this->userAgent,
            $this->ip,
            $this->referer,
            $this->param1
        );

        // Test incrementError Click
        $oldErrorFieldValue = $clickEntityExist->getError();
        $this->clickRepository->incrementError($clickEntityExist);
        $newErrorFieldValue = $clickEntityExist->getError();

        $this->assertNotEquals($oldErrorFieldValue, $newErrorFieldValue);
    }

    public function testSetBadDomainClick()
    {
        $clickEntityExist = $this->clickRepository->findOneByData(
            $this->userAgent,
            $this->ip,
            $this->referer,
            $this->param1
        );

        // Test setBadDomain Click
        $oldBadDomainFieldValue = $clickEntityExist->getBadDomain();
        $this->clickRepository->setBadDomain($clickEntityExist);
        $newBadDomainFieldValue = $clickEntityExist->getBadDomain();

        if ($oldBadDomainFieldValue == 0) {
            $this->assertNotEquals($oldBadDomainFieldValue, $newBadDomainFieldValue);
        } else {
            $this->assertEquals($oldBadDomainFieldValue, $newBadDomainFieldValue);
        }

        $this->_removeClickEntity($clickEntityExist);
    }

    protected function _removeClickEntity(Click $clickEntity)
    {
        $this->clickRepository->remove($clickEntity);
    }

    protected function tearDown()
    {
        parent::tearDown();

        $this->clickRepository = null;
    }
}

