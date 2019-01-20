<?php

namespace App\Repository;

use App\Entities\Click;
use App\Interfaces\Click\ClickRepositoryInterface;
use Doctrine\ORM\EntityManager;

/**
 * Class DoctrineClickRepository
 * @package App\Repository
 */
class DoctrineClickRepository implements ClickRepositoryInterface
{
    /**
     * @var EntityManager
     */
    protected $em;
    protected const CLASS_NAME = Click::class;

    /**
     * DoctrineClickRepository constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return Click[]
     */
    public function findAll(): array
    {
        return $this->em->getRepository(self::CLASS_NAME)->findAll();
    }

    /**
     * @param string $ua
     * @param string $ip
     * @param string $ref
     * @param string $param1
     * @return Click|null
     */
    public function findOneByData(string $ua, string $ip, string $ref, string $param1): ?Click
    {
        return $this->em->getRepository(self::CLASS_NAME)->findOneBy([
            'ua' => $ua,
            'ip' => $ip,
            'ref' => $ref,
            'param1' => $param1,
        ]);
    }

    /**
     * @param Click $clickEntity
     * @return mixed|void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function incrementError(Click $clickEntity): void
    {
        $clickEntity->incrementError();
        $this->em->persist($clickEntity);
        $this->em->flush();
    }

    /**
     * @param string $id
     * @param string $ua
     * @param string $ip
     * @param string $ref
     * @param string $param1
     * @param string $param2
     * @param int $bad_domain
     * @return Click
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(string $id, string $ua, string $ip, string $ref, string $param1, string $param2, int $bad_domain): Click
    {
        $clickEnity = new Click($id, $ua, $ip, $ref, $param1, $param2, $bad_domain);
        $this->em->persist($clickEnity);
        $this->em->flush();

        return $clickEnity;
    }

    /**
     * @param Click $clickEntity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function setBadDomain(Click $clickEntity): void
    {
        $clickEntity->setBadDomain();
        $this->em->persist($clickEntity);
        $this->em->flush();
    }


}
