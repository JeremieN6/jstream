<?php

namespace App\Entity;

use App\Repository\SaisonEpisodeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SaisonEpisodeRepository::class)]
class SaisonEpisode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'saisonEpisode', targetEntity: Saison::class)]
    private Collection $saison_id;

    #[ORM\OneToMany(mappedBy: 'saisonEpisode', targetEntity: Episode::class)]
    private Collection $episode_id;

    public function __construct()
    {
        $this->saison_id = new ArrayCollection();
        $this->episode_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Saison>
     */
    public function getSaisonId(): Collection
    {
        return $this->saison_id;
    }

    public function addSaisonId(Saison $saisonId): self
    {
        if (!$this->saison_id->contains($saisonId)) {
            $this->saison_id->add($saisonId);
            $saisonId->setSaisonEpisode($this);
        }

        return $this;
    }

    public function removeSaisonId(Saison $saisonId): self
    {
        if ($this->saison_id->removeElement($saisonId)) {
            // set the owning side to null (unless already changed)
            if ($saisonId->getSaisonEpisode() === $this) {
                $saisonId->setSaisonEpisode(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Episode>
     */
    public function getEpisodeId(): Collection
    {
        return $this->episode_id;
    }

    public function addEpisodeId(Episode $episodeId): self
    {
        if (!$this->episode_id->contains($episodeId)) {
            $this->episode_id->add($episodeId);
            $episodeId->setSaisonEpisode($this);
        }

        return $this;
    }

    public function removeEpisodeId(Episode $episodeId): self
    {
        if ($this->episode_id->removeElement($episodeId)) {
            // set the owning side to null (unless already changed)
            if ($episodeId->getSaisonEpisode() === $this) {
                $episodeId->setSaisonEpisode(null);
            }
        }

        return $this;
    }
}
