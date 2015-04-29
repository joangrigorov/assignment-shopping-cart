<?php

namespace OrdersTest\Value;

use Common\Test\SeekAppRootTrait;
use Orders\Value\DiscountRate;
use Orders\Value\TotalPrice;
use Zend\Test\PHPUnit\Controller\AbstractControllerTestCase;

class TotalPriceTest  extends AbstractControllerTestCase
{
    use SeekAppRootTrait;

    public function setUp()
    {
        $this->setApplicationConfig(
            include $this->seekAppConfig(__DIR__)
        );
        parent::setUp();
    }

    /** @test */
    public function shouldApplyDiscount()
    {
        $discountRate = new DiscountRate(20);
        $totalPrice = new TotalPrice(1000);
        $this->assertEquals(new TotalPrice(800), $totalPrice->applyDiscount($discountRate));

        $discountRate = new DiscountRate(20);
        $totalPrice = new TotalPrice(14);
        $this->assertEquals(new TotalPrice(11.2), $totalPrice->applyDiscount($discountRate));
    }

}