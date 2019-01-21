<?php

namespace Tests\Unit;

use App\Entities\BadDomain;
use App\Interfaces\BadDomain\BadDomainRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Tests\TestCase;

/**
 * Class UnitBadDomainTest
 * @package Tests\Unit
 */
class UnitBadDomainTest extends TestCase
{
    protected $badDomain;
    protected $uuidString = '14d742e4-5364-464d-81f1-47468d7d1212';
    protected $badDomainName;

    protected function setUp()
    {
        parent::setUp();

        $this->badDomain = app(BadDomainRepositoryInterface::class);
    }

    public function testBadDomainCreate()
    {
        $this->badDomainName = 'https://' . rand() . 'xxx.com/';

        // Test creating Click
        $newBadDomainEntity = $this->badDomain->create(
            $this->uuidString,
            $this->badDomainName
        );
        $this->assertInstanceOf(BadDomain::class, $newBadDomainEntity);

        $this->_removeBadDomainEntity($newBadDomainEntity);
    }

    protected function _removeBadDomainEntity(BadDomain $entity)
    {
        $em = app(EntityManager::class);
        $em->remove($entity);
        $em->flush();
    }

    protected function tearDown()
    {
        parent::tearDown();

        $this->badDomain = null;
    }
}

