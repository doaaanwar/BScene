<?php

/**
 * AdminController.php
 * controller used to manage all admin operations
 * 
 * Revision History:
 *      19.03.2015: created, doaa elfayoumi
 *      21.03.2015: adding function to get the list of controller , doaa elfayoumi
 *      22.03.2015: adding function to get the list of new comments, doaa elfayoumi
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
        $commentList = $this->getCommentList($lastLogin);
        if(count($commentList) == 0)
        {
            $commentMessage = "no new comments found";
        }
        else
        {
            $commentMessage = Null;
            
        }
        
        $eventList = $this->getNewMeetingList($lastLogin);
        
        if(count($eventList) == 0)
        {
            $newEventMessage = "no new event found";
        }
        else
        {
            $newEventMessage = Null;
            
        }
         
       
        
        //TODO get the number of upccomming events
        
        //TODO get the number of new members
        
        
        
      
        
        //TODO get the list of new members
        
        
        return $this->render('AcmebsceneBundle:Default:adminIndex.html.twig', array('commentList' => $commentList,
                                                                                    'commentMessage' => $commentMessage, 
                                                                                    'commentCount' => Count($commentList),
                                                                                    'eventList' => $eventList,
                                                                                    'eventCount' => Count($eventList),
                                                                                    'newEventMessage' => $newEventMessage));
    }
    
    
    /**
    * doaa elfayoumi
    * function that get the list of new comment given the last login of the admin
    * @param type $lastLogin
    * @return type
    */
    private function getCommentList($lastLogin)
    {   
        $em = $this->getDoctrine()->getEntityManager();
 
        //TODO get only the top 10
        $q = $em->createQuery("select e from \Acme\bsceneBundle\Entity\EventComments e where e.commentTime >= '$lastLogin'");
        $commentList = $q->getResult();

        return $commentList;
        
    }
    
    /**
    * doaa elfayoumi
    * function that get the list of new events given the last login of the admin
    * @param type $lastLogin
    * @return type
    */
    private function getNewMeetingList($lastLogin)
    {
        $em = $this->getDoctrine()->getManager();
        
        $q = $em->createQuery("select e from \Acme\bsceneBundle\Entity\Meeting e where e.createdOn >= '$lastLogin'");
        $eventList = $q->getResult();

        return $eventList;
    }
    
    
    
    
    /**
     * 
     * @param type $lastLogin
     * @return type
     */
    public function newMeetingListAction($lastLogin)
    {
         $entities = $this->getNewMeetingList($lastLogin);
         return $this->render('AcmebsceneBundle:Meeting:newMeetingList.html.twig', array( 'entities' => $entities,));
    }
    
    
}
