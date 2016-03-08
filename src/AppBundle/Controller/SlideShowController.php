<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SlideShowController extends BaseController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render("slideshow/slideshow.html.twig");
    }

    /**
     * @Route("/entries", name="get_entries")
     * @Method("GET")
     */
    public function getEntriesAction() {
        $informationEntries = $this->getDoctrine()->getRepository('AppBundle:InformationEntry')->findAll();
        return $this->render("slideshow/slideshow-elements-partial.html.twig", array(
            'informationEntries' => $informationEntries
        ));
    }
}
