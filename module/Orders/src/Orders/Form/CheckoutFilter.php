<?php

namespace Orders\Form;

use Zend\InputFilter\InputFilter;

/**
 * Input filter for the checkout form
 *
 * @package Orders\Form
 */
class CheckoutFilter extends InputFilter
{

    public function __construct()
    {
        $this->add([
            'name' => 'firstName',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
            ]
        ]);

        $this->add([
            'name' => 'lastName',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
            ]
        ]);

        $this->add([
            'name' => 'address',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
            ]
        ]);
        $this->add([
            'name' => 'city',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
            ]
        ]);

        $this->add([
            'name' => 'country',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
            ]
        ]);

        $this->add([
            'name' => 'phone',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
            ]
        ]);
    }

}