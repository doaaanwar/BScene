<?php

namespace Acme\bsceneBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Province
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Province
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
     * @ORM\Column(name="name", type="string")
     */
    protected $name;
    
    /**
     * @ORM\OneToMany(targetEntity="Account", mappedBy="province")
     */
    protected $accounts;
    
    /**
     * @ORM\OneToMany(targetEntity="Venue", mappedBy="province")
     */
    protected $venues;


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
     * Constructor
     */
    public function __construct()
    {
        $this->accounts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->venues = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Province
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
     * Add accounts
     *
     * @param \Acme\bsceneBundle\Entity\Account $accounts
     * @return Province
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
     * Add venues
     *
     * @param \Acme\bsceneBundle\Entity\Venue $venues
     * @return Province
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
}
