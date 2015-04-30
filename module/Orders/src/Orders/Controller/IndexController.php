<?php

namespace Orders\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{

    /**
     * Step before the actual checkout.
     *
     * Shows the user summary of his order.
     */
    public function checkoutPreviewAction()
    {
        /** @var \Cart\Repository\CartItemsRepositoryInterface $cartItemsRepository */
        $cartItemsRepository = $this->serviceLocator->get('Cart\Repository\CartItemsRepository');
        $cart = $cartItemsRepository->getItemsBySession(session_id());

        $couponCode = $this->params()->fromRoute('couponCode', false);

        if ($couponCode !== false) {
            /** @var \Orders\Repository\DiscountCouponsRepository $discountCouponsRepository */
            $discountCouponsRepository = $this->serviceLocator->get('Orders\Repository\DiscountCouponsRepository');
            $coupon = $discountCouponsRepository->findByCode($couponCode);
            if (null !== $coupon) {
                $cart->setDiscountCoupon($coupon);
            }
        }

        return [
            'cart' => $cart,
            'checkoutForm' => $this->serviceLocator->get('Orders\Form\Checkout')
        ];
    }
}
