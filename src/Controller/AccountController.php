<?php

namespace App\Controller;

use App\Entity\User;

use App\Form\AccountTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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


    #[Route('/account/edit', name: 'app_account_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
 
    /** @var User $user */
    $user = $this->getUser();

    // 👉 Précharger le fichier existant si l'utilisateur a déjà une image
    if ($user->getPicture()) {
        $filePath = $this->getParameter('profile_pictures_directory') . '/' . $user->getPicture();
        if (file_exists($filePath)) {
            $user->setPictureFile(new \Symfony\Component\HttpFoundation\File\File($filePath));
        }
    }

    $form = $this->createForm(AccountTypeForm::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        /** @var UploadedFile $pictureFile */
        $pictureFile = $form->get('pictureFile')->getData();

        if ($pictureFile) {
            $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $pictureFile->guessExtension();

            $pictureFile->move(
                $this->getParameter('profile_pictures_directory'),
                $newFilename
            );

            $user->setPicture($newFilename);
        }

        $entityManager->flush();

        $this->addFlash('success', 'Votre compte a bien été mis à jour !');

        return $this->redirectToRoute('app_account');
    }

    return $this->render('account/edit.html.twig', [
        'user' => $user,
        'accountForm' => $form->createView(),
    ]);
    }

    // #[Route('/account/settings', name: 'app_account_settings')]
    // public function settings(): Response
    // {
    //     return $this->render('account/settings.html.twig');
    // }
    // #[Route('/account/security', name: 'app_account_security')]
    // public function security(): Response
    // {
    //     return $this->render('account/security.html.twig');
    // }
    // #[Route('/account/notifications', name: 'app_account_notifications')]
    // public function notifications(): Response
    // {
    //     return $this->render('account/notifications.html.twig');
    // }
}
