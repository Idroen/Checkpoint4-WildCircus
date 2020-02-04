<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationRepository")
 */
class Location
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
    private $adress;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Performance", mappedBy="location")
     */
    private $performance;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $map;

    public function __construct()
    {
        $this->performance = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|Performance[]
     */
    public function getPerformance(): Collection
    {
        return $this->performance;
    }

    public function addPerformance(Performance $performance): self
    {
        if (!$this->performance->contains($performance)) {
            $this->performance[] = $performance;
            $performance->setLocation($this);
        }

        return $this;
    }

    public function removePerformance(Performance $performance): self
    {
        if ($this->performance->contains($performance)) {
            $this->performance->removeElement($performance);
            // set the owning side to null (unless already changed)
            if ($performance->getLocation() === $this) {
                $performance->setLocation(null);
            }
        }

        return $this;
    }

    public function getMap(): ?string
    {
        return $this->map;
    }

    public function setMap(?string $map): self
    {
        $this->map = $map;

        return $this;
    }
}
