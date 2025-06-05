<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterUserTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface, EntityManagerInterface $entityManager): Response
    {
        $user = new User; //On crée un objet de la classe Users et on le stock dans la vairiable $user

        $form = $this->createForm(RegisterUserTypeForm::class, $user);
        // On crée un formulaire en utilisant la classe RegisterUserTypeForm et on lui passe l'objet $user
        // On utilise la méthode createForm de la classe AbstractController pour créer le formulaire

        $form->handleRequest($request);
        //le mécanisme d'injection de dépendance en symfony => il s'agit de dire au symfony que je veux que tu rentre dans cette action en ambarquant avec toi l'objet $request qui est une instance stocké dans une variable 

        // Récupération de la requête 
        //// cette méthode est utilisée pour traiter les données soumises par l'utilisateur
        // Il faut que mon formulaire écoute et analyse la requete qui viens de la vue et vérifier s'il y a un post envoyé ou pas 
        // On utilise l'objet request créé par symfony et qui représente la requete HTTP entrante ( ici la requete contient des données de formulaire ) 

        if ($form->isSubmitted() && $form->isValid()) {
            // Si le formulaire est soumis et valide, on peut traiter les données
            $data = $form->getData(); // Récupération des données du formulaire
            // die('Merci pour votre soumission de formulaire !');
            // dd($data);
            // Enregistrement dans la base de données ou autre traitement

            $password = $form->get('password')->getData();
            $passwordHasher = $userPasswordHasherInterface->hashPassword($user, $password);
            $user->setPassword($passwordHasher);

            // Définir l'image de profil par défaut
            $projectDir = $this->getParameter('kernel.project_dir');
            $defaultPicturePath = $projectDir . '/public/assets/images/default-img/defaul_avatar.jpg'; // Chemin complet vers l'image par défaut

            // Vérifiez si le fichier existe avant de l'attribuer
            if (file_exists($defaultPicturePath)) {
                $defaultPicture = 'default.png'; // Nom de l'image par défaut
                $user->setPicture($defaultPicture);
            } else {
                // Gérez le cas où l'image par défaut n'existe pas
                $this->addFlash('error', 'Image de profil par défaut introuvable.');
                // Vous pouvez définir une image par défaut temporaire ou empêcher l'enregistrement de l'utilisateur
            }

            $entityManager->persist($user); // On dit à Doctrine de persister l'objet $user, c'est-à-dire de le préparer pour l'insertion dans la base de données
            $entityManager->flush(); // On envoie la requête à la base de données pour enregistrer l'utilisateur

            // return  $this->redirectToRoute('app_login');
        }

        // dd($request);
        // Handle the form submission: si l y a une soumission de formulaire on traite le formulaire et on l'enregistre dans la base de données
        //message de succès ou d'erreur 


        return $this->render('register/index.html.twig', [
            'RegisterForm' => $form->createView(),
        ]);
    }
}
