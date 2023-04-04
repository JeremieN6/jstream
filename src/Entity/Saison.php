<?php

namespace App\Entity;

use App\Repository\SaisonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SaisonRepository::class)]
class Saison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $nombre_de_saison = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numero_de_saison = null;

    #[ORM\Column(length: 125, nullable: true)]
    private ?string $image_couverture = null;

    #[ORM\ManyToOne(inversedBy: 'saisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animes $anime_id = null;

    #[ORM\ManyToOne(inversedBy: 'saison_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SaisonEpisode $saisonEpisode = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreDeSaison(): ?int
    {
        return $this->nombre_de_saison;
    }

    public function setNombreDeSaison(?int $nombre_de_saison): self
    {
        $this->nombre_de_saison = $nombre_de_saison;

        return $this;
    }

    public function getNomDeSaison(): ?string
    {
        return $this->numero_de_saison;
    }

    public function setNomDeSaison(?string $numero_de_saison): self
    {
        $this->numero_de_saison = $numero_de_saison;

        return $this;
    }

    public function getImageCouverture(): ?string
    {
        return $this->image_couverture;
    }

    public function setImageCouverture(?string $image_couverture): self
    {
        $this->image_couverture = $image_couverture;

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

    public function getSaisonEpisode(): ?SaisonEpisode
    {
        return $this->saisonEpisode;
    }

    public function setSaisonEpisode(?SaisonEpisode $saisonEpisode): self
    {
        $this->saisonEpisode = $saisonEpisode;

        return $this;
    }
}
