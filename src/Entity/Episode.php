<?php

namespace App\Entity;

use App\Repository\EpisodeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EpisodeRepository::class)]
class Episode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero_d_episode = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_episode = null;

    #[ORM\Column(length: 255)]
    private ?string $description_episode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $video_url = null;

    #[ORM\ManyToOne(inversedBy: 'episode_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SaisonEpisode $saisonEpisode = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroDEpisode(): ?int
    {
        return $this->numero_d_episode;
    }

    public function setNumeroDEpisode(int $numero_d_episode): self
    {
        $this->numero_d_episode = $numero_d_episode;

        return $this;
    }

    public function getTitreEpisode(): ?string
    {
        return $this->titre_episode;
    }

    public function setTitreEpisode(string $titre_episode): self
    {
        $this->titre_episode = $titre_episode;

        return $this;
    }

    public function getDescriptionEpisode(): ?string
    {
        return $this->description_episode;
    }

    public function setDescriptionEpisode(string $description_episode): self
    {
        $this->description_episode = $description_episode;

        return $this;
    }

    public function getVideoUrl(): ?string
    {
        return $this->video_url;
    }

    public function setVideoUrl(?string $video_url): self
    {
        $this->video_url = $video_url;

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
