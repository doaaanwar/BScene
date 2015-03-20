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
    
    public function indexAction()
    {
        return $this->render('AcmebsceneBundle:Default:adminIndex.html.twig');
    }
    
}
