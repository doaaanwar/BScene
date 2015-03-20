<?php

/* 
 * EventComments.php
 * The entity for the EventComments object
 * Revision History:
 *      16.03.2015: created, Mahmoud Jallala
 */
//src/bsceneBundle/Entity/EventComments.php

namespace Acme\bsceneBundle\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="EventComments")
 */
class EventComments
{
     /**
     * @ORM\Column(type="integer", length=5,  unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    
    /**
     * @ORM\Column(type="string", length=1000)
     */
    protected $comment;
    
    
    /**
     * @ORM\Column(type="datetime", length=100)
     */
    protected $commentTime;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $username;
    
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $email;
    
    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="eventComments")
     * @ORM\JoinColumn(name="eventId", referencedColumnName="id")
     */
    protected $event;


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
     * Set comment
     *
     * @param string $comment
     * @return EventComments
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    
        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set commentTime
     *
     * @param \DateTime $commentTime
     * @return EventComments
     */
    public function setCommentTime($commentTime)
    {
        $this->commentTime = $commentTime;
    
        return $this;
    }

    /**
     * Get commentTime
     *
     * @return \DateTime 
     */
    public function getCommentTime()
    {
        return $this->commentTime;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return EventComments
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return EventComments
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set event
     *
     * @param \Acme\bsceneBundle\Entity\Event $event
     * @return EventComments
     */
    public function setEvent(\Acme\bsceneBundle\Entity\Event $event = null)
    {
        $this->event = $event;
    
        return $this;
    }

    /**
     * Get event
     *
     * @return \Acme\bsceneBundle\Entity\Event 
     */
    public function getEvent()
    {
        return $this->event;
    }
}
