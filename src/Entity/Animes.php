<?php

namespace App\Entity;

use App\Repository\AnimesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: AnimesRepository::class)]
/**
 * @Vich\Uploadable
 */
class Animes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 125)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_sortie = null;

    #[ORM\Column(nullable: true)]
    private ?int $ageMax = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $featured_image = null;

    #[ORM\Column(length: 120)]
    private ?string $slug = null;

    #[ORM\OneToMany(mappedBy: 'anime_id', targetEntity: AnimeSaison::class)]
    private Collection $animeSaisons;

    #[ORM\OneToMany(mappedBy: 'anime_id', targetEntity: Saison::class)]
    private Collection $saisons;

    /**
     * @Vich\UploadableField(mapping="featured_images", fileNameProperty="featured_image")
     * @var File
     */
    private $imageFile;

    #[ORM\Column]
    private ?int $nbrDeSaisonsDansAnime = null;

    public function __construct()
    {
        $this->animeSaisons = new ArrayCollection();
        $this->saisons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getAgeMax(): ?int
    {
        return $this->ageMax;
    }

    public function setAgeMax(?int $ageMax): self
    {
        $this->ageMax = $ageMax;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, AnimeSaison>
     */
    public function getAnimeSaisons(): Collection
    {
        return $this->animeSaisons;
    }

    public function addAnimeSaison(AnimeSaison $animeSaison): self
    {
        if (!$this->animeSaisons->contains($animeSaison)) {
            $this->animeSaisons->add($animeSaison);
            $animeSaison->setAnimeId($this);
        }

        return $this;
    }

    public function removeAnimeSaison(AnimeSaison $animeSaison): self
    {
        if ($this->animeSaisons->removeElement($animeSaison)) {
            // set the owning side to null (unless already changed)
            if ($animeSaison->getAnimeId() === $this) {
                $animeSaison->setAnimeId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Saison>
     */
    public function getSaisons(): Collection
    {
        return $this->saisons;
    }

    public function addSaison(Saison $saison): self
    {
        if (!$this->saisons->contains($saison)) {
            $this->saisons->add($saison);
            $saison->setAnimeId($this);
        }

        return $this;
    }

    public function removeSaison(Saison $saison): self
    {
        if ($this->saisons->removeElement($saison)) {
            // set the owning side to null (unless already changed)
            if ($saison->getAnimeId() === $this) {
                $saison->setAnimeId(null);
            }
        }

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

    public function __toString(){

        return $this->titre;
    }

    public function getNbrDeSaisonsDansAnime(): ?int
    {
        return $this->nbrDeSaisonsDansAnime;
    }

    public function setNbrDeSaisonsDansAnime(int $nbrDeSaisonsDansAnime): self
    {
        $this->nbrDeSaisonsDansAnime = $nbrDeSaisonsDansAnime;

        return $this;
    }

}
