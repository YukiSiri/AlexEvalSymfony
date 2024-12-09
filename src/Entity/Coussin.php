<?php

namespace App\Entity;

use App\Repository\CoussinRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoussinRepository::class)]
class Coussin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Titre = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\Column]
    private ?int $Contenance = null;

    #[ORM\Column(length: 50)]
    private ?string $Matiere = null;

    #[ORM\Column(length: 50)]
    private ?string $Dimensions = null;

    #[ORM\Column]
    private ?bool $AccessoireVenduSeparement = null;

    #[ORM\Column]
    private ?int $PoidsPlein = null;

    #[ORM\ManyToOne(inversedBy: 'coussins')]
    private ?Marque $Marque = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): static
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getContenance(): ?int
    {
        return $this->Contenance;
    }

    public function setContenance(int $Contenance): static
    {
        $this->Contenance = $Contenance;

        return $this;
    }

    public function getMatiere(): ?string
    {
        return $this->Matiere;
    }

    public function setMatiere(string $Matiere): static
    {
        $this->Matiere = $Matiere;

        return $this;
    }

    public function getDimensions(): ?string
    {
        return $this->Dimensions;
    }

    public function setDimensions(string $Dimensions): static
    {
        $this->Dimensions = $Dimensions;

        return $this;
    }

    public function isAccessoireVenduSeparement(): ?bool
    {
        return $this->AccessoireVenduSeparement;
    }

    public function setAccessoireVenduSeparement(bool $AccessoireVenduSeparement): static
    {
        $this->AccessoireVenduSeparement = $AccessoireVenduSeparement;

        return $this;
    }

    public function getPoidsPlein(): ?int
    {
        return $this->PoidsPlein;
    }

    public function setPoidsPlein(int $PoidsPlein): static
    {
        $this->PoidsPlein = $PoidsPlein;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->Marque;
    }

    public function setMarque(?Marque $Marque): static
    {
        $this->Marque = $Marque;

        return $this;
    }
}
