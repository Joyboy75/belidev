<?php

namespace App\Entity;

use App\Repository\SimulationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SimulationRepository::class)
 */
class Simulation
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
    private $bdd;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $api;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $form;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user_management;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $site;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getBdd(): ?string
    {
        return $this->bdd;
    }

    public function setBdd(string $bdd): self
    {
        $this->bdd = $bdd;

        return $this;
    }

    public function getApi(): ?string
    {
        return $this->api;
    }

    public function setApi(string $api): self
    {
        $this->api = $api;

        return $this;
    }

    public function getForm(): ?string
    {
        return $this->form;
    }

    public function setForm(string $form): self
    {
        $this->form = $form;

        return $this;
    }

    public function getUserManagement(): ?string
    {
        return $this->user_management;
    }

    public function setUserManagement(string $user_management): self
    {
        $this->user_management = $user_management;

        return $this;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(string $site): self
    {
        $this->site = $site;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
