<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    protected $configuration;

    public function __construct()
    {
       // $this->configuration = $this->get('craue_config');
    }
}