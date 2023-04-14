<?php

namespace App\Entity;

use App\Repository\AnimeSaisonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimeSaisonRepository::class)]
class AnimeSaison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $nombre_de_saisons = null;

    #[ORM\ManyToOne(inversedBy: 'animeSaisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animes $anime_id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_sortie = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreDeSaisons(): ?int
    {
        return $this->nombre_de_saisons;
    }

    public function setNombreDeSaisons(?int $nombre_de_saisons): self
    {
        $this->nombre_de_saisons = $nombre_de_saisons;

        return $this;
    }

    public function getAnimeId(): ?Animes
    {
        return $this->anime_id;
    }

    public function setAnimeId(?Animes $anime_id): self
    {
        $this->anime_id = $anime_id;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->date_sortie;
    }

    public function setDateSortie(?\DateTimeInterface $date_sortie): self
    {
        $this->date_sortie = $date_sortie;

        return $this;
    }
}
