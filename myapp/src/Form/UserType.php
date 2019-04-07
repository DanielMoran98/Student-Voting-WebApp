<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('roles')
            ->add('password')
        ;
        $builder->get('roles')->addModelTransformer(new CallbackTransformer(
        function ($tagsAsArray) {
            // transform the array to a string
            return implode(', ', $tagsAsArray);
        },
        function ($tagsAsString) {
            // transform the string back to an array
            return explode(', ', $tagsAsString);
        }
    ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
