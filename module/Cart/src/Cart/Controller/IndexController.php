<?php

namespace Cart\Controller;

use Common\Value\QuantityRequested;
use Products\Controller\ProductNotFoundException;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Main cart controller
 *
 * @package Cart\Controller
 */
class IndexController extends AbstractActionController
{

    /**
     * Displays all cart items for the current user
     *
     * @return array
     */
    public function indexAction()
    {
        /** @var \Cart\Repository\CartItemsRepositoryInterface $cartItemsRepository */
        $cartItemsRepository = $this->serviceLocator->get('Cart\Repository\CartItemsRepository');
        return [
            'items' => $cartItemsRepository->getItemsBySession(session_id()),
            'couponCode' => $this->params()->fromRoute('couponCode')
        ];
    }

    /**
     * Adds item to cart
     *
     * Uses CartItemAdder.
     * If the item has already been added it will increase its quantity
     *
     * @throws ProductNotFoundException
     * @return \Zend\Http\Response
     */
    public function addAction()
    {
        /** @var \Products\Repository\ProductsRepository $productsRepository */
        $productsRepository = $this->serviceLocator->get('Products\Repository\ProductsRepository');
        $product = $productsRepository->findProductById($this->params()->fromPost('product'));

        if (is_null($product)) {
            throw new ProductNotFoundException('Product with that ID cannot be found');
        }

        $quantityRequested = new QuantityRequested($this->params()->fromPost('quantity'));

        /** @var \Cart\Utils\CartItemAdder $cartItemAdder */
        $cartItemAdder = $this->serviceLocator->get('Cart\Utils\CartItemAdder');
        $cartItemAdder->addToCart($product, $quantityRequested);

        $this->flashMessenger()->addSuccessMessage('Item added to cart!');
        return $this->redirect()->toRoute('cart');
    }

    /**
     * Action used to update item quantities
     *
     * @return \Zend\Http\Response
     */
    public function updateAction()
    {
        /** @var \Cart\Utils\QuantityUpdater $quantityUpdater */
        $quantityUpdater = $this->serviceLocator->get('Cart\Utils\QuantityUpdater');
        $quantityUpdater->updateQuantities($this->params()->fromPost('quantity'), session_id());

        $couponCode = $this->params()->fromPost('couponCode', false);
        if (!empty($couponCode)) {
            $forwardParams = [
                'couponCode' => $this->params()->fromPost('couponCode')
            ];
        } else {
            $forwardParams = [];
        }

        if ((boolean) $this->params()->fromPost('goToCheckoutPreview', false)) {
            return $this->redirect()->toRoute('checkout/preview', $forwardParams);
        }

        $this->flashMessenger()->addSuccessMessage('Cart has been updated!');
        return $this->redirect()->toRoute('cart', $forwardParams);
    }

}