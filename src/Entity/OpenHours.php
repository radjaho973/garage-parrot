<?php

namespace App\Entity;

use App\Repository\OpenHoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpenHoursRepository::class)]
class OpenHours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'openHours', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?WeekDay $fk_day = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $start_time = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $end_time = null;

    #[ORM\Column]
    private ?bool $is_closed = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFkDay(): ?WeekDay
    {
        return $this->fk_day;
    }

    public function setFkDay(WeekDay $fk_day): static
    {
        $this->fk_day = $fk_day;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->start_time;
    }

    public function setStartTime(\DateTimeInterface $start_time): static
    {
        $this->start_time = $start_time;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->end_time;
    }

    public function setEndTime(\DateTimeInterface $end_time): static
    {
        $this->end_time = $end_time;

        return $this;
    }

    public function isIsClosed(): ?bool
    {
        return $this->is_closed;
    }

    public function setIsClosed(bool $is_closed): static
    {
        $this->is_closed = $is_closed;

        return $this;
    }
}
