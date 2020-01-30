<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Performance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PerformanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('synopsis')
            ->add('photo')
            ->add('category', null, ['choice_label' => 'name'])
            ->add('location', null, ['choice_label' => 'adress'])
            ->add('artists', EntityType::class, [
                'class' => Artist::class,
                'choice_label' => 'nickname',
                'expanded' => true,
                'multiple' => true,
                'by_reference' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Performance::class,
        ]);
    }
}
