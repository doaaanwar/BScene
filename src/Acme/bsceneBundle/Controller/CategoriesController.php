<?php

namespace Acme\bsceneBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\bsceneBundle\Entity\Categories;
use Acme\bsceneBundle\Form\CategoriesType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Acme\bsceneBundle\Entity\Image;

/**
 * Categories controller.
 *
 */
class CategoriesController extends Controller
{

    /**
     * Lists all Categories entities.
     *
     */
    public function indexAction(Request $request)
    {
        //check if the admin is logged in , only member can access this page
        if($request->getSession()->get('admin') == null)
        {
           return $this->redirect($this->generateUrl('acmebscene_login'));
        }
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmebsceneBundle:Categories')->findAll();

        return $this->render('AcmebsceneBundle:Categories:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Categories entity.
     *
     */
    public function createAction(Request $request)
    {
        //check if the admin is logged in, only member can create a new category
        if($request->getSession()->get('admin') == null)
        {
           return $this->redirect($this->generateUrl('acmebscene_login'));
        }
        
        $entity = new Categories();
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $image = $request->files->get('imageCatUpload');
        if ($form->isValid()) {
            
            $imageEntity = NULL;
            //commented till finish implementation
           
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
                $form->addError(new FormError("Uploading an image is mandatory."));
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('category_show', array('id' => $entity->getId())));
        }

        return $this->render('AcmebsceneBundle:Categories:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Categories entity.
     *
     * @param Categories $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Categories $entity)
    {
        $form = $this->createForm(new CategoriesType(), $entity, array(
            'action' => $this->generateUrl('category_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Categories entity.
     *
     */
    public function newAction()
    {
        $entity = new Categories();
        $form   = $this->createCreateForm($entity);

        return $this->render('AcmebsceneBundle:Categories:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Categories entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmebsceneBundle:Categories')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categories entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmebsceneBundle:Categories:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Categories entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmebsceneBundle:Categories')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categories entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmebsceneBundle:Categories:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Categories entity.
    *
    * @param Categories $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Categories $entity)
    {
        $form = $this->createForm(new CategoriesType(), $entity, array(
            'action' => $this->generateUrl('category_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Categories entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        //check if the admin is logged in, only member can create a new category
        if($request->getSession()->get('admin') == null)
        {
           return $this->redirect($this->generateUrl('acmebscene_login'));
        }
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmebsceneBundle:Categories')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categories entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        $image = $request->files->get('imageCatUpload');
         
        if ($editForm->isValid()) {
            $imageEntity = NULL;
        
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

            $em->flush();

            return $this->redirect($this->generateUrl('category'));
        }

        return $this->render('AcmebsceneBundle:Categories:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
     /**
     * function to upload image selected by user
     * created 04.04.2015, doaa elfayoumi
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
     * Deletes a Categories entity.
     * not used no one can delete a  category
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmebsceneBundle:Categories')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Categories entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('category'));
    }
    
    
    /**
     * Creates a form to delete a Categories entity by id.
     * not used no one can delete a category
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
   
    
      private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('category_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array(
                            'label' => 'Delete Category',
                            'attr' => array('class' => 'btn btn-danger')))
                        ->getForm()
        ;
    }
}
