<?php

namespace App\Entity;

use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarqueRepository::class)]
class Marque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    /**
     * @var Collection<int, Coussin>
     */
    #[ORM\OneToMany(targetEntity: Coussin::class, mappedBy: 'Marque')]
    private Collection $coussins;

    public function __construct()
    {
        $this->coussins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

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

    /**
     * @return Collection<int, Coussin>
     */
    public function getCoussins(): Collection
    {
        return $this->coussins;
    }

    public function addCoussin(Coussin $coussin): static
    {
        if (!$this->coussins->contains($coussin)) {
            $this->coussins->add($coussin);
            $coussin->setMarque($this);
        }

        return $this;
    }

    public function removeCoussin(Coussin $coussin): static
    {
        if ($this->coussins->removeElement($coussin)) {
            // set the owning side to null (unless already changed)
            if ($coussin->getMarque() === $this) {
                $coussin->setMarque(null);
            }
        }

        return $this;
    }
}
