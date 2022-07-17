<?php

namespace App\Entity;

use App\Repository\IntermunicipalityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IntermunicipalityRepository::class)]
class Intermunicipality
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'intermunicipality', targetEntity: Centenary::class)]
    private $centenaries;

    #[ORM\ManyToMany(targetEntity: Department::class, inversedBy: 'intermunicipalities')]
    private $department;

    public function __construct()
    {
        $this->centenaries = new ArrayCollection();
        $this->department = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Centenary>
     */
    public function getCentenaries(): Collection
    {
        return $this->centenaries;
    }

    public function addCentenary(Centenary $centenary): self
    {
        if (!$this->centenaries->contains($centenary)) {
            $this->centenaries[] = $centenary;
            $centenary->setIntermunicipality($this);
        }

        return $this;
    }

    public function removeCentenary(Centenary $centenary): self
    {
        if ($this->centenaries->removeElement($centenary)) {
            // set the owning side to null (unless already changed)
            if ($centenary->getIntermunicipality() === $this) {
                $centenary->setIntermunicipality(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Department>
     */
    public function getDepartment(): Collection
    {
        return $this->department;
    }

    public function addDepartment(Department $department): self
    {
        if (!$this->department->contains($department)) {
            $this->department[] = $department;
        }

        return $this;
    }

    public function removeDepartment(Department $department): self
    {
        $this->department->removeElement($department);

        return $this;
    }
}
