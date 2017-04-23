<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DashboardController
 * @package AppBundle\Controller\Admin
 *
 * @Route("/admin")
 */
class DashboardController extends Controller
{
    /**
     * @Route("/", name="admin_index")
     * @Route("/dahsboard", name="admin_dahsboard")
     */
    public function indexAction()
    {
        return $this->render('admin/dashboard/index.html.twig');
    }
}