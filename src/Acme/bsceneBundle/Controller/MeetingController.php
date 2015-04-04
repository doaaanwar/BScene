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
use Acme\bsceneBundle\Entity\EventComments;
use Acme\bsceneBundle\Entity\Venue;
use Doctrine\ORM\Query\AST\Functions\SizeFunction;
use \Symfony\Component\Form\FormError;
use \Symfony\Component\Validator\Constraints\Time;
use PHPMailer;


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

        $resultImages = array();

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
                    'image' => $resultImages,
        ));
    }

    /**
     * Lists results from keyword search.
     *
     */
    public function addCommentAction(Request $request, $id) {

        $commentEntity = new eventComments();
        $commentEntity->setUsername($request->get('commenterUsername'));
        $commentEntity->setEmail($request->get('commenterEmail'));
        $commentEntity->setComment($request->get('commenterComment'));
        $commentEntity->setCommentTime(new \DateTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($commentEntity);

        $repository = $em->getRepository('\Acme\bsceneBundle\Entity\Meeting');
        $eventEntity = $repository->find($id);
        $eventEntity->addEventComment($commentEntity);
        $commentEntity->setEvent($eventEntity);
        $em->persist($commentEntity);

        $em->flush();


        return $this->showAction($id);
    }
    
    /**
     * function used by the admin only to delete comment
     * added by doaa elfayoumi, 03.04.2015
     * 
     * @param type $id
     * @return type
     */
    public function deleteCommentAction(Request $request,$id,$commentId)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AcmebsceneBundle:EventComments')->find($commentId);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comment entity.');
        }

        $em->remove($entity);
        $em->flush();
        
        return $this->showAction($id);
    }

    /**
     * Lists results from category search
     */
    public function categorySearchAction($id) {
        $em = $this->getDoctrine()->getManager();

        $resultList = $this->searchCategories($id);
        $resultCount = \Count($resultList);
        $noResults = "";

        if ($resultCount == 0) {
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
     * updated add map api, doaa elfayoumi 25.03.2015
     * updated add upload, doaa elfayoumi 26.03.2015 
     * updated add more validation and error message, 29.03.2015
     */
    public function createAction(Request $request) {
        $entity = new Meeting();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        if ($request->getSession()->get("memberId") != null) {

            $image = $request->files->get('imageUpload');
            $imageEntity = null;


            if ($image) {
                if (($image instanceof UploadedFile) && ($image->getError() == '0')) {
                    //call upload image
                    $imageEntity = $this->uploadImage($image);
                    $entity->setImage($imageEntity);
                } else {
                    print_r($image->getError());
                    die();
                }
            } else {
                //add mantatory error
                $form->addError(new FormError("Uploading a logo is mandatory."));
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

            //venue is manadatory
            //Create venue and assign it to the event
            $placeId = $request->get('place_id');
            if ($placeId) {
                $em = $this->getDoctrine()->getEntityManager();
                $repository = $em->getRepository('\Acme\bsceneBundle\Entity\Venue');
                $venueEntity = $repository->findOneBy(array('placeId' => $placeId));

                if (!$venueEntity) {
                    $venueEntity = $this->createVenue($request);
                }
                if ($venueEntity == false) {
                    $form->addError(new FormError("Address entered is not on the range covered by this website"));
                } else {
                    $entity->setVenue($venueEntity);
                }
            } else {
                $form->addError(new FormError("Please enter the event location. It is mandatory"));
            }

            //TODO handle if the session expire
            //set the account to the logged one
            $em = $this->getDoctrine()->getManager();
            $accountId = $request->getSession()->get('memberId');
            $account = $em->getRepository('AcmebsceneBundle:Account')->findOneBy(array('id' => $accountId));
            $entity->setAccount($account);
            //set the organization to the account organization
            $entity->setOrganization($account->getOrganization());


            $matchingList = $this->getMatchingEvent($entity);

            $format = 'Y-m-d';
            $startDate = DateTime::createFromFormat($format, $entity->getDate());
            //check if the date is on the future
            if ($startDate < new \DateTime()) {
                $form->addError(new FormError("date can't be in the past."));
            } else {
                $entity->setDate(DateTime::createFromFormat($format, $entity->getDate()));
            }
            //check if the endDate is not null and format it
            if ($entity->getEndDate()) {
                $endDate = DateTime::createFromFormat($format, $entity->getEndDate());

                if ($endDate < $startDate) {
                    $form->addError(new FormError("End Date can not be before the stary date."));
                } else {
                    $entity->setEndDate(DateTime::createFromFormat($format, $entity->getEndDate()));
                }
            }


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

                //notification e-mails
                $notificationList = $this->emailNotificationList($entity->getCategory());

                foreach ($notificationList as $email) {
                    $this->sendEmailNotification($email);
                }
                
                //end notification e-mails
                //check for matching event by date and category
                if ($matchingList) {

                    //matchResults
                    return $this->render('AcmebsceneBundle:Meeting:confirmDetail.html.twig', array('id' => $entity->getId(), 'entity' => $entity,
                                'matchCount' => \count($matchingList),
                                'matchResults' => $matchingList, 'form' => $form->createView()));
                } else {

                    return $this->render('AcmebsceneBundle:Meeting:confirmDetail.html.twig', array('id' => $entity->getId(), 'entity' => $entity,
                                'matchCount' => 0,
                                'matchResults' => null, 'form' => $form->createView()));
                    // return $this->redirect($this->generateUrl('meeting_show', array('id' => $entity->getId())));
                }
            }
    }
    else {
            $form->addError(new FormError("Your session Expired. You have to login again."));
        }
        
        return $this->render('AcmebsceneBundle:Meeting:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    private function getMatchingEvent(Meeting $entity) {
        $matchingList = null;

        $em = $this->getDoctrine()->getManager();

        $q = $em->createQuery("SELECT e FROM \Acme\bsceneBundle\Entity\Meeting e "
                                . "WHERE e.category = :category and e.date = :date")
                        ->setParameter('category', $entity->getCategory())->setParameter('date', $entity->getDate());

        $matchingList = $q->getResult();

        return $matchingList;
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
    public function newAction(Request $request) {

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
        $venueList = $this->getVenue($id);
        $orgList = $this->getOrg($id);


        $venueCont = \Count($venueList);
        $orgCount = \Count($orgList);
        $commentCount = \Count($commentsList);

        $entity = $em->getRepository('AcmebsceneBundle:Meeting')->find($id);
        $relatedEventList = $this->relatedEvents($entity);
        $relatedEventCount = \Count($relatedEventList);


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meeting entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $imageEntity = $entity->getImage();
        $uploadedURL = $imageEntity->getURL();
        $speakers = $entity->getSpeakers();
        $speakerCount = \Count($speakers);
        return $this->render('AcmebsceneBundle:Meeting:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
                    'comments' => $commentsList,
                    'commentCount' => $commentCount,
                    'speaker' => $speakers,
                    'speakerCount' => $speakerCount,
                    'org' => $orgList,
                    'orgCount' => $orgCount,
                    'uploadedURL' => $uploadedURL,
                    'venue' => $venueList,
                    'venueCont' => $venueCont,
                    'relatedEvents' => $relatedEventList,
                    'relatedEventsCount' => $relatedEventCount,
        ));
    }

    /**
     * remove the generated edit function and use a manual one 
     * 
     * updated: 31.03.2015, doaa elfayoumi
     */
    /**
     * Displays a form to edit an existing Account entity.
     *
     */
    /* public function editAction($id) {
      $em = $this->getDoctrine()->getManager();

      $entity = $em->getRepository('AcmebsceneBundle:Meeting')->find($id);

      if (!$entity) {
      throw $this->createNotFoundException('Unable to find Meeting entity.');
      }

      $entity->setDate($entity->getDate()->format('y-m-d'));
      //$entity->setEndDate($entity->getEndDate()->format('yy-mm-dd'));
      $editForm = $this->createEditForm($entity);
      $deleteForm = $this->createDeleteForm($id);

      return $this->render('AcmebsceneBundle:Meeting:edit.html.twig', array(
      'entity' => $entity,
      'edit_form' => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
      ));
      } */

    /**
     * Creates a form to edit a Meeting entity.
     *
     * @param Meeting $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    /* private function createEditForm(Meeting $entity) {
      $form = $this->createForm(new MeetingType(), $entity, array(
      'action' => $this->generateUrl('meeting_update', array('id' => $entity->getId())),
      'method' => 'PUT',
      ));
      $form->add('submit', 'submit', array('label' => 'Update'));

      return $form;
      } */

    /**
     * Edits an existing Meeting entity.
     *
     */
    /* public function updateAction(Request $request, $id) {
      $em = $this->getDoctrine()->getManager();

      $entity = $em->getRepository('AcmebsceneBundle:Meeting')->find($id);

      if (!$entity) {
      throw $this->createNotFoundException('Unable to find Meeting entity.');
      }
      $entity->setDate($entity->getDate()->format('y-m-d'));
      $deleteForm = $this->createDeleteForm($id);
      $editForm = $this->createEditForm($entity);
      $editForm->handleRequest($request);

      if ($editForm->isValid()) {
      $format = 'Y-m-d';
      $entity->setDate(DateTime::createFromFormat($format, $entity->getDate()));
      //check if the endDate is not null and format it
      if ($entity->getEndDate()) {
      $entity->setEndDate(DateTime::createFromFormat($format, $entity->getEndDate()));
      }
      $em->flush();

      return $this->redirect($this->generateUrl('meeting_show', array('id' => $entity->getId(),'form' => $form->createView(),)));

      }

      return $this->render('AcmebsceneBundle:Meeting:edit.html.twig', array(
      'entity' => $entity,
      'edit_form' => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
      ));
      } */

    /**
     * remove the generated edit function and use a manual one 
     * 
     * updated: 31.03.2015, doaa elfayoumi
     * updated: 1.04.2015, doaa elfayoumi, save time, venue, speaker
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmebsceneBundle:Meeting')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meeting entity.');
        }

        $errors = array();
        $categories = $em->getRepository('AcmebsceneBundle:Categories')->findAll();
        $speakers = $entity->getSpeakers();

        $deleteForm = $this->createDeleteForm($id);
        return $this->render('AcmebsceneBundle:Meeting:editNew.html.twig', array(
                    'entity' => $entity,
                    'errors' => $errors,
                    'categories' => $categories,
                    'speakers' => $speakers,
                    'speakercount' => count($speakers),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    public function updateAction(Request $request, $id) {
        $valid = true;
        $errors = array();


        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmebsceneBundle:Meeting')->find($id);

        $format = 'Y-m-d';
        if ($request->get('date')) {
            $entity->setDate(DateTime::createFromFormat($format, $request->get('date')));
        } else {
            $valid = false;
            $errors[] = "Please fill the date. It is mandatory field";
        }
        $timeFormat = 'H:i:s';

        if ($request->get('time')) {
            $entity->setTime(DateTime::createFromFormat($timeFormat, $request->get('time')));
        } else {
            $valid = false;
            $errors[] = "Please fill the time. It is mandatory field";
        }


        if ($request->get('endDate')) {
            $entity->setEndDate(DateTime::createFromFormat($format, $request->get('endDate')));
        } else {
            $entity->setEndDate(null);
        }


        if ($request->get('endTime')) {
            $entity->setEndTime(DateTime::createFromFormat($timeFormat, $request->get('endTime')));
        } else {
            $entity->setEndTime(null);
        }


        if ($request->get('autocomplete')) {
            //TODO create external function for creating venue
            $placeId = $request->get('place_id');
            if ($placeId) {

                $repository = $em->getRepository('\Acme\bsceneBundle\Entity\Venue');
                $venueEntity = $repository->findOneBy(array('placeId' => $placeId));
                if (!$venueEntity) {
                    //call function to create venue
                    $venueEntity = $this->createVenue($request);
                }
                $entity->setVenue($venueEntity);
            }
        } else {
            $venue = $em->getRepository('AcmebsceneBundle:Venue')->find($request->get('venueId'));
            $entity->setVenue($venue);
        }




        //upload and save new image
        $image = $request->files->get('imageUpload2');

        $imageEntity = null;


        if ($image) {
            if (($image instanceof UploadedFile) && ($image->getError() == '0')) {
                //call upload image
                $imageEntity = $this->uploadImage($image);
                $entity->setImage($imageEntity);
            } else {
                print_r($image->getError());
                die();
            }
        }

        $entity->setTitle($request->get('title'));
        $entity->setCapacity($request->get('capacity'));

        $categoryName = $request->get('category');
        $category = $em->getRepository('AcmebsceneBundle:Categories')->findOneBy(array('name' => $categoryName));

        $entity->setCategory($category);

        //update speaker with new ones
        for ($i = 1; $i <= 5; $i++) {
            if ($request->get('nameTextbox' . $i) != "") {
                //create new speaker
                $speakerEntity = new Speaker();
                $speakerEntity->setName($request->get('nameTextbox' . $i));
                $speakerEntity->setTitle($request->get('titleTextbox' . $i));
                $speakerEntity->setBiography($request->get('bioTextbox' . $i));
                $speakerEntity->addEvent($entity);
                $em = $this->getDoctrine()->getManager();
                $em->persist($speakerEntity);
                $em->flush();
                $entity->addSpeaker($speakerEntity);
            }
        }


        $entity->setDescription($request->get('description'));


        //TODO check matching event
        if ($valid) {
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('meeting_show', array('id' => $entity->getId())));
        }
        return $this->render('AcmebsceneBundle:Meeting:editNew.html.twig', array(
                    'entity' => $entity,
                    'errors' => $errors,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * function to create new venue
     * created 01.04.2015, doaa elfayoumi
     * @param Request $request
     * @return Venue
     */
    private function createVenue(Request $request) {
        //the format for the lat lng is (43.4433963, -80.52255709999997)
        //split it to get each value
        $em = $this->getDoctrine()->getManager();
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
        if ($cityEntity) {
            $venueEntity->setCity($cityEntity);
        } else {
            //TODO the city constraint
            return false;
        }

        //get the province
        $provinceName = $request->get('administrative_area_level_1');

        $repository = $em->getRepository('\Acme\bsceneBundle\Entity\Province');
        $provinceEntity = $repository->findOneBy(array('name' => $provinceName));
        if ($provinceEntity) {
            $venueEntity->setProvince($provinceEntity);
        } else {
            //TODO the city constraint
            return false;
        }
        //TODO put the province constraint



        $venueEntity->setPlaceId($request->get('place_id'));
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
        return $venueEntity;
    }

    /**
     * function to upload image selected by user
     * created 01.04.2015, doaa elfayoumi
     * @param UploadedFile $image
     */
    private function uploadImage(UploadedFile $image) {
        $imageEntity = NULL;
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
            //set the URL/path
            $imageEntity->setURL($imageEntity->getWebPath());
            $em = $this->getDoctrine()->getManager();
            $em->persist($imageEntity);
            $em->flush();
            return $imageEntity;
        } else {
            print_r("Invalid file type");
            die();
        }
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
    private function relatedEvents(Meeting $entity) {
        //$currentDate = new \DateTime();
        $em = $this->getDoctrine()->getEntityManager();

        //To get the events with the same category and date  
        $q = $em->createQuery("SELECT e FROM \Acme\bsceneBundle\Entity\Meeting e "
                                . "WHERE e.category = :category OR e.date = :date")
                        ->setParameter('category', $entity->getCategory())->setParameter('date', $entity->getDate());

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


        $q = $em->createQuery("SELECT e, o, s, i "
                . "FROM \Acme\bsceneBundle\Entity\Meeting e "
                . "LEFT JOIN e.organization o "
                . "LEFT JOIN e.speakers s "
                . "LEFT JOIN e.image i "
                . "WHERE ((e.title LIKE CONCAT('%', :keyword, '%')) OR "
                . "(e.description LIKE CONCAT('%', :keyword2, '%')) OR "
                . "(o.name LIKE CONCAT('%', :keyword3, '%')) OR "
                . "(s.name LIKE CONCAT('%', :keyword4, '%')))"
                . " ORDER BY e.date ASC");
        $q->setParameters(array(
            'keyword' => $keyword,
            'keyword2' => $keyword,
            'keyword3' => $keyword,
            'keyword4' => $keyword,
        ));
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

    /**
     * the search by date function given a date
     * @param date $searchDate
     * @return searchResult list
     */
    private function searchByDate($searchDate) {
        $em = $this->getDoctrine()->getManager();

        $q = $em->createQuery("SELECT e FROM \Acme\bsceneBundle\Entity\Meeting e "
                        . "WHERE e.date = :searchDate ORDER BY e.title ASC")
                ->setParameter('searchDate', $searchDate);

        $searchResult = $q->getResult();
        return $searchResult;
    }

    /**
     * Lists results from category search
     */
    public function dateSearchAction($day) {
        $em = $this->getDoctrine()->getManager();

        $resultList = $this->searchByDate($day);
        $resultCount = \Count($resultList);
        $noResults = "";

        if ($resultCount == 0) {
            $noResults = "There are no events on that day. Please peak another day from the calender.";
        }

        return $this->render('AcmebsceneBundle:Meeting:index.html.twig', array(
                    'searchResults' => $resultList,
                    'resultCount' => $resultCount,
                    'noResults' => $noResults,
        ));
    }

    /*
     * Get list of user subscribers for category
     */

    private function emailNotificationList(\Acme\bsceneBundle\Entity\Categories $entity) {
        
        $em = $this->getDoctrine()->getManager();
        
        $categoryId = $entity -> getId();

        $q = $em->createQuery("SELECT a, c "
                . "FROM \Acme\bsceneBundle\Entity\Account a "
                        . "LEFT JOIN a.categories c "
                        . "WHERE c.id = :categoryId")
                ->setParameter('categoryId', $categoryId);

        $result = $q->getArrayResult();

        $emailArray = array();

        for ($i = 0; $i <= \Count($result) - 1; $i++) {

            $emailAddress = $result[$i]['email'];
            $emailArray[] = $emailAddress;
        }

        return $emailArray;
    }

    /*
     * Send e-mail to subscribers
     */

    private function sendEmailNotification($userEmail) {

        $options = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        //TODO replace values with the account value

        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com;';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'bscenenetwork@gmail.com';                 // SMTP username
        $mail->Password = 'sustento';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->From = 'bscenenetwork@gmail.com';
        $mail->FromName = 'Mailer';
        $mail->addAddress($userEmail);     // Add a recipient



        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'New event on B-Scene';
        $mail->Body = 'There is a new event in a B-Scene category to which you have subscribed! Visit B-Scene to see all event postings. <br>'
                . 'You may change your subscription preferences from your B-Scene profile.<br><br>'
                . 'Thanks for your interest!<br>'
                . 'B-Scene';
        $mail->AltBody = 'There is a new event in a B-Scene category to which you have subscribed! Visit B-Scene to see all event postings. '
                . 'You may change your subscription preferences from your B-Scene profile.'
                . ' Thanks for your interest! - B-Scene';

        $mail->smtpConnect($options);

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

}
