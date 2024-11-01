<?php

namespace App\Form;

use App\Entity\Singer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Entity\Song;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SongType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('songnumber')
            ->add('title')
            ->add('pubdate')
            ->add('minutes')
            ->add('recorded')
            ->add('name', EntityType::class, [
                'class' => Singer::class,
                'choice_label' => 'id',
                'expanded' => true, 
                'multiple' => false,

            ]);
            
            }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Song::class,
        ]);
    }


    
}
