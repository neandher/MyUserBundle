<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\AdminUser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AdminUserController
 * @package AppBundle\Controller\Admin
 *
 * @Route("/user")
 */
class AdminUserController extends BaseController
{
    /**
     * @Route("/", name="admin_user_index")
     * @Method({"GET"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $pagination = $this->get('app.util.pagination')->handle($request, AdminUser::class);

        $adminUsers = $this->getDoctrine()->getRepository(AdminUser::class)->findLatest($pagination);

        return $this->render('admin/user/index.html.twig', [
            'adminUsers' => $adminUsers,
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/new", name="admin_user_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {

    }

    /**
     * @Route("/{id}/edit", requirements={"id" : "\d+"}, name="admin_user_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param AdminUser $adminUser
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, AdminUser $adminUser)
    {

    }

    /**
     * @Route("/{id}/delete", requirements={"id" : "\d+"}, name="admin_user_delete")
     * @Method("DELETE")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deletAction(Request $request)
    {

    }
}