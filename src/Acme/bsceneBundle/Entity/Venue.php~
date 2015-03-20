<?php

/* 
 * Venue.php
 * The entity for the Venue object
 * Revision History:
 *      15.03.2015: created, Victoria Betts
 */
//src/bsceneBundle/Entity/Venue.php

namespace Acme\bsceneBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Venue
 * @ORM\Entity
 * @ORM\Table(name="Venue")
 */
class Venue
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
     * @ORM\Column(type="string", length=255)
     */
    protected $name;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $address1;
     /**
     * @ORM\Column(type="string", length=255)
     */
    protected $address2;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $province;
    /**
     * @ORM\Column(type="string", length=7)
     */
    protected $postalCode;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $country;
    /**
     * @ORM\Column(type="decimal", nullable=true)
     */
    protected $latitude;
    /**
     * @ORM\Column(type="decimal", nullable=true)
     */
    protected $longitude;
    
    /**
     * @ORM\ManyToOne(targetEntity="Cities", inversedBy="venues")
     * @ORM\JoinColumn(name="citiesId", referencedColumnName="id")
     */
    protected $city;
    
    
     /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="venue")
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
     * @return Venue
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
     * Set address1
     *
     * @param string $address1
     * @return Venue
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * Get address1
     *
     * @return string 
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     * @return Venue
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2
     *
     * @return string 
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set province
     *
     * @param string $province
     * @return Venue
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return string 
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     * @return Venue
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string 
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Venue
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return Venue
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return Venue
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set city
     *
     * @param \Acme\bsceneBundle\Entity\City $city
     * @return Venue
     */
    public function setCity(\Acme\bsceneBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Acme\bsceneBundle\Entity\City 
     */
    public function getCity()
    {
        return $this->city;
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
     * @return Venue
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
