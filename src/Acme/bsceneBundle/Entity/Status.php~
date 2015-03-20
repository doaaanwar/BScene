<?php

/* 
 * Status.php
 * The entity for the status object
 * Revision History:
 *      13.03.2015: created, doaa elfayoumi
 */

//src/Acme/bsceneBundle/Entity/Status.php
namespace Acme\bsceneBundle\Entity;



use Doctrine\ORM\Mapping as ORM;




/**
 * @ORM\Entity
 * @ORM\Table(name="Status")
 */
class Status
{
     /**
     * @ORM\Column(type="integer", length=2)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;
    
    /**
     * @ORM\OneToMany(targetEntity="Account", mappedBy="status")
     */
    protected $accounts;
    
    public function __construct()
    {
        $this->accounts = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Status
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
     * @return Status
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
