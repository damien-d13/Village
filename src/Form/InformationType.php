<?php

namespace App\Form;

use App\Entity\Information;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class InformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('subtitle')
            ->add('description')
            ->add('sujet', SujetType::class)
           /* ->add('sujet', EntityType::class,[
                'class' => Sujet::class,
                'choice_label' => 'label',
                'multiple' => false
            ])*/
             /*->add('sujet', CollectionType::class, [
                'entry_type' => choiceType::class,
                
            ]) */
           /* ->add('sujet', ChoiceType::class, [
                'choice_label' => ChoiceList::label($this, 'label'),
            ]);*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Information::class,
        ]);
    }
}
