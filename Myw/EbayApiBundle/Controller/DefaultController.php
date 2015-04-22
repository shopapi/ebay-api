<?php

namespace Myw\EbayApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MywEbayApiBundle:Default:index.html.twig', array('name' => $name));
    }
}
