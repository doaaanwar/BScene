<?php

/**
 * OrganizationController.php
 * controller used to manage operation on the organization object
 * 
 * Revision History:
 *      19.03.2015: created, doaa elfayoumi
 * 
 */

namespace Acme\bsceneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;



class OrganizationController extends Controller
{
    /*
     * function that get the list of organization and go to the organization list page
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('\Acme\bsceneBundle\Entity\Organization');

        
        $organizationList = $repository->findAll();
        if(count($organizationList) > 0)
        {
        
            return $this->render('AcmebsceneBundle:Organization:organizationList.html.twig',array('orgList' => $organizationList));
        }
        else 
        {
            return $this->render('AcmebsceneBundle:Organization:organizationList.html.twig',array('orgList' => NULL,'errormessage' => "No organization list found"));

        }
    }
    
}
