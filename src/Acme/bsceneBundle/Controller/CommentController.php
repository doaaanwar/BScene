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
   /**
    * doaa elfayoumi
    * function that get the list of new comment given the last login of the admin
    * @param type $lastLogin
    * @return type
    */
    public function adminIndexAction(Request $request,$lastLogin)
    {   
        //check if the admin is logged in
        if($request->getSession()->get('admin') == null)
        {
           return $this->redirect($this->generateUrl('acmebscene_login'));
        }
        
        $em = $this->getDoctrine()->getEntityManager();
        //$repository = $em->getRepository('\Acme\bsceneBundle\Entity\EventComments');
      
        $q = $em->createQuery("select e from \Acme\bsceneBundle\Entity\EventComments e where e.commentTime >= '$lastLogin'");
        $commentList = $q->getResult();


    
        
        if(count($commentList) > 0)
        {
        
            return $this->render('AcmebsceneBundle:EventComments:commentList.html.twig',array('commentList' => $commentList));
        }
        else 
        {
            return $this->render('AcmebsceneBundle:EventComments:commentList.html.twig',array('commentList' => NULL,'errormessage' => "No new comments since your last login"));

        }
    }
    
    
   
    
    
}
