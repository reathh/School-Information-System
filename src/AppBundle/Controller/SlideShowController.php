<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SlideShowController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $informationEntries = $this->getDoctrine()->getRepository('AppBundle:InformationEntry')->findAll();
        return $this->render("slideshow.html.twig", array(
            'informationEntries' => $informationEntries
        ));
    }
}
