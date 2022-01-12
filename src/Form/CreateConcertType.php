<?php

namespace App\Form;

use App\Entity\Concert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateConcertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Name'
                ]
            ])
            ->add('full', HiddenType::class, [
                'attr' => [
                    'value' => false
                ]
            ])
            ->add('startTime', TextType::class, [
                'label' => 'Start time (hh:mm)',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Start time (hh:mm)'
                ]
            ])
            ->add('endTime', TextType::class, [
                'label' => 'End time (hh:mm)',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'End time (hh:mm)'
                ]
            ])
            ->add('day', DateType::class, [
                'label' => 'Day',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Day'
                ]
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Concert::class,
        ]);
    }
}
