<?php

namespace Orders\Controller;

use Cart\Collection\Cart;
use Orders\Entity\Order;
use Orders\Form\Checkout;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Checkout controller
 *
 * Manage orders
 *
 * @package Orders\Controller
 */
class IndexController extends AbstractActionController
{

    /**
     * Step before the actual checkout.
     *
     * Shows the user summary of his order.
     */
    public function checkoutPreviewAction()
    {
        /** @var \Cart\Collection\DiscountedCartFactory $cartFactory */
        $cartFactory = $this->serviceLocator->get('Cart\Collection\DiscountedCartFactory');
        $couponCode = $this->params()->fromRoute('couponCode', false);
        $cart = $cartFactory->getCartWithDiscount(session_id(), $couponCode);

        /** @var Checkout $checkoutForm */
        $checkoutForm = $this->serviceLocator->get('Orders\Form\Checkout');

        if ($this->request->isPost()) {
            $checkoutForm->setData($this->params()->fromPost());
            if ($checkoutForm->isValid()) {
                return $this->processOrder($checkoutForm, $cart);
            }
        }

        return [
            'cart' => $cart,
            'checkoutForm' => $checkoutForm
        ];
    }

    /**
     * Process checkout
     *
     * @todo Write a utility class for this
     *
     * @param Checkout $checkoutForm
     * @param Cart $cart
     * @return \Zend\Http\Response
     */
    private function processOrder(Checkout $checkoutForm, Cart $cart)
    {
        /** @var Order $order */
        $order = $checkoutForm->getObject();
        $order->setOrderDate(new \DateTimeImmutable('now'));
        $order->setOrderItemsFromCart($cart);
        /** @var \Orders\Repository\OrdersRepository $ordersRepo */
        $ordersRepo = $this->serviceLocator->get('Orders\Repository\OrdersRepository');
        $ordersRepo->save($order);
        $this->flashMessenger()->addSuccessMessage('Items are ordered!');
        return $this->redirect()->toRoute('products');
    }

}
