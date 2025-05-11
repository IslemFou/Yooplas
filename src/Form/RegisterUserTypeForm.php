<?php

namespace App\Form;

use App\Entity\User;
use App\Enum\Civility;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterUserTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Votre prénom',
                'attr' => [
                    'class' => 'form-control form-control rounded-5',
                    'placeholder' => 'EX : John'
                ],
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre prénom doit avoir au minimun {{ limit }}  caractéres',
                        'max' => 30,
                        'maxMessage' => 'Votre prénom doit avoir au maximun {{ limit }}  caractéres',
                    ])
                ]
            ])



            ->add('lastName', TextType::class, [
                'label' => 'Votre nom',
                'attr' => [
                    'class' => 'form-control form-control rounded-5',
                    'placeholder' => 'EX : DUPONT'
                ],
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre nom doit avoir au minimun {{ limit }}  caractéres',
                        'max' => 30,
                        'maxMessage' => 'Votre nom doit avoir au maximun {{ limit }}  caractéres',
                    ])
                ]
            ])

            ->add('civility', EnumType::class, [
                'label' => 'Civilité',
                'class' => Civility::class,
                'choice_label' => function ($enum) {
                    return $enum->name;
                },
                // 'default_value' => Civility::MADAME,
                'attr' => [
                    'class' => 'form-control form-control rounded-5',
                    'placeholder' => 'EX : f ou h'
                ],
            ])




            ->add('email', EmailType::class, [
                'label' => 'Adresse Email',
                'attr' => [
                    'class' => 'form-control rounded-5',
                    'placeholder' => 'email@example.com'
                ],
            ])

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => true,
                'first_options' => [
                    'label' => 'Votre mot de passe',
                    'attr' => [
                        'class' => 'form-control rounded-5',
                        'placeholder' => 'John2025@',
                        'title' => 'Votre mot de passe doit contenir au minimun 8 caractéres, une majuscule, une minuscule et un caractére spécial'
                    ],
                    'constraints' => [
                        new Length([
                            'min' => 8,
                            'minMessage' => 'Votre mot de passe doit avoir au minimun {{ limit }}  caractéres',
                            'max' => 14,
                            'maxMessage' => 'Votre mot de passe doit avoir au maximun {{ limit }}  caractéres',
                        ])
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmez votre mot de passe',
                    'attr' => [
                        'class' => 'form-control form-control rounded-5',
                        'placeholder' => 'retapez votre mot de passe'
                    ]
                ]

            ])

            // ->add('confirmPassword')
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-yoopla-primary fs-5 text-center btn-lg fw-regular rounded-5 shadow m-3 col-md-6 col-sm-12 text-center'],
                'label' => 'S\'inscrire'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
