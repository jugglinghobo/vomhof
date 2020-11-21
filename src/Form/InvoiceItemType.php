<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Entity\InvoiceItem;
use App\Entity\Invoice;
use App\Entity\Product;

class InvoiceItemType extends AbstractType {

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
      ->add('quantity', NumberType::class, [
        'block_name' => 'invoice_item',
        'label' => false
      ])
      ->add('price', MoneyType::class, [
        'block_name' => 'invoice_item',
        'currency' => 'CHF',
        'label' => false,
      ])
      ->add('product', EntityType::class, [
        'block_name' => 'invoice_item',
        'class' => Product::class,
        'label' => false
      ])
    ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => InvoiceItem::class,
    ]);
  }
}
