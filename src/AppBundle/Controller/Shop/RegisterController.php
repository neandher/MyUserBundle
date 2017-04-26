<?php

namespace AppBundle\Controller\Shop;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\Customer;
use AppBundle\Event\FlashBagEvents;
use AppBundle\Event\UserEvents;
use AppBundle\Form\Type\Customer\CustomerRegistrationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RegisterController
 * @package AppBundle\Controller\Shop
 *
 * @Route("/register")
 */
class RegisterController extends BaseController
{
    /**
     * @Route("/", name="shop_register")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerRegistrationType::class, $customer, [
            'repository' => $this->getDoctrine()->getRepository(Customer::class)
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $event = new GenericEvent($customer);
            $event->setArgument('email_params', $this->getParameter('shop_register_email'));

            $this->get('event_dispatcher')->dispatch(UserEvents::REGISTRATION_SUCCESS, $event);

            $this->get('app.util.flash_bag')->newMessage(
                FlashBagEvents::MESSAGE_TYPE_SUCCESS,
                'shop.register.success_flash'
            );

            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();

            return $this->redirectToRoute('shop_account_dashboard');
        }

        return $this->render('shop/account/register/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param $token
     *
     * @Route("/confirm", name="shop_register_confirm")
     */
    public function confirmAction(Request $request, $token)
    {

    }
}