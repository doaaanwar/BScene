<?php

/* 
 * Event.php
 * The entity for the Event object
 * Revision History:
 *      16.03.2015: created, Mahmoud Jallala
 */
//src/bsceneBundle/Entity/Event.php

namespace Acme\bsceneBundle\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Event")
 */
class Event
{
     /**
     * @ORM\Column(type="integer", length=5, unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $title;
    
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $time;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $endDate;
    
     /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $endTime;
    
    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    protected $description;
    
    /**
     *
     * @ORM\Column(type="integer", length=10)
     */
    protected $capacity;
    
    /**
     * @ORM\ManyToOne(targetEntity="Venue", inversedBy="events")
     * @ORM\JoinColumn(name="venueId", referencedColumnName="id")
    */
    protected $venue;
    
    /**
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="events")
     * @ORM\JoinColumn(name="organizationId", referencedColumnName="id")
    */
    protected $organization;
    
    /**
     * @ORM\OneToOne(targetEntity="Image", inversedBy="event")
     * @ORM\JoinColumn(name="imageId", referencedColumnName="id")
    */
    protected $image;
    
    /**
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="events")
     * @ORM\JoinColumn(name="accountId", referencedColumnName="id")
    */
    protected $account;
    
    /**
     * @ORM\ManyToOne(targetEntity="Categories", inversedBy="events")
     * @ORM\JoinColumn(name="categoriesId", referencedColumnName="id")
    */
    protected $category;
    
    
     /**
     * @ORM\OneToMany(targetEntity="EventComments", mappedBy="event")
     */
    protected $eventComments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->eventComments = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Event
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Event
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     * @return Event
     */
    public function setTime($time)
    {
        $this->time = $time;
    
        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Event
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    
        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     * @return Event
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    
        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime 
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Event
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
     * Set capacity
     *
     * @param integer $capacity
     * @return Event
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    
        return $this;
    }

    /**
     * Get capacity
     *
     * @return integer 
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set venue
     *
     * @param \Acme\bsceneBundle\Entity\Venue $venue
     * @return Event
     */
    public function setVenue(\Acme\bsceneBundle\Entity\Venue $venue = null)
    {
        $this->venue = $venue;
    
        return $this;
    }

    /**
     * Get venue
     *
     * @return \Acme\bsceneBundle\Entity\Venue 
     */
    public function getVenue()
    {
        return $this->venue;
    }

    /**
     * Set organization
     *
     * @param \Acme\bsceneBundle\Entity\Organization $organization
     * @return Event
     */
    public function setOrganization(\Acme\bsceneBundle\Entity\Organization $organization = null)
    {
        $this->organization = $organization;
    
        return $this;
    }

    /**
     * Get organization
     *
     * @return \Acme\bsceneBundle\Entity\Organization 
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Set image
     *
     * @param \Acme\bsceneBundle\Entity\Image $image
     * @return Event
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
     * Set account
     *
     * @param \Acme\bsceneBundle\Entity\Account $account
     * @return Event
     */
    public function setAccount(\Acme\bsceneBundle\Entity\Account $account = null)
    {
        $this->account = $account;
    
        return $this;
    }

    /**
     * Get account
     *
     * @return \Acme\bsceneBundle\Entity\Account 
     */
    public function getAccount()
    {
        return $this->account;
    }


    /**
     * Add eventComments
     *
     * @param \Acme\bsceneBundle\Entity\EventComments $eventComments
     * @return Event
     */
    public function addEventComment(\Acme\bsceneBundle\Entity\EventComments $eventComments)
    {
        $this->eventComments[] = $eventComments;
    
        return $this;
    }

    /**
     * Remove eventComments
     *
     * @param \Acme\bsceneBundle\Entity\EventComments $eventComments
     */
    public function removeEventComment(\Acme\bsceneBundle\Entity\EventComments $eventComments)
    {
        $this->eventComments->removeElement($eventComments);
    }

    /**
     * Get eventComments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEventComments()
    {
        return $this->eventComments;
    }

    /**
     * Set category
     *
     * @param \Acme\bsceneBundle\Entity\Categories $category
     * @return Event
     */
    public function setCategory(\Acme\bsceneBundle\Entity\Categories $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Acme\bsceneBundle\Entity\Categories 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
