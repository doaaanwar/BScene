<?php

/* 
 * EventBriteCategories.php
 * The entity for the EventBriteCategories object
 * Revision History:
 *      15.03.2015: created, Doaa elfayoumi
 */
//src/bsceneBundle/Entity/MeetupCategories.php


namespace Acme\bsceneBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventBriteCategories
 *
 * @ORM\Table(name="EventBriteCategories")
 * @ORM\Entity
 */
class EventBriteCategories
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
     * @ORM\OneToMany(targetEntity="Categories", mappedBy="eventBriteCategory")
     */
    protected $category;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->category = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return EventBriteCategories
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
     * @return EventBriteCategories
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
