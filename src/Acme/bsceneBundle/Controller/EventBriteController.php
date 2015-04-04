<?php

namespace Acme\bsceneBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\bsceneBundle\Entity\EventBrite;
use Acme\bsceneBundle\Form\EventBriteType;

/**
 * EventBrite controller.
 *
 */
class EventBriteController extends Controller
{

    /**
     * Lists all EventBrite entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmebsceneBundle:EventBrite')->findAll();

        return $this->render('AcmebsceneBundle:EventBrite:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new EventBrite entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new EventBrite();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('eventBrite_show', array('id' => $entity->getId())));
        }

        return $this->render('AcmebsceneBundle:EventBrite:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a EventBrite entity.
     *
     * @param EventBrite $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(EventBrite $entity)
    {
        $form = $this->createForm(new EventBriteType(), $entity, array(
            'action' => $this->generateUrl('eventBrite_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new EventBrite entity.
     *
     */
    public function newAction()
    {
        $entity = new EventBrite();
        $form   = $this->createCreateForm($entity);

        return $this->render('AcmebsceneBundle:EventBrite:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a EventBrite entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmebsceneBundle:EventBrite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventBrite entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmebsceneBundle:EventBrite:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing EventBrite entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmebsceneBundle:EventBrite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventBrite entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmebsceneBundle:EventBrite:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a EventBrite entity.
    *
    * @param EventBrite $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(EventBrite $entity)
    {
        $form = $this->createForm(new EventBriteType(), $entity, array(
            'action' => $this->generateUrl('eventBrite_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing EventBrite entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmebsceneBundle:EventBrite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventBrite entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('eventBrite_edit', array('id' => $id)));
        }

        return $this->render('AcmebsceneBundle:EventBrite:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a EventBrite entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmebsceneBundle:EventBrite')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EventBrite entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('eventBrite'));
    }

    /**
     * Creates a form to delete a EventBrite entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('eventBrite_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
