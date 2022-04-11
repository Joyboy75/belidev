<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 */
class Type
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity=Ged::class, inversedBy="types")
     */
    private $ged;

    /**
     * @ORM\OneToMany(targetEntity=Ged::class, mappedBy="type")
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

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
            $ged->setType($this);
        }

        return $this;
    }

    public function removeGed(Ged $ged): self
    {
        if ($this->geds->removeElement($ged)) {
            // set the owning side to null (unless already changed)
            if ($ged->getType() === $this) {
                $ged->setType(null);
            }
        }

        return $this;
    }
}
