<?php

namespace App\Form;

use App\Entity\ExpenseReport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Count;

class ExpenseReportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('requesterName', TextType::class, [
                'label' => 'Nom du demandeur',
            ])
            ->add('requestDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de la demande',
            ])
            ->add('expenseReason', TextareaType::class, [
                'label' => 'Raison de la dépense',
            ])
            ->add('budget', ChoiceType::class, [
                'label' => 'Budget',
                'choices' => [
                    'Administratif' => 'Administratif',
                    'Matériel' => 'Matériel',
                    'Sortie' => 'Sortie',
                    'Autre' => 'Autre',
                ],
            ])
            ->add('mileageRate', MoneyType::class, [
                'label' => 'Barème kilométrique',
                'currency' => 'EUR',
                'scale' => 3,
            ])
            ->add('donationAmount', MoneyType::class, [
                'label' => 'Montant abandonné',
                'required' => false,
                'currency' => 'EUR',
                'empty_data' => '0',
            ])
            ->add('iban', TextType::class, [
                'label' => 'IBAN',
            ])
            ->add('bic', TextType::class, [
                'label' => 'BIC',
            ])
            ->add('signatureName', TextType::class, [
                'label' => 'Signature du demandeur',
            ])
            ->add('lines', CollectionType::class, [
                'entry_type' => ExpenseLineType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'label' => false,
            ])
            ->add('supportingDocuments', FileType::class, [
                'label' => 'Justificatifs',
                'mapped' => false,
                'multiple' => true,
                'constraints' => [
                    new Count(min: 1, minMessage: 'Ajoute au moins un justificatif.'),
                    new File(
                        maxSize: '10M',
                        mimeTypes: [
                            'application/pdf',
                            'image/jpeg',
                            'image/png',
                            'image/webp',
                        ],
                        mimeTypesMessage: 'Formats autorisés : PDF, JPG, PNG, WEBP.'
                    ),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ExpenseReport::class,
        ]);
    }
}