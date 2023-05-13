<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 */
class Weapon
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * к какому бренду принадлежит модель
     * @ORM\ManyToOne(targetEntity="Brand")
     * @ORM\JoinColumn(name="brandId",referencedColumnName="id", nullable=false)
     */
    protected $brand;

    /**
     * к какой категории принадлежит модель
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="categoryId",referencedColumnName="id", nullable=false)
     */
    protected $category;


    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function setBrand(Brand $brand)
    {
        $this->brand = $brand;

        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }

    public function getDescr()
    {
        return $this->description;
    }

    public function setDescr($descr)
    {
        $this->description = $descr;

        return $this;
    }
    public function getImages()
    {
        $images = [];
        $pathForImages = '../public/image/weapon/' . $this->getName();
        $imageNames = scandir($pathForImages);
//        var_dump($imageNames);die();
        unset($imageNames[0]);
        unset($imageNames[1]);
        if ($imageNames) {
            foreach ($imageNames as $imageName) {
                $imagePath = '/image/weapon/' . $this->getName() . '/' . $imageName;
                $images[] = $imagePath;
            }
        }
         return $images;
    }

    public function getImage() {
        $images = $this->getImages();
        if ($images) {
            return $images[0];
        }
        return '';
    }
}
