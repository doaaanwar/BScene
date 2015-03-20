<?php

/* 
 * Categories.php
 * The entity for the Categories object
 * Revision History:
 *      15.03.2015: created, Victoria Betts
 */
//src/bsceneBundle/Entity/Categories.php


namespace Acme\bsceneBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Categories
{
    /**
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
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $description;
    /**
     *
     * @ORM\Column(type="integer", length=2)
     */
    protected $ranking;
    
     /**
     * @ORM\OneToOne(targetEntity="Image", inversedBy="category")
     * @ORM\JoinColumn(name="imageId", referencedColumnName="id")
     */
    protected $image;
    
    /**
     * @ORM\ManyToOne(targetEntity="MeetupCategories", inversedBy="category")
     * @ORM\JoinColumn(name="meetupCategoryId", referencedColumnName="id")
     */
    protected $meetupCategory;


    /**
     * @ORM\ManyToOne(targetEntity="EventBriteCategories", inversedBy="category")
     * @ORM\JoinColumn(name="eventBriteCategoryId", referencedColumnName="id")
     */
    protected $eventBriteCategory;
    
    /**
    * @ORM\OneToMany(targetEntity="Event", mappedBy="category")
    */
    protected $events;
    
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
     * @return Categories
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
     * @return Categories
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
     * Set meetupCategory
     *
     * @param \Acme\bsceneBundle\Entity\MeetupCategories $meetupCategory
     * @return Categories
     */
    public function setMeetupCategory(\Acme\bsceneBundle\Entity\MeetupCategories $meetupCategory = null)
    {
        $this->meetupCategory = $meetupCategory;

        return $this;
    }

    /**
     * Get meetupCategory
     *
     * @return \Acme\bsceneBundle\Entity\MeetupCategories 
     */
    public function getMeetupCategory()
    {
        return $this->meetupCategory;
    }

    /**
     * Set ranking
     *
     * @param integer $ranking
     * @return Categories
     */
    public function setRanking($ranking)
    {
        $this->ranking = $ranking;

        return $this;
    }

    /**
     * Get ranking
     *
     * @return integer 
     */
    public function getRanking()
    {
        return $this->ranking;
    }

    /**
     * Set eventBriteCategory
     *
     * @param \Acme\bsceneBundle\Entity\EventBriteCategories $eventBriteCategory
     * @return Categories
     */
    public function setEventBriteCategory(\Acme\bsceneBundle\Entity\EventBriteCategories $eventBriteCategory = null)
    {
        $this->eventBriteCategory = $eventBriteCategory;

        return $this;
    }

    /**
     * Get eventBriteCategory
     *
     * @return \Acme\bsceneBundle\Entity\EventBriteCategories 
     */
    public function getEventBriteCategory()
    {
        return $this->eventBriteCategory;
    }

    /**
     * Set image
     *
     * @param \Acme\bsceneBundle\Entity\Image $image
     * @return Categories
     */
    public function setImage(\Acme\bsceneBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Acme\bsceneBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add events
     *
     * @param \Acme\bsceneBundle\Entity\Event $events
     * @return Categories
     */
    public function addEvent(\Acme\bsceneBundle\Entity\Event $events)
    {
        $this->events[] = $events;

        return $this;
    }

    /**
     * Remove events
     *
     * @param \Acme\bsceneBundle\Entity\Event $events
     */
    public function removeEvent(\Acme\bsceneBundle\Entity\Event $events)
    {
        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }
}
