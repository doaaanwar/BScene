<?php

/**
 * CommentController.php
 * controller used to manage operation on the comment object
 * 
 * Revision History:
 *      19.03.2015: created, doaa elfayoumi
 * 
 */

namespace Acme\bsceneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;



class CommentController extends Controller
{
    /*
     * function that get the list of new comment and go to the comment list admin page
     */
    public function adminIndexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('\Acme\bsceneBundle\Entity\EventComments');

        
        //$commentList = $repository->findBy(array('commentTime' >= $lastLogin));
        
        $commentList = $repository->findAll();
        
        if(count($commentList) > 0)
        {
        
            return $this->render('AcmebsceneBundle:EventComments:commentList.html.twig',array('commnentList' => $organizationList));
        }
        else 
        {
            return $this->render('AcmebsceneBundle:EventComments:commentList.html.twig',array('commentList' => NULL,'errormessage' => "No new comment found from your last login"));

        }
    }
    
    
   
    
    
}
