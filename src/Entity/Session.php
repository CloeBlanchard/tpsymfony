<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $debut;

    #[ORM\Column(type: 'datetime')]
    private $fin;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $formateur;

    #[ORM\Column(type: 'string', length: 255)]
    private $promotion;

    #[ORM\Column(type: 'string', length: 255)]
    private $salle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(\DateTimeInterface $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(\DateTimeInterface $fin): self
    {
        $this->fin = $fin;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getFormateur(): ?string
    {
        return $this->formateur;
    }

    public function setFormateur(string $formateur): self
    {
        $this->formateur = $formateur;

        return $this;
    }

    public function getPromotion(): ?string
    {
        return $this->promotion;
    }

    public function setPromotion(string $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }

    public function getSalle(): ?string
    {
        return $this->salle;
    }

    public function setSalle(string $salle): self
    {
        $this->salle = $salle;

        return $this;
    }
}
