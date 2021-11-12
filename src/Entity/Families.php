<?php

namespace App\Entity;

use App\Repository\FamiliesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FamiliesRepository::class)
 */
class Families
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=SubFamilies::class, mappedBy="family")
     */
    private $subfamilies;

    public function __construct()
    {
        $this->subfamilies = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|SubFamilies[]
     */
    public function getSubfamilies(): Collection
    {
        return $this->subfamilies;
    }

    public function addSubfamily(SubFamilies $subfamily): self
    {
        if (!$this->subfamilies->contains($subfamily)) {
            $this->subfamilies[] = $subfamily;
            $subfamily->setFamily($this);
        }

        return $this;
    }

    public function removeSubfamily(SubFamilies $subfamily): self
    {
        if ($this->subfamilies->removeElement($subfamily)) {
            // set the owning side to null (unless already changed)
            if ($subfamily->getFamily() === $this) {
                $subfamily->setFamily(null);
            }
        }

        return $this;
    }

    
}
