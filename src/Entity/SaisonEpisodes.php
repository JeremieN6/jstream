<?php

namespace App\Entity;

use App\Repository\SaisonEpisodesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SaisonEpisodesRepository::class)]
class SaisonEpisodes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'saisonEpisodes')]
    private ?Saison $saison_id = null;

    #[ORM\ManyToOne(inversedBy: 'saisonEpisodes')]
    private ?Episode $episode_id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSaisonId(): ?Saison
    {
        return $this->saison_id;
    }

    public function setSaisonId(?Saison $saison_id): self
    {
        $this->saison_id = $saison_id;

        return $this;
    }

    public function getEpisodeId(): ?Episode
    {
        return $this->episode_id;
    }

    public function setEpisodeId(?Episode $episode_id): self
    {
        $this->episode_id = $episode_id;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
    
}
