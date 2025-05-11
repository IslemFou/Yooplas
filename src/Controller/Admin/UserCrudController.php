<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Enum\Civility;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Utilisateur')
            ->setEntityLabelInPlural('Utilisateurs')
            ->setDateFormat('...')
            // ...
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('firstName', 'Prénom'),
            TextField::new('lastName', 'Nom'),
            EmailField::new('email', 'Email')->onlyOnIndex(),
            ChoiceField::new('roles', 'Rôle')->setChoices(
                [
                    'Utilisateur' => 'ROLE_USER',
                    'Administrateur' => 'ROLE_ADMIN'
                ]
            )->allowMultipleChoices(),
            ChoiceField::new('civility')
                ->setChoices(Civility::cases())
                ->renderAsBadges()
                ->formatValue(fn($value, $entity) => $value?->value ?? '')
        ];
    }

    // public function configureActions(Actions $actions): Actions
    // {
    //     return $actions

    //         ->remove(Crud::PAGE_INDEX, Action::NEW);
    // }
}
