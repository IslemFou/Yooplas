<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    //ici on a ajouté un slug pour la route afin qu'on puisse aller sur la page 
    #[Route('/category/{slug}', name: 'app_category')]


    public function index($slug, CategoryRepository $categoryRepository): Response
    {
        //On injection la dépendance CategoryRepository : une fonction qui va aller à la bdd un objet qui contient ce slug
        //1. je craie une connexion à la bdd
        //2. se connecter à la table category
        //3. faire une action sur la table category 

        // $category = $categoryRepository->findAll(); //si on veut récupérer toutes les catégories
        //$category = $categoryRepository->findOneBy(['slug' => $slug]); // ca marche aussi comme ca
        $category = $categoryRepository->findOneBySlug($slug); // on va chercher la catégorie par son slug 

        if (!$category) {
            return $this->redirectToRoute('app_home'); // si la catégorie n'existe pas, on redirige vers la page d'accueil
        }


        //dd($category); //dump and die : pour voir ce qu'il y a dans la variable $category

        return $this->render('category/index.html.twig', [
            'category' => $category,
        ]);
    }
}
