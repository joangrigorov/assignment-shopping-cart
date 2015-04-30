<?php

namespace Orders\Repository;

use Doctrine\ORM\EntityRepository;
use Orders\Entity\DiscountCoupon;

/**
 * Repository for discount codes
 *
 * @package Orders\Repository
 */
class DiscountCouponsRepository extends EntityRepository
{

    /**
     * Finds discount coupon by its code
     *
     * @param string $code
     * @return null|DiscountCoupon
     */
    public function findByCode($code)
    {
        return $this->findOneBy(['code' => $code]);
    }

}