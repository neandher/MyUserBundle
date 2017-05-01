<?php

namespace ShopBundle\EventListener;

use ShopBundle\Entity\Customer;
use ShopBundle\Repository\CustomerRepository;
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
