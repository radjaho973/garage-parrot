<?php

namespace App\Entity;

use App\Repository\WeekDayRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeekDayRepository::class)]
class WeekDay
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $day = null;

    #[ORM\OneToOne(mappedBy: 'fk_day', cascade: ['persist', 'remove'])]
    private ?OpenHours $openHours = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): static
    {
        $this->day = $day;

        return $this;
    }

    public function getOpenHours(): ?OpenHours
    {
        return $this->openHours;
    }

    public function setOpenHours(OpenHours $openHours): static
    {
        // set the owning side of the relation if necessary
        if ($openHours->getFkDay() !== $this) {
            $openHours->setFkDay($this);
        }

        $this->openHours = $openHours;

        return $this;
    }
}
