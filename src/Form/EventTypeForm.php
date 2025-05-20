<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EventTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Title',
                'attr' => [
                    'placeholder' => 'Enter the title of the event', 
                    'class' => 'form-control col-6'
                    ]
            ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name', // ou le champ que tu veux afficher
                'multiple' => true,
                'expanded' => false, // true = cases à cocher, false = liste déroulante multiple
                'label' => 'Catégories',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['placeholder' => 'Event description']
            ])
            ->add('date_start', DateTimeType::class, [
                'label' => 'Start Date',
                'widget' => 'single_text',
            ])
            ->add('date_end', DateTimeType::class, [
                'label' => 'End Date',
                'widget' => 'single_text',
            ])
            ->add('time_start', DateTimeType::class, [
                'label' => 'Start Time',
                'widget' => 'single_text',
            ])
            ->add('time_end', DateTimeType::class, [
                'label' => 'End Time',
                'widget' => 'single_text',
            ])
            ->add('zip_code', TextType::class, [
                'label' => 'Postal Code',
                'attr' => ['placeholder' => 'Event postal code']
            ])
            ->add('city', TextType::class, [
                'label' => 'Location',
                'attr' => ['placeholder' => 'Event location']
            ])
            ->add('country', TextType::class, [
                'label' => 'Country',
                'attr' => ['placeholder' => 'Event country']
            ])
            ->add('price', TextType::class, [
                'label' => 'Price',
                'attr' => ['placeholder' => 'Event price']
            ])
            ->add('photo', TextType::class, [
                'label' => 'Affiche de l\'événement',
                'attr' => ['placeholder' => 'Event image URL']
            ])
            ->add('slug', TextType::class, [
                'label' => 'Slug',
                'attr' => ['placeholder' => 'Event slug']
            ])
            ->add('capacity', TextType::class, [
                'label' => 'Capacity',
                'attr' => ['placeholder' => 'Event capacity']
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
