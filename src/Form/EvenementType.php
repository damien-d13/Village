<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\Adresse;
use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label')
            ->add('description')
            ->add('date')
            ->add('created_at')
            ->add('updated_at')
            ->add('localisation')
            ->add('adresse', EntityType::class, [
                'class' => Adresse::class,
                'choice_label' => 'label'
            ])
            ->add('images', EntityType::class, [
                'class' => Image::class,
                'choice_label' => 'label',
                'required' => false,
                'multiple' => true
            ])
            
            //->add('adresse', AdresseType::class)
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
