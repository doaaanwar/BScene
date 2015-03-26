<?php

/* 
 * Image.php
 * The entity for the Image object
 * Revision History:
 *      16.03.2015: created, Mahmoud Jallala
 *      26.03.2015: add file property and path function, doaa elfayoumi
 */
//src/bsceneBundle/Entity/Image.php

namespace Acme\bsceneBundle\Entity;



use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;



/**
 * @ORM\Entity
 * @ORM\Table(name="Image")
 */
class Image
{
     /**
     * @ORM\Column(type="integer", length=5,  unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $URL;
    
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $Name;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    
     /**
     * @ORM\OneToOne(targetEntity="Meeting", mappedBy="image")
     */
    protected $event;
    
    /**
     * @ORM\OneToOne(targetEntity="Categories", mappedBy="image")
     */
    protected $category;
    
    

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
     * Set URL
     *
     * @param string $uRL
     * @return Image
     */
    public function setURL($uRL)
    {
        $this->URL = $uRL;
    
        return $this;
    }

    /**
     * Get URL
     *
     * @return string 
     */
    public function getURL()
    {
        return $this->URL;
    }

    /**
     * Set Name
     *
     * @param string $name
     * @return Image
     */
    public function setName($name)
    {
        $this->Name = $name;
    
        return $this;
    }

    /**
     * Get Name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->Name;
    }

    
   /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }


    /**
     * Set event
     *
     * @param \Acme\bsceneBundle\Entity\Meeting $event
     * @return Image
     */
    public function setEvent(\Acme\bsceneBundle\Entity\Meeting $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \Acme\bsceneBundle\Entity\Meeting 
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set category
     *
     * @param \Acme\bsceneBundle\Entity\Categories $category
     * @return Image
     */
    public function setCategory(\Acme\bsceneBundle\Entity\Categories $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Acme\bsceneBundle\Entity\Categories 
     */
    public function getCategory()
    {
        return $this->category;
    }
    
     public function getAbsolutePath()
    {
        return null === $this->URL
            ? null
            : $this->getUploadRootDir().'/'.$this->URL;
    }

    public function getWebPath()
    {
        return null === $this->URL
            ? null
            : $this->getUploadDir().'/'.$this->URL;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/documents';
    }
    
     /**
     * added by doaa elfayoumi 26.03.2015
     * function to return the string value for drop down list
     * @return type
     */
    public function __toString()
    {
        return $this->Name;
    }
    
    
    /**
     * function used for uplaod and save file
     * created 26.03.2015, doaa elfayoumi
     * @return type
     */
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->getFile()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->path = $this->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }


}
