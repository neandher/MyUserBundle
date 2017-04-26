<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\EventListener;

use AppBundle\Entity\Customer;
use AppBundle\Repository\CustomerRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class CustomerRegistrationFormSubscriber implements EventSubscriberInterface
{
    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    /**
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SUBMIT => 'preSubmit',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function preSubmit(FormEvent $event)
    {
        $rawData = $event->getData();
        $form = $event->getForm();

        /** @var Customer $data */
        $data = $form->getData();

        if (!$data instanceof Customer) {
            throw new UnexpectedTypeException($data, Customer::class);
        }

        // if email is not filled in, go on
        if (!isset($rawData['email']) || empty($rawData['email'])) {
            return;
        }

        /** @var Customer $existingCustomer */
        $existingCustomer = $this->customerRepository->findOneBy(['email' => $rawData['email']]);

        if (null === $existingCustomer || null !== $existingCustomer->getShopUser()) {
            return;
        }

        $existingCustomer->setShopUser($data->getShopUser());

        $form->setData($existingCustomer);
    }
}
