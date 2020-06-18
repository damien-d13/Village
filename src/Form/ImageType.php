<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Form\InformationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label')
            ->add('image_name')
            ->add('created_at')
            ->add('illustrer', EvenementType::class)
            ->add('information', InformationType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
