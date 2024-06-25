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
    private Collection $cree;

    /**
     * @var Collection<int, Commentaire>
     */
    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'utilisateur')]
    private Collection $poste;

    public function __construct()
    {
        $this->cree = new ArrayCollection();
        $this->poste = new ArrayCollection();
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
    public function getCree(): Collection
    {
        return $this->cree;
    }

    public function addCree(Evenement $cree): static
    {
        if (!$this->cree->contains($cree)) {
            $this->cree->add($cree);
            $cree->setUtilisateur($this);
        }

        return $this;
    }

    public function removeCree(Evenement $cree): static
    {
        if ($this->cree->removeElement($cree)) {
            // set the owning side to null (unless already changed)
            if ($cree->getUtilisateur() === $this) {
                $cree->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getPoste(): Collection
    {
        return $this->poste;
    }

    public function addPoste(Commentaire $poste): static
    {
        if (!$this->poste->contains($poste)) {
            $this->poste->add($poste);
            $poste->setUtilisateur($this);
        }

        return $this;
    }

    public function removePoste(Commentaire $poste): static
    {
        if ($this->poste->removeElement($poste)) {
            // set the owning side to null (unless already changed)
            if ($poste->getUtilisateur() === $this) {
                $poste->setUtilisateur(null);
            }
        }

        return $this;
    }
}
