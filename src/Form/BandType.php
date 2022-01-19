<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Band;
use App\Entity\Picture;
use App\Repository\PictureRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('membersNumber')
            ->add('style')
            ->add('urlName')
            ->add('artists', EntityType::class, [
                'class' => Artist::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('picture', EntityType::class, [
                'class' => Picture::class,
                'query_builder' => function(PictureRepository $pr){
                    return $pr->QBPictureNotUsed();
                },
                'choice_label' => 'name',
                'multiple' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Band::class,
        ]);
    }
}
