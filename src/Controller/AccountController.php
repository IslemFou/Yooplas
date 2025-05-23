<?php

namespace App\Controller;

use App\Form\AccountTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        
         $user = $this->getUser(); // utilisateur connecté 
           $form = $this->createForm(AccountTypeForm::class, $user);
        $form->handleRequest($request);

        return $this->render('account/index.html.twig', [
            'user' => $user,
            'accountForm' => $form->createView(),
        ]);
    }


    #[Route('/account/edit', name: 'app_account_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser(); // utilisateur connecté

        $form = $this->createForm(AccountTypeForm::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Votre compte a bien été mis à jour !');
        }
        return $this->render('account/edit.html.twig',[
                'accountForm' => $form,
                'user' => $user,
        ]);
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
