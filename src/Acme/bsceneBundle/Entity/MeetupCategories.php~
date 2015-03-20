<?php

/* 
 * MeetupCategories.php
 * The entity for the MeetupCategories object
 * Revision History:
 *      15.03.2015: created, Victoria Betts
 */
//src/bsceneBundle/Entity/MeetupCategories.php


namespace Acme\bsceneBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MeetupCategories
 *
 * @ORM\Table(name="MeetupCategories")
 * @ORM\Entity
 */
class MeetupCategories
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $name;
    
    /**
     * @ORM\OneToMany(targetEntity="Categories", mappedBy="meetupCategory")
     */
    protected $category;


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
     * Constructor
     */
    public function __construct()
    {
        $this->category = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     * @return MeetupCategories
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
     * Add category
     *
     * @param \Acme\bsceneBundle\Entity\Categories $category
     * @return MeetupCategories
     */
    public function addCategory(\Acme\bsceneBundle\Entity\Categories $category)
    {
        $this->category[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Acme\bsceneBundle\Entity\Categories $category
     */
    public function removeCategory(\Acme\bsceneBundle\Entity\Categories $category)
    {
        $this->category->removeElement($category);
    }

    /**
     * Get category
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
