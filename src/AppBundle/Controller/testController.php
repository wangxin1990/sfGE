<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\test;
use AppBundle\Form\testType;

/**
 * test controller.
 *
 * @Route("/test")
 */
class testController extends Controller
{

    /**
     * Lists all test entities.
     *
     * @Route("/", name="test")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:test')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new test entity.
     *
     * @Route("/", name="test_create")
     * @Method("POST")
     * @Template("AppBundle:test:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new test();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('test_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a test entity.
     *
     * @param test $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(test $entity)
    {
        $form = $this->createForm(new testType(), $entity, array(
            'action' => $this->generateUrl('test_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => '创建'));

        return $form;
    }

    /**
     * Displays a form to create a new test entity.
     *
     * @Route("/new", name="test_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new test();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a test entity.
     *
     * @Route("/{id}", name="test_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:test')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('找不到考试信息');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing test entity.
     *
     * @Route("/{id}/edit", name="test_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:test')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('找不到考试信息');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a test entity.
    *
    * @param test $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(test $entity)
    {
        $form = $this->createForm(new testType(), $entity, array(
            'action' => $this->generateUrl('test_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => '更新'));

        return $form;
    }
    /**
     * Edits an existing test entity.
     *
     * @Route("/{id}", name="test_update")
     * @Method("PUT")
     * @Template("AppBundle:test:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:test')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('找不到考试信息');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('test_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a test entity.
     *
     * @Route("/{id}", name="test_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:test')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('找不到考试信息');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('test'));
    }

    /**
     * Creates a form to delete a test entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('test_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => '删除'))
            ->getForm()
        ;
    }
}
