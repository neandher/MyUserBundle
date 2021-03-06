<?php

namespace ShopBundle\Form\Type;

use ShopBundle\Entity\Customer;
use ShopBundle\EventListener\CustomerRegistrationFormSubscriber;
use UserBundle\Form\Type\PlainPasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerRegistrationType extends PlainPasswordType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'shop.customers.form.first_name',
            ])
            ->add('lastName', TextType::class, [
                'label' => 'shop.customers.form.last_name',
            ])
            ->add('phoneNumber', TextType::class, [
                'required' => false,
                'label' => 'shop.customers.form.phone_number',
            ])
            ->add('isSubscribedToNewsletter', CheckboxType::class, [
                'required' => false,
                'label' => 'shop.customers.form.subscribed_to_newsletter',
            ])
            ->add('email', EmailType::class, ['label' => 'shop.customers.form.email'])
            ->add('shopUser', ShopUserRegistrationType::class, [
                'label' => false,
            ])
            ->addEventSubscriber(new CustomerRegistrationFormSubscriber($options['repository']))
            ->setDataLocked(false);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Customer::class,
                'validation_groups' => ['Default', 'creating'],
                'repository' => null
            ]
        );
    }

}