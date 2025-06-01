<?php

namespace App\Entity;

use App\Enum\Civility;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(enumType: Civility::class)]
    private ?Civility $civility = null;

    /**
     * @var Collection<int, Event>
     */
    #[ORM\OneToMany(targetEntity: Event::class, mappedBy: 'creator')]
    private Collection $UserEvents;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;


    /**
     * @var File|null
     * This property is not mapped to the database, it is used for file upload handling.
     * It should be set to null after the file is uploaded.
     */

    // Non mappé, juste pour le formulaire
    private ?File $pictureFile = null;

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): void
    {
        $this->picture = $picture;
    }

    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }

    public function setPictureFile(?File $pictureFile): void
    {
        $this->pictureFile = $pictureFile;
    }

    public function __construct()
    {
        $this->UserEvents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCivility(): ?Civility
    {
        return $this->civility;
    }

    public function setCivility(Civility $civility): static
    {
        $this->civility = $civility;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getUserEvents(): Collection
    {
        return $this->UserEvents;
    }

    public function addUserEvent(Event $userEvent): static
    {
        if (!$this->UserEvents->contains($userEvent)) {
            $this->UserEvents->add($userEvent);
            $userEvent->setCreator($this);
        }

        return $this;
    }

    public function removeUserEvent(Event $userEvent): static
    {
        if ($this->UserEvents->removeElement($userEvent)) {
            // set the owning side to null (unless already changed)
            if ($userEvent->getCreator() === $this) {
                $userEvent->setCreator(null);
            }
        }

        return $this;
    }

    // public function getPicture(): ?string
    // {
    //     return $this->picture;
    // }

    // public function setPicture(string $picture): static
    // {
    //     $this->picture = $picture;

    //     return $this;
    // }   
}
