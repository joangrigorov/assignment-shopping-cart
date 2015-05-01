<?php

namespace Orders\Controller;

use Cart\Collection\Cart;
use Orders\Entity\Order;
use Orders\Form\Checkout;
use Orders\Value\ShippingDetails;
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
     * Shows the user summary of his order.
     *
     * On post - performs checkout
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
                /** @var ShippingDetails $shippingDetails */
                $shippingDetails = $checkoutForm->getObject();
                /** @var \Orders\Utils\Checkout $checkout */
                $checkout = $this->serviceLocator->get('Orders\Utils\Checkout');
                $order = $checkout->checkout($cart, $shippingDetails, session_id());
                $this->flashMessenger()->addSuccessMessage('Items are ordered!');
                return $this->redirect()->toRoute('order/view', ['id' => $order->getId()]);
            }
        }

        return [
            'cart' => $cart,
            'checkoutForm' => $checkoutForm
        ];
    }

    /**
     * Displays all completed orders
     *
     * @return array
     */
    public function ordersAction()
    {
        /** @var \Orders\Repository\OrdersRepository $ordersRepository */
        $ordersRepository = $this->serviceLocator->get('Orders\Repository\OrdersRepository');
        return [
            'orders' => $ordersRepository->getAll()
        ];
    }

    /**
     * View order by ID
     *
     * @return array
     */
    public function viewAction()
    {
        /** @var \Orders\Repository\OrdersRepository $ordersRepository */
        $ordersRepository = $this->serviceLocator->get('Orders\Repository\OrdersRepository');
        return [
            'order' => $ordersRepository->findByID($this->params()->fromRoute('id'))
        ];
    }

}
