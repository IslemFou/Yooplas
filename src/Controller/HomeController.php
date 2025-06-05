<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, EventRepository $eventRepository, CategoryRepository $categoryRepository): Response
    {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login'); // ou app_login selon ta route de login
        }
        // $event = $eventRepository->findOneBySlug($slug);
        $events = $eventRepository->findAll();
        $limitedEvents = $eventRepository->findLimited(); // Récupère les 3 derniers événements
        // $event = $eventRepository->find($id);
        // $event = $eventRepository->findOneBy(['slug' => $slug]);

        $categories = $categoryRepository->findAll();

        $result = [];

        $info = null;

        if ($request->isMethod('GET')) {
            $city = trim($request->query->get('city'));
            $title = trim($request->query->get('title'));
            $anchor = trim($request->query->get('anchor'));

            if (empty($city) && empty($title)) {
                $info = ['type' => 'danger', 'message' => 'Veuillez entrer un terme de recherche.'];
            } else {
                $result = $eventRepository->searchByCityAndTitle($city, $title);

                $url = $this->generateUrl('app_home', [
                    'city' => $city,
                    'title' => $title,
                ]);

                if (!empty($anchor)) {
                    $url .= '#' . $anchor;
                }

                // return $this->redirect($url);
            }
        }
        // dd($categories);

        return $this->render('home/index.html.twig', [
            'allEvents' => $events,
            'limitedEvents' => $limitedEvents,
            'result' => $result,
            'info' => $info,
            'categories' => $categories,
            'anchor' => $anchor
        ]);
    }
}

// d'azbord récupérer mon entité event 
//entity manager
//event repository
//category repository
