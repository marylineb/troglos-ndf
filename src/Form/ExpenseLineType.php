<?php

namespace App\Form;

use App\Entity\ExpenseLine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExpenseLineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('expenseDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de la dépense',
            ])
            ->add('expenseLabel', TextType::class, [
                'label' => 'Objet de la dépense',
            ])
            ->add('kilometers', IntegerType::class, [
                'label' => 'Km effectués',
                'required' => false,
                'empty_data' => '0',
            ])
            ->add('transportAmount', MoneyType::class, [
                'label' => 'Péages / transports',
                'required' => false,
                'currency' => 'EUR',
                'empty_data' => '0',
            ])
            ->add('otherAmount', MoneyType::class, [
                'label' => 'Autres',
                'required' => false,
                'currency' => 'EUR',
                'empty_data' => '0',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ExpenseLine::class,
        ]);
    }
}