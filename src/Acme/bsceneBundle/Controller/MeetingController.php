<?php

namespace Acme\bsceneBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\bsceneBundle\Entity\Meeting;
use Acme\bsceneBundle\Form\MeetingType;
use Acme\bsceneBundle\Entity\Image;
use Acme\bsceneBundle\Entity\Organization;
use \DateTime;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Acme\bsceneBundle\Entity\Speaker;
use Acme\bsceneBundle\Entity\Venue;
use Doctrine\ORM\Query\AST\Functions\SizeFunction;

/**
 * Meeting controller.
 *
 */
class MeetingController extends Controller {

    /**
     * Lists results from keyword search.
     *
     */
    public function keywordSearchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $keyword = $this->get('request')->request->get('searchTerm');

        if (($keyword != "") && ($keyword != " ")) {

            $searchResults = $this->searchEvents($request->get("searchTerm"));
            $resultCount = \Count($searchResults);
            $noResults = "Sorry, there are no results. Try a different search.";
        } else {
            $searchResults = [];
            $resultCount = 0;
            $noResults = "That is not a valid search! Please try again.";
        }
        return $this->render('AcmebsceneBundle:Meeting:index.html.twig', array(
                    'searchResults' => $searchResults,
                    'resultCount' => $resultCount,
                    'noResults' => $noResults,
        ));
    }

    /**
     * Lists results from category search
     */
    public function categorySearchAction($id) {
        $em = $this->getDoctrine()->getManager();
        
        $resultList = $this->searchCategories($id);
        $resultCount = \Count($resultList);
        $noResults = "";
        
        if ($resultCount == 0)
        {
            $noResults = "There are no events in this category. Please try again.";
        }

        return $this->render('AcmebsceneBundle:Meeting:index.html.twig', array(
                    'searchResults' => $resultList,
                    'resultCount' => $resultCount,
                    'noResults' => $noResults,
        ));
        
        
        
    }
    
     /**
        * Creates a new Meeting entity.
        * updated, doaa elfayoumi 23.03.2015
        * updated, doaa elfayoumi 24.03.2015
        * updated, doaa elfayoumi 25.03.2015
        * updated, doaa elfayoumi 26.03.2015
      */
    public function createAction(Request $request) {
        $entity = new Meeting();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $image = $request->files->get('imageUpload');
        $imageEntity = NULL;
        //commented till finish implementation
        if (($image instanceof UploadedFile) && ($image->getError() == '0')) {
            $originalName = $image->getClientOriginalName();
            $name_array = explode('.', $originalName);
            $file_type = $name_array[sizeof($name_array) - 1];
            $valid_filetypes = array('jpg', 'jpeg', 'png', 'bmp');
            if (in_array(strtolower($file_type), $valid_filetypes)) {
            //upload and save the path to the image.url
                $imageEntity = new Image();
                $imageEntity->setFile($image);
            //TODO check if name already there
                $imageEntity->setName($originalName);
                $imageEntity->upload();
            //TODO set the URL/path
                $imageEntity->setURL($imageEntity->getWebPath());
                $em = $this->getDoctrine()->getManager();
                $em->persist($imageEntity);
                $em->flush();
                $entity->setImage($imageEntity);
            } else {
                print_r("Invalid file type");
                die();
            }
        } else {
            print_r($image->getError());
            die();
        }
        //create speakers, maximum 5 speakers
        //initialize an array to save created speaker
        $speakerList = array();
        for ($i = 1; $i <= 5; $i++) {
            if ($request->get('nameTextbox' . $i) != "") {
                //create new speaker
                $speakerEntity = new Speaker();
                $speakerEntity->setName($request->get('nameTextbox' . $i));
                $speakerEntity->setTitle($request->get('titleTextbox' . $i));
                $speakerEntity->setBiography($request->get('bioTextbox' . $i));
                $em = $this->getDoctrine()->getManager();
                $em->persist($speakerEntity);
                $em->flush();
                $speakerList[] = $speakerEntity;
            }
        }
        //Create venue and assign it to the event
        $placeId = $request->get('place_id');
        if ($placeId) {
            $em = $this->getDoctrine()->getEntityManager();
            $repository = $em->getRepository('\Acme\bsceneBundle\Entity\Venue');
            $venueEntity = $repository->findOneBy(array('placeId' => $placeId));
            if (!$venueEntity) {
                //the format for the lat lng is (43.4433963, -80.52255709999997)
                //split it to get each value
                $newArray = array();
                $venueEntity = new Venue();
                $latlng = $request->get('lng');
                $latlng = str_replace('(', '', $latlng);
                $latlng = str_replace(')', '', $latlng);
                $latlngVal = explode(',', $latlng, 2);
                
                //get the city
                $cityName = $request->get('locality');
                
                $repository = $em->getRepository('\Acme\bsceneBundle\Entity\Cities');
                $cityEntity = $repository->findOneBy(array('name' => $cityName));
                if($cityEntity)
                {
                    $venueEntity->setCity($cityEntity);
                }
                else
                {
                    //TODO the city constraint
                }
                
                //get the province
                $provinceName = $request->get('administrative_area_level_1');
                
                $repository = $em->getRepository('\Acme\bsceneBundle\Entity\Province');
                $provinceEntity = $repository->findOneBy(array('name' => $provinceName));
                if($provinceEntity)
                {
                    $venueEntity->setProvince($provinceEntity);
                }
                else
                {
                    //TODO the city constraint
                }
                //TODO put the province constraint
                
                
                
                $venueEntity->setPlaceId($placeId);
                $venueEntity->setAddress1($request->get('street_number'));
                $venueEntity->setAddress2($request->get('route'));
                $venueEntity->setPostalCode($request->get('postal_code'));
                $venueEntity->setCountry($request->get('country'));
                $venueEntity->setName($request->get('name'));
                $venueEntity->setLatitude($latlngVal[0]);
                $venueEntity->setLongitude($latlngVal[1]);
                $em = $this->getDoctrine()->getManager();
                $em->persist($venueEntity);
                $em->flush();
            }
            $entity->setVenue($venueEntity);
        }
        $format = 'Y-m-d';
        $entity->setDate(DateTime::createFromFormat($format, $entity->getDate()));
        //check if the endDate is not null and format it
        if ($entity->getEndDate()) {
            $entity->setEndDate(DateTime::createFromFormat($format, $entity->getEndDate()));
        }
        //TODO check if the date is on the future
        //TODO handle if the session expire
        //set the account to the logged one
        $em = $this->getDoctrine()->getManager();
        $accountId = $request->getSession()->get('memberId');
        $account = $em->getRepository('AcmebsceneBundle:Account')->findOneBy(array('id' => $accountId));
        $entity->setAccount($account);
        //set the organization to the account organization
        $entity->setOrganization($account->getOrganization());
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            //loop on each speaker created and add the many to many relation between speaker and event
            foreach ($speakerList as $speaker) {
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
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Meeting entity.
     *
     * @param Meeting $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Meeting $entity) {
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
    public function newAction() {
        $entity = new Meeting();
        $form = $this->createCreateForm($entity);
        //$relatedEventList = $this->relatedEventAction($id);
        return $this->render('AcmebsceneBundle:Meeting:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                        //'relatedEvents'   => $relatedEventList,
        ));
    }

    /**
     * Finds and displays a Meeting entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $commentsList = $this->comments($id);
        $speakerList = $this->speaker($id);
        $venueList = $this->getVenue($id);
        $orgList = $this->getOrg($id);
        $venueCont = \Count($venueList);
        $orgCount = \Count($orgList);
        $commentCount = \Count($commentsList);
        $speakerCount = \Count($speakerList);
        //$imageURL  = Image::URL;
        //$imageEntity  = $this->event->getImage();
        $repository = $em->getRepository('\Acme\bsceneBundle\Entity\Image');
       
       
         
        $entity = $em->getRepository('AcmebsceneBundle:Meeting')->find($id);


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meeting entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
         $imageEntity= $entity->getImage();
        $uploadedURL = $imageEntity->getURL();
        return $this->render('AcmebsceneBundle:Meeting:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
                    'comments' => $commentsList,
                    'commentCount' => $commentCount,
                    'speaker' => $speakerList,
                    'speakerCount' => $speakerCount,
                    'org' => $orgList,
                    'orgCount' => $orgCount,
                    'uploadedURL' => $uploadedURL,
                    'venue' => $venueList,
                    'venueCont' => $venueCont,
                    
        ));
    }

    /**
     * Creates a form to edit a Meeting entity.
     *
     * @param Meeting $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Meeting $entity) {
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
    public function updateAction(Request $request, $id) {
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
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Meeting entity.
     *
     */
    public function deleteAction(Request $request, $id) {
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
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('meeting_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

    /**
     * Mahmoud Jallala
     * function gets a list of the events in the same date and category with the new event
     * @param type $id
     * @return type
     */
    private function relatedEventAction($id) {
        $currentDate = new \DateTime();
        $em = $this->getDoctrine()->getEntityManager();

        //To get the events with the same category and date  
        $q = $em->createQuery("select e "
                        . "from \Acme\bsceneBundle\Entity\Meeting e "
                        . "WHERE e.meeting = '$id' AND e.date = :date AND e.category = :category"
                        . " ORDER BY e.date ASC")->setParameter('date', $currentDate);
        $relatedEventList = $q->getResult();

        return $relatedEventList;
    }

    /**
     * Mahmoud Jallala
     * function to get the comments on the Event Details page 
     * @param type $id
     * @return type
     */
    private function comments($id) {
        $em = $this->getDoctrine()->getEntityManager();

        //To get the comments with the id  
        $q = $em->createQuery("select e "
                        . "from \Acme\bsceneBundle\Entity\EventComments e "
                        . "WHERE e.event = :id")->setParameter('id', $id);
        $commentsList = $q->getResult();

        return $commentsList;
    }
    /**
     * Mahmoud Jallala
     * function to get the Image on the Event Details page 
     * @param type $id
     * @return type
     */
    private function getImage($id) {
        $em = $this->getDoctrine()->getEntityManager();

        //To get the Image for the event 
        $q = $em->createQuery("select e "
                        . "from \Acme\bsceneBundle\Entity\Image e "
                        . "WHERE e.event = :id")->setParameter('id', $id);
        $imageURL = $q->getResult();

        return $imageURL;
    }
    /**
     * Mahmoud Jallala
     * function to get the Organization on the Event Details page 
     * @param type $id
     * @return type
     */
    private function getOrg($id) {
        $em = $this->getDoctrine()->getEntityManager();

        //To get the Organization for the event 
        $q = $em->createQuery("select e "
                        . "from \Acme\bsceneBundle\Entity\Organization e INNER JOIN e.events p "
                        . "WHERE p.id = :id")->setParameter('id', $id);
        $orglist = $q->getResult();

        return $orglist;
    }
    /**
     * Mahmoud Jallala
     * function to get the Organization on the Event Details page 
     * @param type $id
     * @return type
     */
    private function getVenue($id) {
        $em = $this->getDoctrine()->getEntityManager();

        //To get the Organization for the event 
        $q = $em->createQuery("select e "
                        . "from \Acme\bsceneBundle\Entity\Venue e INNER JOIN e.events p "
                        . "WHERE p.id = :id")->setParameter('id', $id);
        $venuelist = $q->getResult();

        return $venuelist;
    }
    

    /**
     * Mahmoud Jallala
     * function to get the speaker on the Event Details page 
     * @param type $id
     * @return type
     */
    private function speaker($id) {
        $em = $this->getDoctrine()->getEntityManager();

        //To get the events with the same titles 
        $q = $em->createQuery("select e "
                        . "from \Acme\bsceneBundle\Entity\Speaker e "
                        . "WHERE e.id = :id")->setParameter('id', $id);
        $speakerList = $q->getResult();

        return $speakerList;
    }

    /**
     * Victoria Betts
     * Search event by keyword
     * @param type $keyword
     * @return type
     */
    private function searchEvents($keyword) {
        $em = $this->getDoctrine()->getManager();
        

        $q = $em->createQuery("SELECT e "
                . "FROM \Acme\bsceneBundle\Entity\Meeting e "
                . "WHERE (e.title LIKE CONCAT('%', :keyword, '%')) OR "
                . "(e.description LIKE CONCAT('%', :keyword2, '%')) "
                . " ORDER BY e.date ASC");
        $q->setParameters(array(
                    'keyword'=>$keyword,
                    'keyword2' => $keyword));
        $searchResult = $q->getResult();

        return $searchResult;
    }

    private function searchCategories($categoryId) {
        $em = $this->getDoctrine()->getManager();

        $q = $em->createQuery("SELECT e FROM \Acme\bsceneBundle\Entity\Meeting e "
                        . "WHERE e.category = :categoryId ORDER BY e.date ASC")
                ->setParameter('categoryId', $categoryId);

        $searchResult = $q->getResult();
        return $searchResult;
    }

}
