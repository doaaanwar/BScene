<?php

/* 
 * Cities.php
 * The entity for the Cities object
 * Revision History:
 *      15.03.2015: created, Victoria Betts
 */
//src/bsceneBundle/Entity/Cities.php

namespace Acme\bsceneBundle\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Cities")
 */
class Cities
{
     /**
     * @ORM\Column(type="integer", length=5)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Venue", mappedBy="city")
     */
    protected $venues;
    
    /**
     * @ORM\OneToMany(targetEntity="Account", mappedBy="city")
     */
    protected $accounts;

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
     * @return Cities
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
     * Constructor
     */
    public function __construct()
    {
        $this->venues = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add venues
     *
     * @param \Acme\bsceneBundle\Entity\Venue $venues
     * @return Cities
     */
    public function addVenue(\Acme\bsceneBundle\Entity\Venue $venues)
    {
        $this->venues[] = $venues;

        return $this;
    }

    /**
     * Remove venues
     *
     * @param \Acme\bsceneBundle\Entity\Venue $venues
     */
    public function removeVenue(\Acme\bsceneBundle\Entity\Venue $venues)
    {
        $this->venues->removeElement($venues);
    }

    /**
     * Get venues
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVenues()
    {
        return $this->venues;
    }

    /**
     * Add accounts
     *
     * @param \Acme\bsceneBundle\Entity\Account $accounts
     * @return Cities
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
}
