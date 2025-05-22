<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Catégorie')
            ->setEntityLabelInPlural('Catégories')
            ->setDateFormat('...')
            // ...
        ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Titre')->setHelp('titre de la catégorie'),
            SlugField::new('slug')
                ->setTargetFieldName('name')->setHelp('URL de la catégorie générée automatiquement'),
            TextField::new('couleur', 'Couleur')
            ->setHelp('Utilise un code hexadécimal, ex : #FF5733')
            ->setColumns(6),
            TextField::new('couleur', 'Aperçu couleur')
            ->onlyOnIndex()
            ->formatValue(fn ($value, $entity) => sprintf(
        '<span style="display:inline-block;width:20px;height:20px;background-color:%s;border-radius:50%%;"></span>',
        $value
            ))
            ->renderAsHtml(),
            ColorField::new('couleur', 'Couleur')
        ];
    }
}
