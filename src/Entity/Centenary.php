<?php

namespace App\Entity;

use App\Repository\CentenaryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

#[ORM\Entity(repositoryClass: CentenaryRepository::class)]
#[Uploadable]
class Centenary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastname;

	#[UploadableField(mapping: "news_image", fileNameProperty: "imageName", size: "imageSize")]
                  	private ?File $imageFile = null;

    #[ORM\Column(type: 'string', length: 255)]
    private $imageName;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $imageSize;

    #[ORM\Column(type: 'string', length: 255)]
    private $declaring;

    #[ORM\Column(type: 'boolean')]
    private $alive;

    #[ORM\Column(type: 'date')]
    private $dateOfBirth;

    #[ORM\ManyToOne(targetEntity: Intermunicipality::class, inversedBy: 'centenaries')]
    #[ORM\JoinColumn(nullable: false)]
    private $intermunicipality;

	#[ORM\Column(type: 'datetime_immutable')]
                  	private $updated_at;

    #[ORM\Column(type: 'text')]
    private $biography;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'centenaries')]
    private $user;

	public function getId(): ?int
                      {
                          return $this->id;
                      }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function setImageSize(?int $imageSize): self
    {
        $this->imageSize = $imageSize;

        return $this;
    }

    public function getDeclaring(): ?string
    {
        return $this->declaring;
    }

    public function setDeclaring(string $declaring): self
    {
        $this->declaring = $declaring;

        return $this;
    }

    public function isAlive(): ?bool
    {
        return $this->alive;
    }

    public function setAlive(bool $alive): self
    {
        $this->alive = $alive;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getIntermunicipality(): ?Intermunicipality
    {
        return $this->intermunicipality;
    }

    public function setIntermunicipality(?Intermunicipality $intermunicipality): self
    {
        $this->intermunicipality = $intermunicipality;

        return $this;
    }

	public function setImageFile(?File $imageFile = null): void
                  	{
                  		$this->imageFile = $imageFile;
                  
                  		if (null !== $imageFile) {
                  			$this->updated_at = new \DateTimeImmutable();
                  		}
                  	}

	public function getImageFile(): ?File
                  	{
                  		return $this->imageFile;
                  	}

	public function getUpdatedAt(): ?\DateTimeImmutable
                  	{
                  		return $this->updated_at;
                  	}

	public function setUpdatedAt(\DateTimeImmutable $updated_at): self
                  	{
                  		$this->updated_at = $updated_at;
                  
                  		return $this;
                  	}

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
