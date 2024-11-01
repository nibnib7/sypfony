<?php

namespace App\Entity;

use App\Repository\SongRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SongRepository::class)]
class Song
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $songnumber = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $pubdate = null;

    #[ORM\ManyToOne(inversedBy: 'songs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Singer $name = null;

    #[ORM\Column]
    private ?int $minutes = null;

    #[ORM\Column]
    private ?bool $recorded = null;

    // Removed the ManyToOne relationship with Author
    // #[ORM\ManyToOne]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?Author $singer = null;

    // Removed the recorded and recorded_song attributes
    // #[ORM\Column]
    // private ?bool $recorded = null;

    // #[ORM\Column]
    // private ?bool $recorded_song = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSongnumber(): ?int
    {
        return $this->songnumber;
    }

    public function setSongnumber(int $songnumber): static
    {
        $this->songnumber = $songnumber;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getPubdate(): ?\DateTimeInterface
    {
        return $this->pubdate;
    }

    public function setPubdate(\DateTimeInterface $pubdate): static
    {
        $this->pubdate = $pubdate;

        return $this;
    }

    public function getName(): ?Singer
    {
        return $this->name;
    }

    public function setName(?Singer $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getMinutes(): ?int
    {
        return $this->minutes;
    }

    public function setMinutes(int $minutes): static
    {
        $this->minutes = $minutes;

        return $this;
    }

    public function isRecorded(): ?bool
    {
        return $this->recorded;
    }

    public function setRecorded(bool $recorded): static
    {
        $this->recorded = $recorded;

        return $this;
    }
}
