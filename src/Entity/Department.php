<?php

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartmentRepository::class)]
class Department
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 3)]
    private $code;

    #[ORM\ManyToMany(targetEntity: Intermunicipality::class, mappedBy: 'department')]
    private $intermunicipalities;

    public function __construct()
    {
        $this->intermunicipalities = new ArrayCollection();
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection<int, Intermunicipality>
     */
    public function getIntermunicipalities(): Collection
    {
        return $this->intermunicipalities;
    }

    public function addIntermunicipality(Intermunicipality $intermunicipality): self
    {
        if (!$this->intermunicipalities->contains($intermunicipality)) {
            $this->intermunicipalities[] = $intermunicipality;
            $intermunicipality->addDepartment($this);
        }

        return $this;
    }

    public function removeIntermunicipality(Intermunicipality $intermunicipality): self
    {
        if ($this->intermunicipalities->removeElement($intermunicipality)) {
            $intermunicipality->removeDepartment($this);
        }

        return $this;
    }
}
