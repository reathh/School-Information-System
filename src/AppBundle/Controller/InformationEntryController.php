<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\InformationEntry;
use AppBundle\Form\InformationEntryType;

/**
 * InformationEntry controller.
 *
 * @Route("/admin/entry")
 */
class InformationEntryController extends Controller
{
    /**
     * Creates a new InformationEntry entity.
     *
     * @Route("/new", name="entry_information_new")
     * @Method({"GET", "POST"})
     */
    public function newInformationEntryAction(Request $request)
    {
        $informationEntry = new InformationEntry();
        $form = $this->createForm('AppBundle\Form\InformationEntryType', $informationEntry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($informationEntry);
            $em->flush();

            return $this->redirectToRoute('entry_information_index');
        }
        return $this->render('informationentry/new.html.twig', array(
            'informationEntry' => $informationEntry,
            'form' => $form->createView(),
        ));
    }

    /**
     * Lists all InformationEntry entities.
     *
     * @Route("/", name="entry_information_index")
     * @Method("GET")
     */
    public function viewAllEntriesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $informationEntries = $em->getRepository('AppBundle:InformationEntry')->findAll();

        return $this->render('informationentry/index.html.twig', array(
            'informationEntries' => $informationEntries,
        ));
    }

    /**
     * Finds and displays a InformationEntry entity.
     *
     * @Route("/{id}", name="entry_information_show")
     * @Method("GET")
     */
    public function showAction(InformationEntry $informationEntry)
    {
        $deleteForm = $this->createDeleteForm($informationEntry);

        return $this->render('informationentry/show.html.twig', array(
            'informationEntry' => $informationEntry,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing InformationEntry entity.
     *
     * @Route("/{id}/edit", name="entry_information_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, InformationEntry $informationEntry)
    {
        $deleteForm = $this->createDeleteForm($informationEntry);
        $editForm = $this->createForm('AppBundle\Form\InformationEntryType', $informationEntry);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($informationEntry);
            $em->flush();

            return $this->redirectToRoute('entry_information_edit', array('id' => $informationEntry->getId()));
        }

        return $this->render('informationentry/edit.html.twig', array(
            'informationEntry' => $informationEntry,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a InformationEntry entity.
     *
     * @Route("/{id}", name="entry_information_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, InformationEntry $informationEntry)
    {
        $form = $this->createDeleteForm($informationEntry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($informationEntry);
            $em->flush();
        }

        return $this->redirectToRoute('entry_information_index');
    }

    /**
     * Creates a form to delete a InformationEntry entity.
     *
     * @param InformationEntry $informationEntry The InformationEntry entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InformationEntry $informationEntry)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('entry_information_delete', array('id' => $informationEntry->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
