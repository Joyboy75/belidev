<?php

namespace App\Entity;

use App\Repository\DemandeRepository;
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
    private $offre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $information_client;

    /**
     * @ORM\ManyToOne(targetEntity=Ged::class, inversedBy="demandes")
     */
    private $ged;


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

    public function getOffre(): ?string
    {
        return $this->offre;
    }

    public function setOffre(string $offre): self
    {
        $this->offre = $offre;

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

}
