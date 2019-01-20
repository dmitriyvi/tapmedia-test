<?php

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="click")
 */
class Click
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $ua;

    /**
     * @ORM\Column(type="string")
     */
    protected $ip;

    /**
     * @ORM\Column(type="string")
     */
    protected $ref;

    /**
     * @ORM\Column(type="string")
     */
    protected $param1;

    /**
     * @ORM\Column(type="string")
     */
    protected $param2;


    /**
     * @ORM\Column(type="integer")
     */
    protected $error;

    /**
     * @ORM\Column(type="integer")
     */
    protected $bad_domain;

    /**
     * Click constructor.
     * @param $id
     * @param $ua
     * @param $ip
     * @param $ref
     * @param $param1
     * @param $param2
     * @param $bad_domain
     */
    public function __construct(string $id, string $ua, string $ip, string $ref, string $param1, string $param2, int $bad_domain)
    {
        $this->id = $id;
        $this->ua = $ua;
        $this->ip = $ip;
        $this->ref = $ref;
        $this->param1 = $param1;
        $this->param2 = $param2;
        $this->error = 0;
        $this->bad_domain = $bad_domain;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUa(): string
    {
        return $this->ua;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @return string
     */
    public function getRef(): string
    {
        return $this->ref;
    }

    /**
     * @return string
     */
    public function getParam1(): string
    {
        return $this->param1;
    }

    /**
     * @return string
     */
    public function getParam2(): string
    {
        return $this->param2;
    }

    /**
     * @return int
     */
    public function getError(): int
    {
        return $this->error;
    }

    /**
     * @return int
     */
    public function getBadDomain(): int
    {
        return $this->bad_domain;
    }

    public function incrementError(): void
    {
        ++$this->error;
    }

    public function setBadDomain(): void
    {
        $this->bad_domain = 1;
    }
}
