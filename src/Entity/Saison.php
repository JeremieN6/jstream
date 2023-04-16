<?php

namespace App\Entity;

use App\Repository\SaisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\DBAL\Types\Types;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SaisonRepository::class)]
/**
 * @Vich\Uploadable
 */
class Saison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbrEpisodeDansLaSaison = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $featured_image = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\ManyToOne(inversedBy: 'saisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animes $anime_id = null;

    /**
     * @Vich\UploadableField(mapping="featured_images", fileNameProperty="featured_image")
     * @var File
     */
    private $imageFile;

    #[ORM\OneToMany(mappedBy: 'saison_id', targetEntity: Episode::class)]
    private Collection $episodes;

    #[ORM\OneToMany(mappedBy: 'saison_id', targetEntity: SaisonEpisodes::class)]
    private Collection $saisonEpisodes;

    #[ORM\Column(length: 175)]
    private ?string $titre_saison = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description_saison = null;

    #[ORM\Column]
    private ?int $numeroDeSaison = null;

    public function __construct()
    {
        $this->episodes = new ArrayCollection();
        $this->saisonEpisodes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrEpisodeDansLaSaison(): ?int
    {
        return $this->nbrEpisodeDansLaSaison;
    }

    public function setNbrEpisodeDansLaSaison(?int $nbrEpisodeDansLaSaison): self
    {
        $this->nbrEpisodeDansLaSaison = $nbrEpisodeDansLaSaison;

        return $this;
    }

    public function getFeaturedImage(): ?string
    {
        return $this->featured_image;
    }

    public function setFeaturedImage(?string $featured_image): self
    {
        $this->featured_image = $featured_image;

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

    public function getAnimeId(): ?Animes
    {
        return $this->anime_id;
    }

    public function setAnimeId(?Animes $anime_id): self
    {
        $this->anime_id = $anime_id;

        return $this;
    }

    /**
     * @return Collection<int, Episode>
     */
    public function getEpisodes(): Collection
    {
        return $this->episodes;
    }

    public function addEpisode(Episode $episode): self
    {
        if (!$this->episodes->contains($episode)) {
            $this->episodes->add($episode);
            $episode->setSaisonId($this);
        }

        return $this;
    }

    public function removeEpisode(Episode $episode): self
    {
        if ($this->episodes->removeElement($episode)) {
            // set the owning side to null (unless already changed)
            if ($episode->getSaisonId() === $this) {
                $episode->setSaisonId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SaisonEpisodes>
     */
    public function getSaisonEpisodes(): Collection
    {
        return $this->saisonEpisodes;
    }

    public function addSaisonEpisode(SaisonEpisodes $saisonEpisode): self
    {
        if (!$this->saisonEpisodes->contains($saisonEpisode)) {
            $this->saisonEpisodes->add($saisonEpisode);
            $saisonEpisode->setSaisonId($this);
        }

        return $this;
    }

    public function removeSaisonEpisode(SaisonEpisodes $saisonEpisode): self
    {
        if ($this->saisonEpisodes->removeElement($saisonEpisode)) {
            // set the owning side to null (unless already changed)
            if ($saisonEpisode->getSaisonId() === $this) {
                $saisonEpisode->setSaisonId(null);
            }
        }

        return $this;
    }

    public function getTitreSaison(): ?string
    {
        return $this->titre_saison;
    }

    public function setTitreSaison(string $titre_saison): self
    {
        $this->titre_saison = $titre_saison;

        return $this;
    }

    public function getDescriptionSaison(): ?string
    {
        return $this->description_saison;
    }

    public function setDescriptionSaison(?string $description_saison): self
    {
        $this->description_saison = $description_saison;

        return $this;
    }

    public function getImageFile(File $image = null)
    {
        return $this->imageFile;
    }

    public function setImageFile(File $image = null)
    {        
        $this->imageFile = $image;

         if($image) {
             $this->created_at = new \DateTime('now');
         }

    }

    public function __toString()
    {
        return $this->titre_saison;
    }

    public function getNumeroDeSaison(): ?int
    {
        return $this->numeroDeSaison;
    }

    public function setNumeroDeSaison(int $numeroDeSaison): self
    {
        $this->numeroDeSaison = $numeroDeSaison;

        return $this;
    }

}
