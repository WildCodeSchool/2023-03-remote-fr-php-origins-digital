<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountFormType extends UserType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Utilise le formulaire parent (UserType)
        parent::buildForm($builder, $options);

        $builder->remove('roles');
        $builder
            ->add('fullName', null, [
                'disabled' => false,
                'label' => 'Nom / Prénom*',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('pseudo', null, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Pseudo (facultatif)',
                ])
            ->add('email', EmailType::class, [
                'disabled' => false,
                'label' => 'E-mail*',
                'attr' => ['class' => 'form-control'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'password_enabled' => false,
            'is_edit' => true,
        ]);
    }
}
