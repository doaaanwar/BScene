<?php

namespace Acme\bsceneBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\bsceneBundle\Entity\EventComments;
use Acme\bsceneBundle\Form\EventCommentsType;

/**
 * EventComments controller.
 *
 */
class EventCommentsController extends Controller
{

    /**
     * Lists all EventComments entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmebsceneBundle:EventComments')->findAll();

        return $this->render('AcmebsceneBundle:EventComments:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new EventComments entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new EventComments();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('eventComments_show', array('id' => $entity->getId())));
        }

        return $this->render('AcmebsceneBundle:EventComments:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a EventComments entity.
     *
     * @param EventComments $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(EventComments $entity)
    {
        $form = $this->createForm(new EventCommentsType(), $entity, array(
            'action' => $this->generateUrl('eventComments_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new EventComments entity.
     *
     */
    public function newAction()
    {
        $entity = new EventComments();
        $form   = $this->createCreateForm($entity);

        return $this->render('AcmebsceneBundle:EventComments:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a EventComments entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmebsceneBundle:EventComments')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventComments entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmebsceneBundle:EventComments:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing EventComments entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmebsceneBundle:EventComments')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventComments entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmebsceneBundle:EventComments:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a EventComments entity.
    *
    * @param EventComments $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(EventComments $entity)
    {
        $form = $this->createForm(new EventCommentsType(), $entity, array(
            'action' => $this->generateUrl('eventComments_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing EventComments entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmebsceneBundle:EventComments')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventComments entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('eventComments_edit', array('id' => $id)));
        }

        return $this->render('AcmebsceneBundle:EventComments:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a EventComments entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmebsceneBundle:EventComments')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EventComments entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('eventComments'));
    }

    /**
     * Creates a form to delete a EventComments entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('eventComments_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
