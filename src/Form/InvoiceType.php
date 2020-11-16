<?php

namespace App\Form;

use App\Entity\Invoice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceType extends AbstractType {

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $user = $options['user'];

    $builder
      ->add('firstName', TextType::class, [
        'label' => 'models.invoice.attributes.firstName'
      ])
      ->add('lastName', TextType::class, [
        'label' => 'models.invoice.attributes.lastName'
      ])
      ->add('company', TextType::class, [
        'label' => 'models.invoice.attributes.company'
      ])
      ->add('address1', TextType::class, [
        'label' => 'models.invoice.attributes.address1'
      ])
      ->add('address2', TextType::class, [
        'label' => 'models.invoice.attributes.address2'
      ])
      ->add('zipCode', TextType::class, [
        'label' => 'models.invoice.attributes.zipCode'
      ])
      ->add('city', TextType::class, [
        'label' => 'models.invoice.attributes.city'
      ])
      ->add('phone', TextType::class, [
        'label' => 'models.invoice.attributes.phone'
      ])
      ->add('email', TextType::class, [
        'label' => 'models.invoice.attributes.email'
      ])
      ->add('paidCash', CheckboxType::class, [
        'label' => 'models.invoice.attributes.cashDiscount',
        'label_translation_parameters' => [
          "%cashDiscountPercentage%" => number_format($user->getCashDiscountPercentage(), 1).'%'
        ]
      ])
      ->add('cashDiscount', MoneyType::class, [
        'attr' => ['readonly' => true],
        'currency' => "CHF",
        'label' => 'models.invoice.attributes.cashDiscount'
      ])
      ->add('bulkDiscount', MoneyType::class, [
        'attr' => ['readonly' => true],
        'currency' => "CHF",
        'label' => 'models.invoice.attributes.bulkDiscount',
        'label_translation_parameters' => [
          "%bulkDiscountPercentage%" => number_format($user->getBulkDiscountPercentage(), 1).'%'
        ]
      ])
      ->add('bulkDiscountThreshold', HiddenType::class)
      ->add('springDiscount', MoneyType::class, [
        'attr' => ['readonly' => true],
        'currency' => "CHF",
        'label' => 'models.invoice.attributes.springDiscount',
        'label_translation_parameters' => [
          "%springDiscountPercentage%" => number_format($user->getSpringDiscountPercentage(), 1).'%'
        ]
      ])
      ->add('vatPercentage', HiddenType::class)
      ->add('vatAmount', MoneyType::class, [
        'currency' => "CHF",
        'label' => 'models.invoice.attributes.vatAmount',
        'label_translation_parameters' => [
          "%vatPercentage%" => number_format($user->getVatPercentage(), 1).'%'
        ]
      ])
      ->add('shippingCost', MoneyType::class, [
        'currency' => "CHF",
        'label' => 'models.invoice.attributes.shippingCost'
      ])
      ->add('save', SubmitType::class, ['label' => 'actions.completeInvoice']);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => Invoice::class,
       'user' => null
    ]);
  }
}
