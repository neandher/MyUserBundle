<?php

namespace ShopBundle\Controller;

use AppBundle\Controller\BaseController;
use ShopBundle\Entity\Customer;
use ShopBundle\Entity\ShopUser;
use AppBundle\Event\FlashBagEvents;
use UserBundle\Event\UserEvents;
use ShopBundle\Form\Type\CustomerRegistrationType;
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

            $event = new GenericEvent($customer->getShopUser());
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
     * @Route("/confirm/{token}", name="shop_register_confirm")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function confirmAction(Request $request, $token)
    {
        /** @var ShopUser $shopUser */
        $shopUser = $this->getDoctrine()->getRepository(ShopUser::class)->findOneByConfirmationToken($token);

        if (!$shopUser) {
            $this->get('app.util.flash_bag')->newMessage(
                FlashBagEvents::MESSAGE_TYPE_ERROR,
                'shop.register.invalid_token'
            );

            return $this->redirectToRoute('shop_index');
        }

        $shopUser->setConfirmationToken(null)
            ->setIsEnabled(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($shopUser->getCustomer());
        $em->flush();

        $this->get('event_dispatcher')->dispatch(UserEvents::REGISTRATION_CONFIRMED, new GenericEvent($shopUser));

        $this->get('app.util.flash_bag')->newMessage(
            FlashBagEvents::MESSAGE_TYPE_SUCCESS,
            'shop.register.confirmed',
            ['username' => $shopUser->getCustomer()->getFullName()]
        );

        return $this->redirectToRoute('shop_account_dashboard');
    }
}