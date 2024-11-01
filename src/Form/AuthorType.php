<?php

namespace App\Form;

use App\Entity\Author; // Import the Author entity
use Symfony\Component\Form\AbstractType; // Base class for form types
use Symfony\Component\Form\FormBuilderInterface; // Interface for building forms
use Symfony\Component\OptionsResolver\OptionsResolver; // To configure options for the form
use Symfony\Component\Form\Extension\Core\Type\SubmitType; // Import the SubmitType for the submit button

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username') // Adds a field for the username
            ->add('email') // Adds a field for the email
            ->add('add', SubmitType::class, ['label' => 'Add']) // Adds a submit button with the label 'Add'
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Author::class, // Associates the form with the Author entity
        ]);
    }
}
