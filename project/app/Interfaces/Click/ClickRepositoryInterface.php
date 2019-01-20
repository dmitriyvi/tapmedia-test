<?php

namespace App\Interfaces\Click;

use App\Entities\Click;

/**
 * Interface ClickRepositoryInterface
 * @package App\Interfaces
 */
interface ClickRepositoryInterface
{
    /**
     * @return Click[]
     */
    public function findAll(): array;

    /**
     * @param string $ua
     * @param string $ip
     * @param string $ref
     * @param string $param1
     * @return Click|null
     */
    public function findOneByData(string $ua, string $ip, string $ref, string $param1): ?Click;

    /**
     * @param Click $clickEntity
     */
    public function incrementError(Click $clickEntity): void;

    /**
     * @param string $id
     * @param string $ua
     * @param string $ip
     * @param string $ref
     * @param string $param1
     * @param string $param2
     * @param int $bad_domain
     * @return Click
     */
    public function create(string $id, string $ua, string $ip, string $ref, string $param1, string $param2, int $bad_domain): Click;

    /**
     * @param Click $clickEntity
     */
    public function setBadDomain(Click $clickEntity): void;
}
