<?php

namespace Products\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\HydratorInterface;

/**
 * Form for creating/editing products
 *
 * @package Products\Form
 */
class Product extends Form
{

    /**
     * Constructor
     *
     * Creates form elements
     * @param InputFilter $inputFilter
     * @param HydratorInterface $hydrator
     */
    public function __construct(InputFilter $inputFilter, HydratorInterface $hydrator)
    {
        $this->setInputFilter($inputFilter);

        parent::__construct('product', []);

        $this->add([
            'type' => 'text',
            'name' => 'name',
            'options' => [
                'label' => 'Name'
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'Enter product name'
            ]
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'price',
            'options' => [
                'label' => 'Price'
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'Enter product price'
            ]
        ]);

        $this->add([
            'type' => 'textarea',
            'name' => 'shortDescription',
            'options' => [
                'label' => 'Short Description'
            ],
            'attributes' => [
                'class' => 'form-control',
                'rows' => 5,
                'cols' => 10,
                'placeholder' => 'Enter short description'
            ]
        ]);

        $this->add([
            'type' => 'textarea',
            'name' => 'fullDescription',
            'options' => [
                'label' => 'Full Description'
            ],
            'attributes' => [
                'class' => 'form-control',
                'rows' => 10,
                'cols' => 10,
                'placeholder' => 'Enter full description'
            ]
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'quantityAvailable',
            'options' => [
                'label' => 'Quantity available'
            ],
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);

        $reflection = new \ReflectionClass('\Products\Entity\Product');

        $this->setHydrator($hydrator);
        $this->bind($reflection->newInstanceWithoutConstructor());
    }

}