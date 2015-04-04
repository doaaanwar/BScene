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
 * @ORM\Table(name="EventBrite")
 */
class EventBrite
{
    /**
     * @ORM\OneToOne(targetEntity="meeting", inversedBy="eventful")
     * @ORM\JoinColumn(name="eventId", referencedColumnName="id")
     * * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $event;
    
    /**
     * @ORM\Column(type="integer", length=100)
     */
    protected $eventBriteId;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $ebUrl;
     /**
     * @ORM\Column(type="boolean")
     */
    protected $shereable;
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $token;
     /**
     * @ORM\Column(type="boolean")
     */
    protected $invitedOnly;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $eventCategory;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $listedPublic;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $showRemaining;
     /**
     * @ORM\Column(type="boolean")
     */
    protected $onlineOnly;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $timeZone;

    /**
     * Set eventBriteId
     *
     * @param integer $eventBriteId
     * @return EventBrite
     */
    public function setEventBriteId($eventBriteId)
    {
        $this->eventBriteId = $eventBriteId;
    
        return $this;
    }

    /**
     * Get eventBriteId
     *
     * @return integer 
     */
    public function getEventBriteId()
    {
        return $this->eventBriteId;
    }

    /**
     * Set ebUrl
     *
     * @param string $ebUrl
     * @return EventBrite
     */
    public function setEbUrl($ebUrl)
    {
        $this->ebUrl = $ebUrl;
    
        return $this;
    }

    /**
     * Get ebUrl
     *
     * @return string 
     */
    public function getEbUrl()
    {
        return $this->ebUrl;
    }

    /**
     * Set shereable
     *
     * @param boolean $shereable
     * @return EventBrite
     */
    public function setShereable($shereable)
    {
        $this->shereable = $shereable;
    
        return $this;
    }

    /**
     * Get shereable
     *
     * @return boolean 
     */
    public function getShereable()
    {
        return $this->shereable;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return EventBrite
     */
    public function setToken($token)
    {
        $this->token = $token;
    
        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set invitedOnly
     *
     * @param boolean $invitedOnly
     * @return EventBrite
     */
    public function setInvitedOnly($invitedOnly)
    {
        $this->invitedOnly = $invitedOnly;
    
        return $this;
    }

    /**
     * Get invitedOnly
     *
     * @return boolean 
     */
    public function getInvitedOnly()
    {
        return $this->invitedOnly;
    }

    /**
     * Set eventCategory
     *
     * @param boolean $eventCategory
     * @return EventBrite
     */
    public function setEventCategory($eventCategory)
    {
        $this->eventCategory = $eventCategory;
    
        return $this;
    }

    /**
     * Get eventCategory
     *
     * @return boolean 
     */
    public function getEventCategory()
    {
        return $this->eventCategory;
    }

    /**
     * Set listedPublic
     *
     * @param boolean $listedPublic
     * @return EventBrite
     */
    public function setListedPublic($listedPublic)
    {
        $this->listedPublic = $listedPublic;
    
        return $this;
    }

    /**
     * Get listedPublic
     *
     * @return boolean 
     */
    public function getListedPublic()
    {
        return $this->listedPublic;
    }

    /**
     * Set showRemaining
     *
     * @param boolean $showRemaining
     * @return EventBrite
     */
    public function setShowRemaining($showRemaining)
    {
        $this->showRemaining = $showRemaining;
    
        return $this;
    }

    /**
     * Get showRemaining
     *
     * @return boolean 
     */
    public function getShowRemaining()
    {
        return $this->showRemaining;
    }

    /**
     * Set onlineOnly
     *
     * @param boolean $onlineOnly
     * @return EventBrite
     */
    public function setOnlineOnly($onlineOnly)
    {
        $this->onlineOnly = $onlineOnly;
    
        return $this;
    }

    /**
     * Get onlineOnly
     *
     * @return boolean 
     */
    public function getOnlineOnly()
    {
        return $this->onlineOnly;
    }

    /**
     * Set timeZone
     *
     * @param boolean $timeZone
     * @return EventBrite
     */
    public function setTimeZone($timeZone)
    {
        $this->timeZone = $timeZone;
    
        return $this;
    }

    /**
     * Get timeZone
     *
     * @return boolean 
     */
    public function getTimeZone()
    {
        return $this->timeZone;
    }

    /**
     * Set event
     *
     * @param \Acme\bsceneBundle\Entity\meeting $event
     * @return EventBrite
     */
    public function setEvent(\Acme\bsceneBundle\Entity\meeting $event)
    {
        $this->event = $event;
    
        return $this;
    }

    /**
     * Get event
     *
     * @return \Acme\bsceneBundle\Entity\meeting 
     */
    public function getEvent()
    {
        return $this->event;
    }
}
