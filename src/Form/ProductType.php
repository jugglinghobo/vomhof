<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType {

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
      ->add('identifier', TextType::class, [
        'label' => 'models.product.attributes.identifier'
      ])
      ->add('name', TextType::class, [
        'label' => 'models.product.attributes.name'
      ])
      ->add('price', MoneyType::class, [
        'currency' => "CHF",
        'label' => 'models.product.attributes.price'
      ])
      ->add('save', SubmitType::class, ['label' => 'actions.save']);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => Product::class,
    ]);
  }
}
