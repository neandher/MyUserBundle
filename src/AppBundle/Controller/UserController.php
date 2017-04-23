<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EngineInterface
     */
    private $templatingEngine;

    /**     
     * @param FormFactoryInterface $formFactory
     * @param EngineInterface $templatingEngine
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        EngineInterface $templatingEngine
    )
    {
        $this->formFactory = $formFactory;
        $this->templatingEngine = $templatingEngine;
    }
    
//    /**
//     * @Route("/resetting/request", name="admin_security_resetting_request")
//     * @Method({"GET", "POST"})
//     *
//     * @param Request $request
//     * @return mixed
//     */
    public function resettingRequestAction(Request $request)
    {
        /*$form = $this->createForm(ResettingRequestType::class);

        $formHandler = $this->get('app.admin_resetting_request_form_handler');

        if ($formHandler->handle($form, $request)) {
            return $this->redirectToRoute('admin_security_login');
        }

        return $this->render(
            'admin/security/resetting/resettingRequest.html.twig',
            ['form' => $form->createView()]
        );*/
    }

//    /**
//     * @Route("/resetting/reset/{token}", name="admin_security_resetting_reset")
//     * @Method({"GET", "POST"})
//     *
//     * @param Request $request
//     * @param $token
//     * @return mixed
//     */
    public function resettingResetAction(Request $request, $token)
    {
        /*$manager = $this->get('app.admin_profile_manager');
        $params = $this->get('app.helper.parameters')->getParams('admin');

        $event = new ProfileEvent(null, $manager, $request);
        $event->setParams($params['security']['resetting']);

        $dispatcher = $this->get('event_dispatcher')->dispatch(
            ProfileEvents::RESETTING_RESET_INITIALIZE,
            $event
        );

        if ($request->attributes->has('error')) {
            return $this->redirectToRoute('admin_security_login');
        }

        $form = $this->createForm(ResettingResetType::class, $dispatcher->getProfile());

        $formHandler = $this->get('app.admin_resetting_reset_form_handler');

        if ($formHandler->handle($form, $request)) {
            return $this->redirectToRoute('admin_security_login');
        }

        return $this->render(
            'admin/security/resetting/resettingReset.html.twig',
            [
                'form'  => $form->createView(),
                'token' => $token
            ]
        );*/
    }

//    /**
//     * @Route("/change-password", name="admin_security_change_password")
//     * @Method({"GET", "POST"})
//     *
//     * @param Request $request
//     * @return mixed
//     */
    public function changePassword(Request $request)
    {
        /*$adminProfile = $this->getUser()->getAdminProfile();

        $form = $this->createForm(ChangePasswordType::class, $adminProfile);

        $formHandle = $this->get('app.admin_change_password_form_handler');

        if ($formHandle->handle($form, $request)) {
            return $this->redirectToRoute('admin_security_change_password');
        }

        return $this->render(
            'admin/security/changePassword/changePassword.html.twig',
            ['form' => $form->createView()]
        );*/
    }
}