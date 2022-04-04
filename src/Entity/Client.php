<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    

    /**
     * @ORM\Column(type="integer")
     */
    private $siret;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer")
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $raisonsociale;

    /**
     * @ORM\OneToMany(targetEntity=Ged::class, mappedBy="client")
     */
    private $geds;

    public function __construct()
    {
        $this->geds = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    

    public function getSiret(): ?int
    {
        return $this->siret;
    }

    public function setSiret(int $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(int $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

   

    public function getRaisonsociale(): ?string
    {
        return $this->raisonsociale;
    }

    public function setRaisonsociale(string $raisonsociale): self
    {
        $this->raisonsociale = $raisonsociale;

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
            $ged->setClient($this);
        }

        return $this;
    }

    public function removeGed(Ged $ged): self
    {
        if ($this->geds->removeElement($ged)) {
            // set the owning side to null (unless already changed)
            if ($ged->getClient() === $this) {
                $ged->setClient(null);
            }
        }

        return $this;
    }

    
}
