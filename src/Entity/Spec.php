<?php



namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 */
class Spec
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * к какой модели относятся спек
     * @ORM\ManyToOne(targetEntity="Weapon")
     * @ORM\JoinColumn(name="weaponId",referencedColumnName="id", nullable=false)
     */
    protected $weapon;

    /**
     * @ORM\Column(type="integer")
     */
    protected $rpm;

    /**
     * @ORM\Column(type="float")
     */
    protected $weight;

    /**
     * @ORM\Column(type="float")
     */
    protected $length;

    public function getId()
    {
        return $this->id;
    }

    public function getWeapon()
    {
        return $this->weapon;
    }

    public function setWeapon(Weapon $weapon)
    {
        $this->weapon = $weapon;

        return $this;
    }

    public function getRpm()
    {
        return $this->rpm;
    }

    public function setRpm($rpm)
    {
        $this->rpm = $rpm;

        return $this;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }
}