<?php

namespace Wlalele\Bundle\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Wlalele\Bundle\CatalogBundle\Entity\ProductRepository")
 */
class Product
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
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var array<article>
     *
     * @ORM\OneToMany(targetEntity="Wlalele\Bundle\CatalogBundle\Entity\Article", mappedBy="product")
     */
    private $articles;

    /**
     * @var category
     *
     * @ORM\ManyToOne(targetEntity="Wlalele\Bundle\CatalogBundle\Entity\Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var Document
     *
     * @ORM\OneToOne(targetEntity="Wlalele\Bundle\CatalogBundle\Entity\Document", cascade={"persist"})
     * @ORM\JoinColumn(name="document_id", referencedColumnName="id")
     */
    private $document;

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
     * @return Product
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
     * Set description
     *
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set articles
     *
     * @param \Wlalele\Bundle\CatalogBundle\Entity\article $articles
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;
    }

    /**
     * Get articles
     *
     * @return \Wlalele\Bundle\CatalogBundle\Entity\article
     */
    public function getArticles()
    {
        return $this->articles;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add articles
     *
     * @param \Wlalele\Bundle\CatalogBundle\Entity\Article $articles
     * @return Product
     */
    public function addArticle(\Wlalele\Bundle\CatalogBundle\Entity\Article $articles)
    {
        $this->articles[] = $articles;

        return $this;
    }

    /**
     * Remove articles
     *
     * @param \Wlalele\Bundle\CatalogBundle\Entity\Article $articles
     */
    public function removeArticle(\Wlalele\Bundle\CatalogBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Set category
     *
     * @param \Wlalele\Bundle\CatalogBundle\Entity\Category $category
     * @return Product
     */
    public function setCategory(\Wlalele\Bundle\CatalogBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Wlalele\Bundle\CatalogBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * toString method
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Set document
     *
     * @param \Wlalele\Bundle\CatalogBundle\Entity\Document $document
     * @return Product
     */
    public function setDocument(\Wlalele\Bundle\CatalogBundle\Entity\Document $document = null)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get document
     *
     * @return \Wlalele\Bundle\CatalogBundle\Entity\Document 
     */
    public function getDocument()
    {
        return $this->document;
    }
}
