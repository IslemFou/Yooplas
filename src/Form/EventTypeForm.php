<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EventTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de l\'événement',
                'attr' => [
                    'placeholder' => 'Titre de l\'événement', 
                    'class' => 'form-control col-6'
                    ]
            ])
            // ->add('slug', TextType::class, [
            //     'label' => 'Slug',
            //     'attr' => ['placeholder' => 'slug de l\'événement']
            // ])

             ->add('photo', FileType::class, [
                'label' => 'Affiche de l\'événement',
                'mapped' => false, // ← très important si le champ n’est pas directement mappé sur l’entité
                'required' => false,
                'attr' => [
                    'accept' => 'image/*',
                    'class' => 'form-control'],
    ])

            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name', // ou le champ que tu veux afficher
                'multiple' => true,
                'expanded' => false, // true = cases à cocher, false = liste déroulante multiple
                'label' => 'Catégories existantes',
                'attr' => [
                    'class' => 'form-control col-6'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['placeholder' => 'Description de l\'événement']
            ])
            ->add('date_start', DateType::class, [
                'label' => 'Date de début',
                'widget' => 'single_text',
            ])
            ->add('date_end', DateType::class, [
                'label' => 'Date de fin',
                'widget' => 'single_text',
            ])
            ->add('time_start', TimeType::class, [
                'label' => 'Heure de début',
                'widget' => 'single_text',
            ])
            ->add('time_end', TimeType::class, [
                'label' => 'Heure de fin',
                'widget' => 'single_text',
            ])
            ->add('zip_code', TextType::class, [
                'label' => 'Code postal',
                'attr' => ['placeholder' => 'Code postal de l\'événement']
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => ['placeholder' => 'Ville de l\'événement']
            ])
            ->add('country', TextType::class, [
                'label' => 'Pays',
                'attr' => ['placeholder' => 'Pays de l\'événement'] 
            ])
            ->add('price', TextType::class, [
                'label' => 'Prix de l\'événement',
                'attr' => ['placeholder' => 'Event price']
            ])

            ->add('capacity', TextType::class, [
                'label' => 'Capacité de l\'événement',
                'attr' => ['placeholder' => 'Capacité de l\'événement']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // Lier ce formulaire à l'entité Event
        $resolver->setDefaults([
            'data_class' => Event::class, // Spécifie l'entité associée
        ]);
    }
}
