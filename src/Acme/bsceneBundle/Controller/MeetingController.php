<?php

namespace Acme\bsceneBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\bsceneBundle\Entity\Meeting;
use Acme\bsceneBundle\Form\MeetingType;
use Acme\bsceneBundle\Entity\Image;
use \DateTime;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Acme\bsceneBundle\Entity\Speaker;

/**
 * Meeting controller.
 *
 */
class MeetingController extends Controller
{

    /**
     * Lists all Meeting entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmebsceneBundle:Meeting')->findAll();

        return $this->render('AcmebsceneBundle:Meeting:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Meeting entity.
     *
     */
    public function createAction(Request $request)
    {
   
        
        
        $entity = new Meeting();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
     
        $image = $request->get('imageUpload');
        
        //commented till finish implementation
        /*if(($image instanceof UploadedFile) && ($image->getError() == '0'))
        {
            if($image->getSize() > 2000000)
            {
                $originalName = $image->getClientOriginalName();
                $name_array = explode('.',$originalName);
                $file_type = $name_array(sizeof($name_array-1));
                $valid_filetypes =  array('jpg','jpeg','png','bmp');
                if(in_array(strtolower($file_type),$valid_filetypes))
                {
                    
                    //TODO upload and save the path to the image.url
                    $imageEntity = new Image();
                    $imageEntity->setName($image);
                    $imageEntity->setURL($image);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($imageEntity);
                    $em->flush();
                }
                else
                {
                    print_r("Invalid file type");
                    die();
                }
               
            }
            else
            {
                print_r("Size exceed limit");
                die();
            }
          }
          else
         {
             print_r($image->getError());
             die();
         }
*/
        
        
        //create speakers, maximum 5 speakers
        //initialize an array to save created speaker
        $speakerList = array();
        
        for($i=1;$i<=5;$i++)
        {
            if($request->get('nameTextbox'.$i) != "")
            {
                //create new speaker
                $speakerEntity = new Speaker();
                $speakerEntity->setName($request->get('nameTextbox'.$i));
                $speakerEntity->setTitle($request->get('titleTextbox'.$i));
                $speakerEntity->setBiography($request->get('bioTextbox'.$i));
               
                $em = $this->getDoctrine()->getManager();
                
                $em->persist($speakerEntity);
                $em->flush();
                $speakerList[]=$speakerEntity;
            }
        }
       
       
        
       

        //commented till finish implementation
       /* $imageEntity = new Image();
                    $imageEntity->setName($image);
                    $imageEntity->setURL($image);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($imageEntity);
                    $em->flush();
        $entity->setImage($imageEntity);*/
        
        //TODO the same with the enddate
        //TODO check if the date is on the future
        //TODO check if the endDate is null
        $format = 'Y-m-d';
        $entity->setDate(DateTime::createFromFormat($format, $entity->getDate()));
     
        
       
        //TODO handle if the session expire
        //set the account to the logged one
        $em = $this->getDoctrine()->getManager();
        $accountId = $request->getSession()->get('memberId');
        $account = $em->getRepository('AcmebsceneBundle:Account')->findOneBy(array('id'=>$accountId));
        
        $entity->setAccount($account);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            //loop on each speaker created and add the many to many relation between speaker and event
            foreach($speakerList as $speaker)
            {
                $speaker->addEvent($entity);
                $entity->addSpeaker($speaker);
                $em->persist($speaker);
                $em->persist($entity);
                $em->flush();
            }
            
            return $this->redirect($this->generateUrl('meeting_show', array('id' => $entity->getId())));
        }

        return $this->render('AcmebsceneBundle:Meeting:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Meeting entity.
     *
     * @param Meeting $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Meeting $entity)
    {
        $form = $this->createForm(new MeetingType(), $entity, array(
            'action' => $this->generateUrl('meeting_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Meeting entity.
     *
     */
    public function newAction()
    {
        $entity = new Meeting();
        $form   = $this->createCreateForm($entity);

        return $this->render('AcmebsceneBundle:Meeting:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Meeting entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmebsceneBundle:Meeting')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meeting entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmebsceneBundle:Meeting:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Meeting entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmebsceneBundle:Meeting')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meeting entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmebsceneBundle:Meeting:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Meeting entity.
    *
    * @param Meeting $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Meeting $entity)
    {
        $form = $this->createForm(new MeetingType(), $entity, array(
            'action' => $this->generateUrl('meeting_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Meeting entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmebsceneBundle:Meeting')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meeting entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('meeting_edit', array('id' => $id)));
        }

        return $this->render('AcmebsceneBundle:Meeting:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Meeting entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmebsceneBundle:Meeting')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Meeting entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('meeting'));
    }

    /**
     * Creates a form to delete a Meeting entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('meeting_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
     /**
    * Mahmoud Jallala
    * function compares the category of the new event with events in the database
    * @param type $category
    * @return type
    */
    private function relatedEventAction($Category)
    {   
        $em = $this->getDoctrine()->getEntityManager();
 
        //To get the events with the same titles 
        $q = $em->createQuery("select e from \Acme\bsceneBundle\Entity\Meeting e where e.meeting >= '$category'");
        $relatedEvents = $q->getResult();

        return $relatedEvents;
        
    }
}
