<?php

namespace Acme\bsceneBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\bsceneBundle\Entity\Speaker;
use Acme\bsceneBundle\Form\SpeakerType;

/**
 * Speaker controller.
 *
 */
class SpeakerController extends Controller
{

    /**
     * Lists all Speaker entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmebsceneBundle:Speaker')->findAll();

        return $this->render('AcmebsceneBundle:Speaker:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Speaker entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Speaker();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('speaker_show', array('id' => $entity->getId())));
        }

        return $this->render('AcmebsceneBundle:Speaker:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Speaker entity.
     *
     * @param Speaker $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Speaker $entity)
    {
        $form = $this->createForm(new SpeakerType(), $entity, array(
            'action' => $this->generateUrl('speaker_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Speaker entity.
     *
     */
    public function newAction()
    {
        $entity = new Speaker();
        $form   = $this->createCreateForm($entity);

        return $this->render('AcmebsceneBundle:Speaker:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Speaker entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmebsceneBundle:Speaker')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Speaker entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmebsceneBundle:Speaker:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Speaker entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmebsceneBundle:Speaker')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Speaker entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmebsceneBundle:Speaker:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Speaker entity.
    *
    * @param Speaker $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Speaker $entity)
    {
        $form = $this->createForm(new SpeakerType(), $entity, array(
            'action' => $this->generateUrl('speaker_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Speaker entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmebsceneBundle:Speaker')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Speaker entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('speaker_edit', array('id' => $id)));
        }

        return $this->render('AcmebsceneBundle:Speaker:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Speaker entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmebsceneBundle:Speaker')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Speaker entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('speaker'));
    }

    /**
     * Creates a form to delete a Speaker entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('speaker_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
