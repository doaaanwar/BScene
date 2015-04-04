<?php
/* 
 * Eventful.php
 * The entity for the Eventful object
 * Revision History:
 *      03.04.2015: created, Mahmoud Jallala
 */
//src/bsceneBundle/Entity/Cities.php

namespace Acme\bsceneBundle\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Meetup")
 */
class Meetup
{
    /**
     * @ORM\OneToOne(targetEntity="meeting", inversedBy="meetup")
     * @ORM\JoinColumn(name="eventId", referencedColumnName="id")
     * * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $event;
    
    /**
     * @ORM\Column(type="integer", length=100)
     */
    protected $meetupGrpupId;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $meetupGroupUrl;


    /**
     * Set meetupGrpupId
     *
     * @param integer $meetupGrpupId
     * @return Meetup
     */
    public function setMeetupGrpupId($meetupGrpupId)
    {
        $this->meetupGrpupId = $meetupGrpupId;
    
        return $this;
    }

    /**
     * Get meetupGrpupId
     *
     * @return integer 
     */
    public function getMeetupGrpupId()
    {
        return $this->meetupGrpupId;
    }

    /**
     * Set meetupGroupUrl
     *
     * @param string $meetupGroupUrl
     * @return Meetup
     */
    public function setMeetupGroupUrl($meetupGroupUrl)
    {
        $this->meetupGroupUrl = $meetupGroupUrl;
    
        return $this;
    }

    /**
     * Get meetupGroupUrl
     *
     * @return string 
     */
    public function getMeetupGroupUrl()
    {
        return $this->meetupGroupUrl;
    }

    /**
     * Set event
     *
     * @param \Acme\bsceneBundle\Entity\event $event
     * @return Meetup
     */
    public function setEvent(\Acme\bsceneBundle\Entity\event $event)
    {
        $this->event = $event;
    
        return $this;
    }

    /**
     * Get event
     *
     * @return \Acme\bsceneBundle\Entity\event 
     */
    public function getEvent()
    {
        return $this->event;
    }
}
