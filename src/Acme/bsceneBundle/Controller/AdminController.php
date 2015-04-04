<?php

/**
 * AdminController.php
 * controller used to manage all admin operations
 * 
 * Revision History:
 *      19.03.2015: created, doaa elfayoumi
 *      21.03.2015: adding function to get the list of controller , doaa elfayoumi
 *      22.03.2015: adding function to get the list of new comments, doaa elfayoumi
 *      03.04.2015: adding new member list
 *      04.04.2015: adding the upcoming events
 */

namespace Acme\bsceneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use DateTime;



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
         
       
        
        //get the number of upccomming events
        $upcomingList = $this->getAdminUpcomingMeetingList();
        
        if(count($upcomingList) == 0)
        {
             $upcomingMessage = "no upcoming event found";
        }
        else
        {
            $upcomingMessage = Null;
            
        }
        
        
        //get the number of new members
        
        $memberList = $this->getNewMemberList($lastLogin);
        
        if(count($memberList) == 0)
        {
             $memberMessage = "no new event found";
        }
        else
        {
            $memberMessage = Null;
            
        }
      
        
        //TODO get the list of new members
        
        
        return $this->render('AcmebsceneBundle:Default:adminIndex.html.twig', array('commentList' => $commentList,
                                                                                    'commentMessage' => $commentMessage, 
                                                                                    'commentCount' => Count($commentList),
                                                                                    'eventList' => $eventList,
                                                                                    'eventCount' => Count($eventList),
                                                                                    'newEventMessage' => $newEventMessage,
                                                                                     'memberList' => $memberList,
                                                                                    'memberCount' => Count($memberList),
                                                                                    'memberMessage' => $memberMessage,
                                                                                    'upcomingList' => $upcomingList,
                                                                                    'upcomingMessage' => $upcomingMessage,
                                                                                    'upcomingCount' => Count($upcomingList),));
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
    * doaa elfayoumi
    * function that get the list of upcoming events
    * @param type $lastLogin
    * @return type
    */
    private function getAdminUpcomingMeetingList()
    {
        $em = $this->getDoctrine()->getManager();
        
        $todayDate = new \DateTime();
        //$format = 'Y-m-d';
        //$todayDate = DateTime::createFromFormat($format, str$todayDate);
        $q = $em->createQuery("SELECT e FROM \Acme\bsceneBundle\Entity\Meeting e "
                        . "WHERE e.date >= :searchDate ORDER BY e.date DESC")
                ->setParameter('searchDate', $todayDate);
       // $q = $em->createQuery("select e from \Acme\bsceneBundle\Entity\Meeting e where e.date >= '$todayDate'");
        $eventList = $q->getResult();

        return $eventList;
    }
    
    
    
    
    /**
    * doaa elfayoumi
    * function that get the new member list given the last login of the admin
    * @param type $lastLogin
    * @return type
    */
    private function getNewMemberList($lastLogin)
    {
        $em = $this->getDoctrine()->getManager();
        
        $q = $em->createQuery("select e from \Acme\bsceneBundle\Entity\Account e where e.memberSince >= '$lastLogin'");
        $memberList = $q->getResult();

        return $memberList;
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
    
    /**
     * 
     * @return type
     */
    public function upCommingMeetingListAction()
    {
         $entities = $this->getAdminUpcomingMeetingList();
         return $this->render('AcmebsceneBundle:Meeting:commingMeetingList.html.twig', array( 'entities' => $entities,));
    }
      
}
