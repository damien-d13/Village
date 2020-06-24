<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Form\InformationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label')
            ->add('imageFile', FileType::class, [
                'required' => false
 
            ])
            ->add('created_at')
            ->add('illustrer', EntityType::class, [
                'class' => Evenement::class,
                'choice_label' => 'label'
                
            ])
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
