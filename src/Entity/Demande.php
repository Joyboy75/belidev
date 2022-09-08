<?php

namespace App\Entity;

use App\Repository\DemandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DemandeRepository::class)
 */
class Demande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $information_client;

    /**
     * @ORM\ManyToOne(targetEntity=Ged::class, inversedBy="demandes")
     */
    private $ged;

    /**
     * @ORM\OneToMany(targetEntity=Offre::class, mappedBy="demande")
     */
    private $offre;

    /**
     * @ORM\OneToMany(targetEntity=Ged::class, mappedBy="demande")
     */
    private $geds;

    public function __construct()
    {
        $this->offre = new ArrayCollection();
        $this->geds = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    

    public function getInformationClient(): ?string
    {
        return $this->information_client;
    }

    public function setInformationClient(string $information_client): self
    {
        $this->information_client = $information_client;

        return $this;
    }

    public function getGed(): ?Ged
    {
        return $this->ged;
    }

    public function setGed(?Ged $ged): self
    {
        $this->ged = $ged;

        return $this;
    }

    /**
     * @return Collection<int, Offre>
     */
    public function getOffre(): Collection
    {
        return $this->offre;
    }

    public function addOffre(Offre $offre): self
    {
        if (!$this->offre->contains($offre)) {
            $this->offre[] = $offre;
            $offre->setDemande($this);
        }

        return $this;
    }

    public function removeOffre(Offre $offre): self
    {
        if ($this->offre->removeElement($offre)) {
            // set the owning side to null (unless already changed)
            if ($offre->getDemande() === $this) {
                $offre->setDemande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ged>
     */
    public function getGeds(): Collection
    {
        return $this->geds;
    }

    public function addGed(Ged $ged): self
    {
        if (!$this->geds->contains($ged)) {
            $this->geds[] = $ged;
            $ged->setDemande($this);
        }

        return $this;
    }

    public function removeGed(Ged $ged): self
    {
        if ($this->geds->removeElement($ged)) {
            // set the owning side to null (unless already changed)
            if ($ged->getDemande() === $this) {
                $ged->setDemande(null);
            }
        }

        return $this;
    }

}
