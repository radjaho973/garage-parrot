<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("car:object")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups("car:object")]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups("car:object")]
    private ?int $price = null;

    #[ORM\Column]
    #[Groups("car:object")]
    private ?int $yearPlacedInCirculation = null;

    #[ORM\Column]
    #[Groups("car:object")]
    private ?int $mileage = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'fk_car_id', targetEntity: ImageCollection::class, fetch:'EAGER')]
    #[Groups("car:object")]
    private Collection $imageCollection;

    #[ORM\OneToMany(mappedBy: 'fk_car_id', targetEntity: Options::class)]
    private Collection $options;

    #[ORM\ManyToOne(inversedBy: 'fk_car_id')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups("car:object")]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'fk_car_id')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups("car:object")]
    private ?Brand $brand = null;

    public function __construct()
    {
        $this->imageCollection = new ArrayCollection();
        $this->options = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getYearPlacedInCirculation(): ?int
    {
        return $this->yearPlacedInCirculation;
    }

    public function setYearPlacedInCirculation(int $yearPlacedInCirculation): static
    {
        $this->yearPlacedInCirculation = $yearPlacedInCirculation;

        return $this;
    }

    public function getMileage(): ?int
    {
        return $this->mileage;
    }

    public function setMileage(int $mileage): static
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, ImageCollection>
     */
    public function getImageCollection(): Collection
    {
        return $this->imageCollection;
    }

    public function addImageCollection(ImageCollection $imageCollection): static
    {
        if (!$this->imageCollection->contains($imageCollection)) {
            $this->imageCollection->add($imageCollection);
            $imageCollection->setFkCarId($this);
        }

        return $this;
    }

    public function removeImageCollection(ImageCollection $imageCollection): static
    {
        if ($this->imageCollection->removeElement($imageCollection)) {
            // set the owning side to null (unless already changed)
            if ($imageCollection->getFkCarId() === $this) {
                $imageCollection->setFkCarId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Options>
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(Options $option): static
    {
        if (!$this->options->contains($option)) {
            $this->options->add($option);
            $option->setFkCarId($this);
        }

        return $this;
    }

    public function removeOption(Options $option): static
    {
        if ($this->options->removeElement($option)) {
            // set the owning side to null (unless already changed)
            if ($option->getFkCarId() === $this) {
                $option->setFkCarId(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): static
    {
        $this->brand = $brand;

        return $this;
    }
}
