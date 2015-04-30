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
                /** @var Order $order */
                $order = $checkoutForm->getObject();
                /** @var \Orders\Utils\Checkout $checkout */
                $checkout = $this->serviceLocator->get('Orders\Utils\Checkout');
                $checkout->checkout($cart, $order, session_id());
                $this->flashMessenger()->addSuccessMessage('Items are ordered!');
                return $this->redirect()->toRoute('products');
            }
        }

        return [
            'cart' => $cart,
            'checkoutForm' => $checkoutForm
        ];
    }

}
