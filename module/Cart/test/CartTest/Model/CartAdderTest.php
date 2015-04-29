<?php

namespace CartTest\Model;

use Cart\Entity\CartItem;
use Cart\Utils\CartItemAdder;
use Cart\Repository\CartItemsRepositoryInterface;
use Common\Test\SeekAppRootTrait;
use Common\Value\QuantityRequested;
use Products\Entity\Product;
use Products\Value\Price;
use Products\Value\QuantityAvailable;
use Zend\Test\PHPUnit\Controller\AbstractControllerTestCase;

class CartAdderTest extends AbstractControllerTestCase
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
    public function shouldAddProductToCart()
    {
        $product = new Product('Test product', '', '', new Price(200), new QuantityAvailable(5));

        /** @var \PHPUnit_Framework_MockObject_Builder_InvocationMocker|CartItemsRepositoryInterface $cartRepoMock */
        $cartRepoMock = $this->getMockBuilder('\Cart\Repository\CartItemsRepositoryInterface')->getMock();

        $cartItemAdder = new CartItemAdder($cartRepoMock, 'test_session_id');
        $result = $cartItemAdder->addToCart($product, new QuantityRequested(1));
        $this->assertInstanceOf('\Cart\Entity\CartItem', $result);
    }

    /** @test */
    public function secondAddedItemShouldIncreaseQuantity()
    {
        $product = new Product('Test product', '', '', new Price(200), new QuantityAvailable(5));

        /** @var \PHPUnit_Framework_MockObject_Builder_InvocationMocker|CartItemsRepositoryInterface $cartRepoMock */
        $cartRepoMock = $this->getMockBuilder('\Cart\Repository\CartItemsRepositoryInterface')->getMock();

        $cartRepoMock->method('findItemByProductAndSession')->willReturn(
            new CartItem('test_session_id', new QuantityRequested(1), $product)
        );

        $cartItemAdder = new CartItemAdder($cartRepoMock, 'test_session_id');
        $item = $cartItemAdder->addToCart($product, new QuantityRequested(1));
        $this->assertEquals(2, $item->getQuantityRequested()->getQuantity());
    }

    /** @test */
    public function increaseItemQuantity()
    {
        $product = new Product('Test product', '', '', new Price(200), new QuantityAvailable(50));

        /** @var \PHPUnit_Framework_MockObject_Builder_InvocationMocker|CartItemsRepositoryInterface $cartRepoMock */
        $cartRepoMock = $this->getMockBuilder('\Cart\Repository\CartItemsRepositoryInterface')->getMock();

        $cartRepoMock->method('findItemByProductAndSession')->willReturn(
            new CartItem('test_session_id', new QuantityRequested(2), $product)
        );

        $cartItemAdder = new CartItemAdder($cartRepoMock, 'test_session_id');
        $item = $cartItemAdder->addToCart($product, new QuantityRequested(5));
        $this->assertEquals(7, $item->getQuantityRequested()->getQuantity());
    }

}