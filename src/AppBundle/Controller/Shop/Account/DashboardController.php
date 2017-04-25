<?php

namespace AppBundle\Controller\Shop\Account;

use AppBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class DashboardController
 * @package AppBundle\Controller\Shop\Account
 *
 * @Route("/dashboard")
 */
class DashboardController extends BaseController
{
    /**
     * @Route("/", name="shop_account_dashboard")
     */
    public function indexAction()
    {
        return $this->render('shop/account/dashboard.html.twig');
    }
}