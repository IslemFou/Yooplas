<?php

namespace App\Controller\Admin;

use App\Enum\Civility;
use App\Enum\CivilityEnum;
use App\Controller\Admin\UserCrudController;
use App\Entity\Category;
use App\Entity\Event;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {

        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Yoopla');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa-solid fa-users', User::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Evenements', 'fa-solid fa-calendar-days', Event::class);
        // pour aller sur le site
        yield MenuItem::linkToUrl('Retour au site', 'fas fa-home', '/');
        
        // pour aller vers les événements de l'utilisateur connecté
        yield MenuItem::linkToRoute('Mes événements', 'fas fa-calendar-check', 'user_events');
        // pour se déconnecter
        yield MenuItem::linkToLogout('Se déconnecter', 'fas fa-sign-out-alt');

      
    ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            // ...
            ChoiceField::new('civility')
                ->setChoices([
                    'Mr' => Civility::MONSIEUR,
                    'Mrs' => Civility::MADAME,
                ]),
        ];
    }
}
