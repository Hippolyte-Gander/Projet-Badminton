<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
// ajouté pour joindre Membre
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr', type: 'string')]
#[ORM\DiscriminatorMap(['utilisateur' => Utilisateur::class, 'membre' => Membre::class])]
// fin ajout

class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $motDePasse = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    /**
     * @var Collection<int, Evenement>
     */
    #[ORM\OneToMany(targetEntity: Evenement::class, mappedBy: 'utilisateur')]
    private Collection $creer;

    /**
     * @var Collection<int, Commentaire>
     */
    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'utilisateur')]
    private Collection $poster;

    public function __construct()
    {
        $this->creer = new ArrayCollection();
        $this->poster = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
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

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): static
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection<int, Evenement>
     */
    public function getCreer(): Collection
    {
        return $this->creer;
    }

    public function addCreer(Evenement $creer): static
    {
        if (!$this->creer->contains($creer)) {
            $this->creer->add($creer);
            $creer->setUtilisateur($this);
        }

        return $this;
    }

    public function removeCreer(Evenement $creer): static
    {
        if ($this->creer->removeElement($creer)) {
            // set the owning side to null (unless already changed)
            if ($creer->getUtilisateur() === $this) {
                $creer->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getPoster(): Collection
    {
        return $this->poster;
    }

    public function addPoster(Commentaire $poster): static
    {
        if (!$this->poster->contains($poster)) {
            $this->poster->add($poster);
            $poster->setUtilisateur($this);
        }

        return $this;
    }

    public function removePoster(Commentaire $poster): static
    {
        if ($this->poster->removeElement($poster)) {
            // set the owning side to null (unless already changed)
            if ($poster->getUtilisateur() === $this) {
                $poster->setUtilisateur(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->prenom." ".$this->nom." ".$this->email;
    }

}
