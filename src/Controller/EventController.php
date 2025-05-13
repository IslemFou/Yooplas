<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventTypeForm;
use App\Repository\EventRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

final class EventController extends AbstractController
{
    #[Route('/events', name: 'event_index')]
    public function index(EventRepository $eventRepository): Response
    {
        // if ($event) {
        // Récupère la liste de tous les événements
        $events = $eventRepository->findAll();
        // }


        // Passe la variable 'events' à la vue
        return $this->render('event/index.html.twig', [
            'events' => $events, // Cette ligne passe les événements à la vue
        ]);
    }

    #[Route('/event/{slug}', name: 'app_event', defaults: ['slug' => null])]
    public function eventSlug($slug, EventRepository $eventRepository): Response
    {
        // Récupère l'événement par son slug
        $event = $eventRepository->findOneBySlug($slug);

        // Vérifie si l'événement existe
        if (!$event) {
            throw $this->createNotFoundException('Événement non trouvé');
        }

        // Passe l'événement à la vue
        return $this->render('event/show.html.twig', [
            'event' => $event, // Change la variable pour "event" ici
        ]);
    }

    #[Route('/event/create', name: 'event_create')]
    public function create(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger, CategoryRepository $categoryRepository): Response
    {
        $event = new Event();
        $form = $this->createForm(EventTypeForm::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $user = $this->getUser(); // récupère l'utilisateur connecté

            if ($user) {
                // Set the logged-in user as the creator of the event
                $event->setCreator($user);
            } else {
                // If no user is logged in, you can handle this case appropriately, 
                // for example, by throwing an exception or redirecting the user to login
                throw $this->createAccessDeniedException('You must be logged in to create an event.');
            }


            // Récupère l'image envoyée via le formulaire
            $photo = $form->get('photo')->getData();

            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $safePhoto = $slugger->slug($originalFilename);
                $newPhoto = $safePhoto . '-' . uniqid() . '.' . $photo->guessExtension();

                try {
                    // Déplace l'image dans le répertoire défini
                    $photo->move($this->getParameter('article_directory'), $newPhoto);
                    $event->setPhoto($newPhoto);
                } catch (FileException $th) {
                    $this->addFlash('error', 'Erreur lors de l\'upload de l\'image');
                }
            }

            // Gestion des catégories
            $categories = $form->get('categories')->getData(); // Récupère les catégories sélectionnées
            foreach ($categories as $category) {
                $event->addCategory($category); // Ajoute chaque catégorie à l'événement
                $entityManager->persist($category); // Persiste les modifications de catégorie
            }

            // Génération du slug à partir du titre
            $slug = $slugger->slug($event->getTitle());
            $event->setSlug($slug . '-' . uniqid()); // Génère un slug unique pour l'événement

            // Persiste l'événement dans la base de données
            $entityManager->persist($event);
            $entityManager->flush();

            // Redirige vers la page de l'événement après création
            return $this->redirectToRoute('app_event', ['slug' => $event->getSlug()]);
        }

        // Récupère toutes les catégories pour les afficher dans le formulaire
        $categories = $categoryRepository->findAll();

        return $this->render('event/create.html.twig', [
            'form' => $form->createView(),
            'categories' => $categories, // Ajoute les catégories à la vue si nécessaire
        ]);
    }
}
