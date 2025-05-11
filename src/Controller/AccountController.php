<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig');
    }

    #[Route('/account/settings', name: 'app_account_settings')]
    public function settings(): Response
    {
        return $this->render('account/settings.html.twig');
    }
    #[Route('/account/security', name: 'app_account_security')]
    public function security(): Response
    {
        return $this->render('account/security.html.twig');
    }
    #[Route('/account/notifications', name: 'app_account_notifications')]
    public function notifications(): Response
    {
        return $this->render('account/notifications.html.twig');
    }
}
