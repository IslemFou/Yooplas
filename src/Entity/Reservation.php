<?php

namespace App\Entity;

use App\Enum\ReservationStatus;
use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    // Relation ManyToOne avec User (celui qui a effectué la réservation)
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'id_user', referencedColumnName: 'id', nullable: false)]
    private ?User $user = null;

    // Getter et Setter pour la propriété user
    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    #[ORM\Column]
    private ?\DateTime $date_reservation = null;

    #[ORM\Column(enumType: ReservationStatus::class)]
    private ?ReservationStatus $status = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $messageReservation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateReservation(): ?\DateTime
    {
        return $this->date_reservation;
    }

    public function setDateReservation(\DateTime $date_reservation): static
    {
        $this->date_reservation = $date_reservation;

        return $this;
    }

    public function getStatus(): ?ReservationStatus
    {
        return $this->status;
    }

    public function setStatus(ReservationStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getMessageReservation(): ?string
    {
        return $this->messageReservation;
    }

    public function setMessageReservation(?string $messageReservation): static
    {
        $this->messageReservation = $messageReservation;

        return $this;
    }
}
