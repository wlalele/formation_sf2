<?php

namespace Wlalele\Bundle\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Wlalele\Bundle\CatalogBundle\Entity\CategoryRepository")
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var array<product>
     *
     * @ORM\OneToMany(targetEntity="Wlalele\Bundle\CatalogBundle\Entity\Product", mappedBy="category")
     */
    private $products;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add products
     *
     * @param \Wlalele\Bundle\CatalogBundle\Entity\Product $products
     * @return Category
     */
    public function addProduct(\Wlalele\Bundle\CatalogBundle\Entity\Product $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \Wlalele\Bundle\CatalogBundle\Entity\Product $products
     */
    public function removeProduct(\Wlalele\Bundle\CatalogBundle\Entity\Product $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * toString method
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
