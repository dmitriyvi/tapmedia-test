<?php
namespace App\Interfaces\BadDomain;

use App\Entities\BadDomain;

/**
 * Interface BadDomainRepositoryInterface
 * @package App\Interfaces\BadDomain
 */
interface BadDomainRepositoryInterface
{
    /**
     * @param string $name
     * @return BadDomain|null
     */
    public function findByName(string $name): ?BadDomain;

    /**
     * @param string $id
     * @param string $name
     * @return BadDomain
     */
    public function create(string $id, string $name): BadDomain;
}
