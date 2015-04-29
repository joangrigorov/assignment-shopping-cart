<?php

namespace Products\Entity;

use Doctrine\ORM\Mapping as ORM;
use Products\Value\Price;
use Products\Value\QuantityAvailable;

/**
 * Product
 *
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="\Products\Repository\ProductsRepository")
 */
class Product
{

    /**
     * Unique sequence identifier
     *
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Product name
     *
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * Product short description
     *
     * @var string
     *
     * @ORM\Column(name="shortDescription", type="string", length=225, nullable=true)
     */
    private $shortDescription;

    /**
     * Product full description
     *
     * @var string
     *
     * @ORM\Column(name="fullDescription", type="text", length=65535, nullable=true)
     */
    private $fullDescription;

    /**
     * Product price value object
     *
     * @var Price
     *
     * @ORM\Embedded(class="\Products\Value\Price", columnPrefix = false)
     */
    private $price;

    /**
     * Product photo
     *
     * @todo Maybe use value object here. Helpful for paths, deletion, etc.
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=45, nullable=true)
     */
    private $photo;

    /**
     * Quantity available of this product
     *
     * @var \Products\Value\QuantityAvailable
     *
     * @ORM\Embedded(class="\Products\Value\QuantityAvailable", columnPrefix = false)
     */
    private $quantityAvailable;

    /**
     * Constructor
     *
     * Sets product details
     *
     * @param string $name
     * @param string $shortDescription
     * @param string $fullDescription
     * @param Price $price
     * @param QuantityAvailable $quantityAvailable
     */
    public function __construct($name, $shortDescription, $fullDescription,
                         Price $price, QuantityAvailable $quantityAvailable = null)
    {
        $this->name = $name;
        $this->shortDescription = $shortDescription;
        $this->fullDescription = $fullDescription;
        $this->price = $price;

        // default product quantity is 1
        if (null === $quantityAvailable) {
            $quantityAvailable = new QuantityAvailable(1);
        }

        $this->quantityAvailable = $quantityAvailable;
    }


    /**
     * Getter for $id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter for $id
     *
     * @param int $id
     * @return Product Provides fluent interface
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Getter for $name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Setter for $name
     *
     * @param string $name
     * @return Product Provides fluent interface
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Getter for $shortDescription
     *
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Setter for $shortDescription
     *
     * @param string $shortDescription
     * @return Product Provides fluent interface
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
        return $this;
    }

    /**
     * Getter for $fullDescription
     *
     * @return string
     */
    public function getFullDescription()
    {
        return $this->fullDescription;
    }

    /**
     * Setter for $fullDescription
     *
     * @param string $fullDescription
     * @return Product Provides fluent interface
     */
    public function setFullDescription($fullDescription)
    {
        $this->fullDescription = $fullDescription;
        return $this;
    }

    /**
     * Getter for $price
     *
     * @return Price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Setter for $price
     *
     * @param Price $price
     * @return Product Provides fluent interface
     */
    public function setPrice(Price $price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Getter for $photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Setter for $photo
     *
     * @param string $photo
     * @return Product Provides fluent interface
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * Getter for $quantityAvailable
     *
     * @return \Products\Value\QuantityAvailable
     */
    public function getQuantityAvailable()
    {
        return $this->quantityAvailable;
    }

    /**
     * Setter for $quantityAvailable
     *
     * @param \Products\Value\QuantityAvailable $quantityAvailable
     * @return Product Provides fluent interface
     */
    public function setQuantityAvailable(QuantityAvailable $quantityAvailable)
    {
        $this->quantityAvailable = $quantityAvailable;
        return $this;
    }

}

