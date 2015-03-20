<?php

/* 
 * Account.php
 * The entity for the account object
 * Revision History:
 *      13.03.2015: created, doaa elfayoumi
 *      15.03.2015: implement userInterface, doaa elfayoumi
 *      15.03.2015: add organization and cities, doaa elfayoumi
 */
//src/bsceneBundle/Entity/Account.php
namespace Acme\bsceneBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="Account")
 */

class Account implements UserInterface
{

    /**
     * @ORM\Column(type="integer", length=10, unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $password;
    
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $firstName;
    
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $lastName;
  
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $email;
    
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $backupEmail;
    
    
    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    protected $businessPhone;
    
    
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $url;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $address1;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $address2;
    
    /**
     * @ORM\ManyToOne(targetEntity="Cities", inversedBy="accounts")
     * @ORM\JoinColumn(name="citiesId", referencedColumnName="id")
    */
    protected $city;
    
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $province;
    
    /**
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="accounts")
     * @ORM\JoinColumn(name="organizationId", referencedColumnName="id")
    */
    protected $organization;
    
    
    /**
     * @ORM\Column(type="float", length=10,options={"default":0})
     */
    protected $paymentAmount;
    
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $memberSince;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Status", inversedBy="accounts")
     * @ORM\JoinColumn(name="statusId", referencedColumnName="id")
    */
    protected $status;
    
    
    /**
    * @ORM\Column(type="boolean",options={"default":0})
    */
    protected $isAdmin;
    
    
    /**
    * @ORM\Column(type="datetime")
    */
    protected $lastLogin;

     /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="account")
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
     * Set username
     *
     * @param string $username
     * @return Account
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
     * Set password
     *
     * @param string $password
     * @return Account
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Account
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Account
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Account
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
     * Set backupEmail
     *
     * @param string $backupEmail
     * @return Account
     */
    public function setBackupEmail($backupEmail)
    {
        $this->backupEmail = $backupEmail;

        return $this;
    }

    /**
     * Get backupEmail
     *
     * @return string 
     */
    public function getBackupEmail()
    {
        return $this->backupEmail;
    }

    /**
     * Set businessPhone
     *
     * @param string $businessPhone
     * @return Account
     */
    public function setBusinessPhone($businessPhone)
    {
        $this->businessPhone = $businessPhone;

        return $this;
    }

    /**
     * Get businessPhone
     *
     * @return string 
     */
    public function getBusinessPhone()
    {
        return $this->businessPhone;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Account
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set address1
     *
     * @param string $address1
     * @return Account
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
     * @return Account
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
     * @return Account
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
     * Set paymentAmount
     *
     * @param float $paymentAmount
     * @return Account
     */
    public function setPaymentAmount($paymentAmount)
    {
        $this->paymentAmount = $paymentAmount;

        return $this;
    }

    /**
     * Get paymentAmount
     *
     * @return float 
     */
    public function getPaymentAmount()
    {
        return $this->paymentAmount;
    }

    /**
     * Set memberSince
     *
     * @param \DateTime $memberSince
     * @return Account
     */
    public function setMemberSince($memberSince)
    {
        $this->memberSince = $memberSince;

        return $this;
    }

    /**
     * Get memberSince
     *
     * @return \DateTime 
     */
    public function getMemberSince()
    {
        return $this->memberSince;
    }

    /**
     * Set isAdmin
     *
     * @param boolean $isAdmin
     * @return Account
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Get isAdmin
     *
     * @return boolean 
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Set lastLogin
     *
     * @param \DateTime $lastLogin
     * @return Account
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return \DateTime 
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set status
     *
     * @param \Acme\bsceneBundle\Entity\Status $status
     * @return Account
     */
    public function setStatus(\Acme\bsceneBundle\Entity\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \Acme\bsceneBundle\Entity\Status 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set city
     *
     * @param \Acme\bsceneBundle\Entity\Cities $city
     * @return Account
     */
    public function setCity(\Acme\bsceneBundle\Entity\Cities $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Acme\bsceneBundle\Entity\Cities 
     */
    public function getCity()
    {
        return $this->city;
    }

    public function eraseCredentials() {
        
    }

    public function getRoles() {
       if($this->isAdmin)
       {
           return array('ROLE_ADMIN');
       }
       else
       {
           return array('ROLE_USER');
       }
    }

    public function getSalt() {
        return null;
    }


    /**
     * Set organization
     *
     * @param \Acme\bsceneBundle\Entity\Organization $organization
     * @return Account
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
     * @return Account
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
