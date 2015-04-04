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
 * @ORM\Table(name="Eventful")
 */
class Eventful
{
    /**
     * @ORM\OneToOne(targetEntity="event", inversedBy="eventful")
     * @ORM\JoinColumn(name="eventId", referencedColumnName="id")
     * * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $event;
    
    /**
     * @ORM\Column(type="integer", length=100)
     */
    protected $eventfulOrgId;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $eventfulUrl;

    /**
     * Set eventfulOrgId
     *
     * @param integer $eventfulOrgId
     * @return Eventful
     */
    public function setEventfulOrgId($eventfulOrgId)
    {
        $this->eventfulOrgId = $eventfulOrgId;
    
        return $this;
    }

    /**
     * Get eventfulOrgId
     *
     * @return integer 
     */
    public function getEventfulOrgId()
    {
        return $this->eventfulOrgId;
    }

    /**
     * Set eventfulUrl
     *
     * @param string $eventfulUrl
     * @return Eventful
     */
    public function setEventfulUrl($eventfulUrl)
    {
        $this->eventfulUrl = $eventfulUrl;
    
        return $this;
    }

    /**
     * Get eventfulUrl
     *
     * @return string 
     */
    public function getEventfulUrl()
    {
        return $this->eventfulUrl;
    }

    /**
     * Set event
     *
     * @param \Acme\bsceneBundle\Entity\event $event
     * @return Eventful
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
