<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('firstName', TextType::class, [
            'label' => 'models.customer.attributes.firstName'
          ])
          ->add('lastName', TextType::class, [
            'label' => 'models.customer.attributes.lastName'
          ])
          ->add('company', TextType::class, [
            'label' => 'models.customer.attributes.company'
          ])
          ->add('address1', TextType::class, [
            'label' => 'models.customer.attributes.address1'
          ])
          ->add('address2', TextType::class, [
            'label' => 'models.customer.attributes.address2'
          ])
          ->add('zipCode', TextType::class, [
            'label' => 'models.customer.attributes.zipCode'
          ])
          ->add('city', TextType::class, [
            'label' => 'models.customer.attributes.city'
          ])
          ->add('phone', TextType::class, [
            'label' => 'models.customer.attributes.phone'
          ])
          ->add('email', TextType::class, [
            'label' => 'models.customer.attributes.email'
          ])
          ->add('paysCash', CheckboxType::class, [
            'label' => 'models.customer.attributes.paysCash'
          ])
          ->add('pickUp', CheckboxType::class, [
            'label' => 'models.customer.attributes.pickUp'
          ])
          ->add('save', SubmitType::class, ['label' => 'actions.save']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
