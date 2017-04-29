<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\Customer;
use AppBundle\Event\UserEvents;
use AppBundle\Mailer\UserMailer;
use AppBundle\Util\FlashBag;
use AppBundle\Util\TokenGenerator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ShopRegisterSubscriber implements EventSubscriberInterface
{

    /**
     * @var FlashBag
     */
    private $flashBag;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * @var TokenGenerator
     */
    private $tokenGenerator;

    /**
     * @var UserMailer
     */
    private $mailer;

    /**
     * ResettingResetSubscriber constructor.
     *
     * @param FlashBag $flashBag
     * @param UrlGeneratorInterface $router
     * @param TokenGenerator $tokenGenerator
     * @param UserMailer $mailer
     */
    public function __construct(
        FlashBag $flashBag,
        UrlGeneratorInterface $router,
        TokenGenerator $tokenGenerator,
        UserMailer $mailer
    )
    {
        $this->flashBag = $flashBag;
        $this->router = $router;
        $this->tokenGenerator = $tokenGenerator;
        $this->mailer = $mailer;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        return array(
            UserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',
        );
    }

    public function onRegistrationSuccess(GenericEvent $event)
    {
        /** @var Customer $customer */
        $customer = $event->getSubject();

        $customer->getShopUser()->setIsEnabled(false);
        $customer->getShopUser()->setUsername($customer->getEmail());
        $customer->getShopUser()->setRoles(['ROLE_USER']);

        if (null === $customer->getShopUser()->getConfirmationToken()) {
            $customer->getShopUser()->setConfirmationToken($this->tokenGenerator->generateToken());
        }

        $email_params = $event->getArgument('email_params');

        $this->mailer->sendLinkWithTokenEmailMessage($customer->getShopUser(), $email_params);
    }
}