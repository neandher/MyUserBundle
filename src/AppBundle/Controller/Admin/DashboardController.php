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
     * @Route("/dashboard", name="admin_dashboard")
     */
    public function indexAction()
    {
        return $this->render('admin/dashboard.html.twig');
    }
}