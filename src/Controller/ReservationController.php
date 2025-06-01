<?php

namespace App\Controller;

use DateTime;
use App\Entity\Event;
use App\Entity\Reservation;
use App\Enum\ReservationStatus;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(ReservationRepository $reservationRepository): Response
    {
        $user = $this->getUser();
        $reservations = [];

        if ($user) {
            $reservations = $reservationRepository->findBy(['user' => $user]);
        }
        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    #[Route('/event/{id}/reserve', name: 'app_reservation_event', methods: ['POST'])]
    public function reserveEvent(int $id, Request $request, EntityManagerInterface $entityManager, Event $event, EventRepository $eventRepository, ReservationRepository $reservationRepository): Response
    {
        
        $user = $this->getUser(); // to get the current user, which is the standard Symfony way. // Security: Added a check to prevent the event creator from reserving their own event.
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

       // Prevent the event creator from reserving their own event
        // Ensure both $user and $event->getCreator() are valid and have getId() method
        $eventCreator = $event->getCreator();
        if (method_exists($user, 'getId') && $eventCreator && method_exists($eventCreator, 'getId')) {
            if ($user->getId() === $eventCreator?->getId()) {
                $this->addFlash('error', 'Vous ne pouvez pas réserver votre propre événement.');
            return $this->redirectToRoute('event_show', ['id' => $event->getId()]);
        }
        }

        // Check if the event is already reserved by the user
        $existingReservation = $reservationRepository->findOneBy([
            'event' => $event,
            'user' => $user,
        ]);
        if ($existingReservation) {
            $this->addFlash('error', 'You have already reserved this event.');
            return $this->redirectToRoute('event_show', ['id' => $event->getId()]);
        }

        // Get the data from the form
        $message = $request->request->get('message');

        // Create a new reservation
        $reservation = new Reservation();
        $reservation->setEvent($event);
        $reservation->setUser($user);
        $reservation->setStatus(ReservationStatus::CONFIRMED); 
        $reservation->setMessageReservation($message);
        $reservation->setDateReservation(new DateTime()); // Set the reservation date to now
        

        // Persist the reservation to the database
        $entityManager->persist($reservation);
        $entityManager->flush();

        $this->addFlash('success', 'Votre réservation a été effectuée avec succès.');
        // Redirect to the reservation list
        return $this->redirectToRoute('app_reservation');
    }

    #[Route('/reservation/show', name: 'app_reservation_show', methods: ['GET'])]
    public function showReservations(ReservationRepository $reservationRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Fetch reservations for the current user
        $reservations = $reservationRepository->findBy(['user' => $user]);

        return $this->render('reservation/show.html.twig', [
            'reservations' => $reservations,
        ]);
    }
}
