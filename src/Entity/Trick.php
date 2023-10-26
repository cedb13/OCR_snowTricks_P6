<?php

namespace App\Entity;

use App\Repository\TrickRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: TrickRepository::class)]
class Trick
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 510, unique: true)]
    #[Assert\Regex(pattern: "#^[-'a-zA-ZÀ-ÖØ-öø-ÿ0-9\(\) ]+$#", message: "Trick name must only contain letters, numbers and accented letters")]
    private ?string $name;

    #[ORM\Column(length: 510)]
    private ?string $slug;

    #[ORM\Column(length: 510)]
    private ?string $category;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ManyToOne(targetEntity: User::class, inversedBy: 'tricks')]
    #[JoinColumn(name: 'id_user')]
    private User $user;

    #[ORM\OneToMany(targetEntity: Media::class, mappedBy: 'trick', orphanRemoval: true)]
    private Collection $medias;

    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'trick', orphanRemoval: true)]
    private Collection $comments;

    public function __construct()
    {
        $this->medias = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setcategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }


    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function getMediaType(): string
    {
        foreach($this->getMedias() as $media)
        {
                return $media->getType();
        }
    }
    public function getDefaultImage(): string
    {
        foreach($this->getMedias() as $media)
        {
            return $media->getDefaultImage();
        }
    }
    public function getDefaultImageLink(): string
    {
        $link = "";

        foreach($this->getMedias() as $media)
        {
            if($media->getDefaultImage()=="1")
            {
                $link = $media->getLink();
            }
            else
            {
                $link = $this->getMedias()->first()->getLink();
            }
        }
        return $link;
    }
}
