<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BrandRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BrandRepository::class)]
class Brand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'brand', targetEntity: Car::class)]
    private Collection $fk_car_id;

    #[ORM\Column(length: 255)]
    #[Groups("car:object")]
    private ?string $brand = null;

    public function __construct()
    {
        $this->fk_car_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Car>
     */
    public function getFkCarId(): Collection
    {
        return $this->fk_car_id;
    }

    public function addFkCarId(Car $fkCarId): static
    {
        if (!$this->fk_car_id->contains($fkCarId)) {
            $this->fk_car_id->add($fkCarId);
            $fkCarId->setBrand($this);
        }

        return $this;
    }

    public function removeFkCarId(Car $fkCarId): static
    {
        if ($this->fk_car_id->removeElement($fkCarId)) {
            // set the owning side to null (unless already changed)
            if ($fkCarId->getBrand() === $this) {
                $fkCarId->setBrand(null);
            }
        }

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }
}
