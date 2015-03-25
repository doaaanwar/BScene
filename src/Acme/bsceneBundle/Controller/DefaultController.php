<?php

namespace Acme\bsceneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Acme\bsceneBundle\Controller\CategoriesController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\BrowserKit\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        $categoryList = $this->getCategoryList();
        
        return $this->render('AcmebsceneBundle:Default:index.html.twig', array('categoryList' => $categoryList));
    }
    
    
    private function getCategoryList()
    {
   
        $em = $this->getDoctrine()->getManager();
        
        $qb = $em->createQueryBuilder();
        
        $qb->select('c')->From('AcmebsceneBundle:Categories','c')->orderBy('c.ranking','DESC');
        $query = $qb->getQuery();
        
        $categoryList = $query->getResult();
        
        return $categoryList;
    }
    
    /**
     * Added by doaa elfayoumi - 22.03.2015 to get the json response for the homepage calender
     * @return \Acme\bsceneBundle\Controller\JsonResponse
     */
    public function getEventsDayListAction()
    {
        $em = $this->getDoctrine()->getManager();
       
        
        $q = $em->createQuery("select Distinct m.date from \Acme\bsceneBundle\Entity\Meeting m");
         
        $dateList = $q->getResult();
        
        //transform the result to the format need for the calender
        
        $dateArray = Null;
        $dateArrayEntry = Null;
        
        foreach($dateList as $item)
        {
          $dateArrayEntry = array("date"=>$item['date']->format('d/m/y'),"title"=>"event on ".$item['date']->format('Y-m-d'),"link"=>"www.google.com","color"=>"green");   
          
          $dateArray[] = $dateArrayEntry;
        }
        
        //encode the array to json
        //removed the encode because it require decode on the page before be used by the calender
        //$dateArray = json_encode($dateArray);
        

        //return json result into a php page
        return new JsonResponse($dateArray);
      }
    
    public function loginAction(Request $request)
    {
         $categoryList = $this->getCategoryList();
        
        
         if($request->getMethod()=='POST'){
            $session = $request->getSession();
            $session->clear();
            $username = $request->get('username');
            $password = $request->get('password');
            $em = $this->getDoctrine()->getEntityManager();
            
    
            
            $repository = $em->getRepository('\Acme\bsceneBundle\Entity\Account');
            
            //fetch user by username
            $user = $repository->findOneBy(array('username'=>$username));
            
            //username found
            if($user)
            {
                $verified = password_verify($password, $user->getPassword());
                if($verified)
                {
                    //$session = new Session();
                    //$session->start();
                    $session->invalidate(500);
                    $session->set('member',$user->getUsername());
                    $session->set('memberId',$user->getId());
                    if($user->getIsAdmin() == 1)
                    {

                        $session->set('admin','admin');
                        $session->set('lastLogin',$user->getLastLogin());
                        
                        //TODO save the current time for the last login of the admin or do it on the logout
                        
                        
                    }

                     
                     return $this->render('AcmebsceneBundle:Default:index.html.twig',array('name' => $user->getUsername(),'categoryList' => $categoryList));
                }
                else
                {
                    //password doesn't match
                   return $this->render('AcmebsceneBundle:Default:index.html.twig',array('errormessage' => 'uncorrect password','categoryList' => $categoryList));
                }
            }
            else
            {
                 
                 return $this->render('AcmebsceneBundle:Default:index.html.twig',array('errormessage' => 'login failed','categoryList' => $categoryList));
             
            }
        }
        else
        {
             return $this->render('AcmebsceneBundle:Default:index.html.twig',array('categoryList' => $categoryList));
        }
    }
}
