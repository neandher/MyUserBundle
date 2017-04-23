<?php

namespace AppBundle\Controller\Shop;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    /**
     * @Route("/homepage", name="shop_homepage")
     */
    public function indexAction()
    {
        return $this->render('shop/homepage/index.html.twig');
    }
}