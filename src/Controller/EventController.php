<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class EventController extends AbstractController
{

    #[Route('/event/{slug}', name: 'app_event', defaults: ['slug' => null])]
    public function index($slug, EventRepository $eventRepository): Response
    {

        $event = $eventRepository->findOneBySlug($slug);


        return $this->render('event/index.html.twig', [
            'event' => $event,

        ]);
    }
}
