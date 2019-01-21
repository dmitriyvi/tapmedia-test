<?php

namespace App\Repository;

use App\Entities\BadDomain;
use App\Interfaces\BadDomain\BadDomainRepositoryInterface;
use Doctrine\ORM\EntityManager;

/**
 * Class DoctrineBadDomainRepository
 * @package App\Repository
 */
class DoctrineBadDomainRepository implements BadDomainRepositoryInterface
{
    /**
     * @var EntityManager
     */
    protected $em;
    protected const CLASS_NAME = BadDomain::class;

    /**
     * DoctrineClickRepository constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param string $name
     * @return BadDomain|null
     */
    public function findByName(string $name): ?BadDomain
    {
        return $this->em->getRepository(self::CLASS_NAME)->findOneBy([
            'name' => $name
        ]);
    }

    /**
     * @param string $id
     * @param string $name
     * @return BadDomain
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(string $id, string $name): BadDomain
    {
        $badDomain = new BadDomain($id, $name);
        $this->em->persist($badDomain);
        $this->em->flush();

        return $badDomain;
    }
}
