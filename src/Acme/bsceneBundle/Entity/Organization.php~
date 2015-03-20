<?php
/* 
 * Organization.php
 * The entity for the Organization object
 * Revision History:
 *      15.03.2015: created, Victoria Betts
 */
//src/bsceneBundle/Entity/Organization.php


namespace Acme\bsceneBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Organization
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Organization
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
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $website;
    
    
     /**
     * @ORM\OneToMany(targetEntity="Account", mappedBy="organization")
     */
    protected $accounts;
    
     /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="organization")
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
     * @return Organization
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
     * Set website
     *
     * @param string $website
     * @return Organization
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->accounts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add accounts
     *
     * @param \Acme\bsceneBundle\Entity\Account $accounts
     * @return Organization
     */
    public function addAccount(\Acme\bsceneBundle\Entity\Account $accounts)
    {
        $this->accounts[] = $accounts;

        return $this;
    }

    /**
     * Remove accounts
     *
     * @param \Acme\bsceneBundle\Entity\Account $accounts
     */
    public function removeAccount(\Acme\bsceneBundle\Entity\Account $accounts)
    {
        $this->accounts->removeElement($accounts);
    }

    /**
     * Get accounts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * Add events
     *
     * @param \Acme\bsceneBundle\Entity\Event $events
     * @return Organization
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
