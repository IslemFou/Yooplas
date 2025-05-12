<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use Dom\Text;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Event::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Evenement')
            ->setEntityLabelInPlural('Evenements')
            ->setDateFormat('...')
            // ...
        ;
    }



    public function configureFields(string $pageName): iterable
    {

        $required = false;
        if ($pageName === Crud::PAGE_NEW) {
            $required = true;
        }

        return [
            TextField::new('title')->setLabel('Nom de l\'événement')
                ->setHelp('Nom de l\'événement'),
            SlugField::new('slug')
                ->setTargetFieldName('title')
                ->setLabel('URL')
                ->setHelp('URL de l\'événement générée automatiquement'),

            TextEditorField::new('description')->setLabel('Description')
                ->setHelp('Description de l\'événement'),
            ImageField::new('photo')->setLabel('Photo')
                ->setHelp('Photo de l\'événement')
                ->setUploadDir('public/uploads/events')
                //une méthode pour changer le nom de la photo
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
                ->setBasePath('uploads/events') // URL de la photo afin de l'afficher
                ->setRequired($required),

            NumberField::new('capacity')->setLabel('Capacité')
                ->setHelp('Capacité de l\'événement'),

            DateTimeField::new('date_start')->setLabel('Date de début')
                ->setHelp('Date de début de l\'événement'),
            DateTimeField::new('date_end')->setLabel('Date de fin')
                ->setHelp('Date de fin de l\'événement'),
            TimeField::new('time_start')->setLabel('Heure de début')
                ->setHelp('Heure de début de l\'événement'),
            TimeField::new('time_end')->setLabel('Heure de fin')
                ->setHelp('Heure de fin de l\'événement'),
            TextField::new('zip_code')->setLabel('Code postal')
                ->setHelp('Code postal de l\'événement'),
            TextField::new('city')->setLabel('Ville')
                ->setHelp('Ville de l\'événement'),
            TextField::new('country')->setLabel('Pays')
                ->setHelp('Pays de l\'événement'),

            NumberField::new('price')->setLabel('Prix')
                ->setHelp('Prix de l\'événement'),


            AssociationField::new('category')->setLabel('Catégorie associée')
                ->setHelp('Catégorie de l\'événement')
                ->setRequired(true)
                // ->setFormTypeOption('choice_label', 'name')

                // ->setFormTypeOption('expanded', false)
                ->setFormTypeOption('attr', [
                    'class' => 'form-control',
                    'placeholder' => 'Sélectionnez une catégorie'
                ])
                //ajouter une catégorie si elle n'existe pas
                ->setCrudController(CategoryCrudController::class)
                // ->setFormTypeOption('choice_label', 'name')
                ->autocomplete(),
        ];
    }
}
