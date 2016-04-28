<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
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
     * @var Product[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="categories", fetch="EXTRA_LAZY")
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
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
     * @param Product $category
     * @return $this
     */
    public function addProduct(Product $category)
    {
        if (!$this->products->contains($category)) {
            $this->products->add($category);
            $category->addCategory($this);
        }

        return $this;
    }

    /**
     * @param Product $category
     * @return $this
     */
    public function removeProduct(Product $category)
    {
        if ($this->products->contains($category)) {
            $this->products->removeElement($category);
            $category->removeCategory($this);
        }

        return $this;
    }

    /**
     * @return Product[]|ArrayCollection
     */
    public function getCategories()
    {
        return $this->products;
    }
}

