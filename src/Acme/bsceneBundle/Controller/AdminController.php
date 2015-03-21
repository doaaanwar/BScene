<?php

/**
 * AdminController.php
 * controller used to manage all admin operations
 * 
 * Revision History:
 *      19.03.2015: created, doaa elfayoumi
 * 
 */

namespace Acme\bsceneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;



class AdminController extends Controller
{
    
    public function indexAction($lastLogin)
    {
        //get the number and list of new comments
        $commentList = $this->commentListAction($lastLogin);
        if(count($commentList) == 0)
        {
            $commentMessage = "no new comments found";
        }
        else
        {
            $commentMessage = Null;
        }
        //TODO get the number of new events
        
        //TODO get the number of upccomming events
        
        //TODO get the number of new members
        
        
        
        //TODO get the list of new events
        
        //TODO get the list of new members
        
        
        return $this->render('AcmebsceneBundle:Default:adminIndex.html.twig', array('commentList' => $commentList,
                                                                                    'commentMessage' => $commentMessage, 
                                                                                    'commentCount' => Count($commentList)));
    }
    
    
    /**
    * doaa elfayoumi
    * function that get the list of new comment given the last login of the admin
    * @param type $lastLogin
    * @return type
    */
    private function commentListAction($lastLogin)
    {   
        $em = $this->getDoctrine()->getEntityManager();
 
        //TODO get only the top 10
        $q = $em->createQuery("select e from \Acme\bsceneBundle\Entity\EventComments e where e.commentTime >= '$lastLogin'");
        $commentList = $q->getResult();

        return $commentList;
        
    }
    
    
    
}
