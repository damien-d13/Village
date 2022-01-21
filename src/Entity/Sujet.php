<?php

namespace App\Entity;

use App\Repository\SujetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=SujetRepository::class)
 * @UniqueEntity("label")
 */
class Sujet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity=Information::class, mappedBy="sujet")
     */
    private $attribuer;

    public function __construct()
    {
        $this->attribuer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|Information[]
     */
    public function getAttribuer(): Collection
    {
        return $this->attribuer;
    }

    public function addAttribuer(Information $attribuer): self
    {
        if (!$this->attribuer->contains($attribuer)) {
            $this->attribuer[] = $attribuer;
            $attribuer->setSujet($this);
        }

        return $this;
    }

    public function removeAttribuer(Information $attribuer): self
    {
        if ($this->attribuer->contains($attribuer)) {
            $this->attribuer->removeElement($attribuer);
            // set the owning side to null (unless already changed)
            if ($attribuer->getSujet() === $this) {
                $attribuer->setSujet(null);
            }
        }

        return $this;
    }
}
