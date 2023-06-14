<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', null, [
                'disabled' => $options['is_edit'],
                'label' => 'Nom / Prénom',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('pseudo', null, [
                'disabled' => $options['is_edit'],
                'label' => 'Pseudo (facultatif)',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('email', EmailType::class, [
                'disabled' => $options['is_edit'],
                'label' => 'E-mail',
                'attr' => ['class' => 'form-control'],
            ]);

        if ($options['password_enabled']) {
            $builder->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent correspondre.',
                'options' => ['attr' => ['class' => 'password-field form-control']],
                'required' => true,
                'first_options' => ['label' => 'Mot de passe',
                    'attr' => [
                        'class' => 'form-control',
                        'autocomplete' => 'Nouveau mot de passe']],
                'second_options' => ['label' => 'Confirmer le mot de passe',
                    'attr' => [
                        'class' => 'form-control',
                        'autocomplete' => 'new-password']],
            ]);
        }

        $builder
            ->add('roles', ChoiceType::class, [
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'Admin' => 'ROLE_ADMIN',
                ],
                'label' => 'Roles de l\'utilisateur',
                'attr' => ['class' => 'form-control'],
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'password_enabled' => false,
            'is_edit' => false,
        ]);
    }
}
