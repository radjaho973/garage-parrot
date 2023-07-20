<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ImageCollectionRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ImageCollectionRepository::class)]
class ImageCollection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'imageCollection')]
    #[ORM\JoinColumn(onDelete:"CASCADE")]
    private ?Car $fk_car_id = null;

    #[ORM\Column(length: 255)]
    #[Groups("car:object")]
    private ?string $image_url = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFkCarId(): ?Car
    {
        return $this->fk_car_id;
    }

    public function setFkCarId(?Car $fk_car_id): static
    {
        $this->fk_car_id = $fk_car_id;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(string $image_url): static
    {
        $this->image_url = $image_url;

        return $this;
    }
}
