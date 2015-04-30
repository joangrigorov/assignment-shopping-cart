<?php

namespace Orders\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

/**
 * Checkout form
 *
 * Billing information
 *
 * @package Orders\Form
 */
class Checkout extends Form
{

    /**
     * Constructor
     *
     * Initializes form elements
     *
     * @param InputFilterInterface $inputFilter
     * @param HydratorInterface $hydrator
     */
    public function __construct(InputFilterInterface $inputFilter,
                                HydratorInterface $hydrator)
    {
        parent::__construct('checkout', []);

        $this->setInputFilter($inputFilter);

        $this->add([
            'type' => 'text',
            'name' => 'firstName',
            'options' => [
                'label' => 'First name'
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'Enter your first name'
            ]
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'lastName',
            'options' => [
                'label' => 'Last name'
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'Enter your last name'
            ]
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'address',
            'options' => [
                'label' => 'Address'
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'Enter your address'
            ]
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'city',
            'options' => [
                'label' => 'City'
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'Enter your city'
            ]
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'country',
            'options' => [
                'label' => 'Country'
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'Enter your country'
            ]
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'phone',
            'options' => [
                'label' => 'Phone'
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'Enter your phone'
            ]
        ]);

        $reflection = new \ReflectionClass('\Orders\Entity\Order');

        $this->setHydrator($hydrator);
        $this->bind($reflection->newInstanceWithoutConstructor());

    }

}