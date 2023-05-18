<?php

namespace App\Entity;

use App\Repository\EpisodeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EpisodeRepository::class)]
/**
 * @Vich\Uploadable
 */
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

    #[ORM\Column(type:Types::TEXT)]
    private ?string $description_episode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $video_url = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $featured_image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $featured_video = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\ManyToOne(inversedBy: 'episodes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Saison $saison_id = null;

    #[ORM\OneToMany(mappedBy: 'episode_id', targetEntity: SaisonEpisodes::class)]
    private Collection $saisonEpisodes;

    #[ORM\Column(nullable: true)]
    private ?int $duree_episode = null;

    /**
     * @Vich\UploadableField(mapping="featured_images", fileNameProperty="featured_image")
     * @var File
     */
    private $imageFile;

    /**
     * @Vich\UploadableField(mapping="featured_videos", fileNameProperty="featured_video")
     * @var File
     */
    private $videoFile;

    public function __construct()
    {
        $this->saisonEpisodes = new ArrayCollection();
    }

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

    public function getFeaturedImage(): ?string
    {
        return $this->featured_image;
    }

    public function setFeaturedImage(?string $featured_image): self
    {
        $this->featured_image = $featured_image;

        return $this;
    }

    public function getFeaturedVideo(): ?string
    {
        return $this->featured_video;
    }

    public function setFeaturedVideo(?string $featured_video): self
    {
        $this->featured_video = $featured_video;

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

    public function getSaisonId(): ?Saison
    {
        return $this->saison_id;
    }

    public function setSaisonId(?Saison $saison_id): self
    {
        $this->saison_id = $saison_id;

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
            $saisonEpisode->setEpisodeId($this);
        }

        return $this;
    }

    public function removeSaisonEpisode(SaisonEpisodes $saisonEpisode): self
    {
        if ($this->saisonEpisodes->removeElement($saisonEpisode)) {
            // set the owning side to null (unless already changed)
            if ($saisonEpisode->getEpisodeId() === $this) {
                $saisonEpisode->setEpisodeId(null);
            }
        }

        return $this;
    }

    public function getDureeEpisode(): ?int
    {
        return $this->duree_episode;
    }

    public function setDureeEpisode(?int $duree_episode): self
    {
        $this->duree_episode = $duree_episode;

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

    public function getVideoFile(File $video = null)
    {
        return $this->videoFile;
    }

    public function setVideoFile(File $video = null)
    {        
        $this->videoFile = $video;

         if($video) {
             $this->created_at = new \DateTime('now');
         }

    }


}
