<?php

namespace Orders\Value;

use Doctrine\ORM\Mapping as ORM;

/**
 * Embeddable object for shipping details
 *
 * @package Orders\Value
 * @ORM\Embeddable
 */
class ShippingDetails
{
    /**
     * First name of the customer
     *
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=45, nullable=true)
     */
    private $firstName;

    /**
     * Customer last name
     *
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=45, nullable=true)
     */
    private $lastName;

    /**
     * Customers address
     *
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=45, nullable=true)
     */
    private $address;

    /**
     * City
     *
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=45, nullable=true)
     */
    private $city;

    /**
     * Country
     *
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=45, nullable=true)
     */
    private $country;

    /**
     * Contacts phone
     *
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=45, nullable=true)
     */
    private $phone;

    /**
     * Constructor
     *
     * Sets shipping details
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $address
     * @param string $city
     * @param string $country
     * @param string $phone
     */
    public function __construct($firstName, $lastName, $address, $city, $country, $phone)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->city = $city;
        $this->country = $country;
        $this->phone = $phone;
    }

    /**
     * Getter for $firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Getter for $lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Getter for $address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Getter for $city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Getter for $country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Getter for $phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

}