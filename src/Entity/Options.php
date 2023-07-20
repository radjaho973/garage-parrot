<?php

namespace App\Entity;

use App\Repository\OptionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OptionsRepository::class)]
class Options
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'options')]
    private ?Car $fk_car_id = null;

    #[ORM\Column(length: 255)]
    private ?string $equipement = null;

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

    public function getEquipement(): ?string
    {
        return $this->equipement;
    }

    public function setEquipement(string $equipement): static
    {
        $this->equipement = $equipement;

        return $this;
    }
}
