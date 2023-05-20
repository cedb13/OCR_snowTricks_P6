<?php

namespace App\Entity;

use App\Repository\TrickRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrickRepository::class)]
class Trick
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idTrick = null;

    #[ORM\Column(length: 510)]
    private ?string $nameTrick = null;

    #[ORM\Column(length: 510)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contentTrick = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $creationDate = null;

    #[ORM\Column]
    private ?int $user_idUser = null;

    #[ORM\Column]
    private ?int $group_idGroup = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $modificationDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTrick(): ?int
    {
        return $this->idTrick;
    }

    public function setIdTrick(int $idTrick): self
    {
        $this->idTrick = $idTrick;

        return $this;
    }

    public function getNameTrick(): ?string
    {
        return $this->nameTrick;
    }

    public function setNameTrick(string $nameTrick): self
    {
        $this->nameTrick = $nameTrick;

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

    public function getContentTrick(): ?string
    {
        return $this->contentTrick;
    }

    public function setContentTrick(string $contentTrick): self
    {
        $this->contentTrick = $contentTrick;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getUserIdUser(): ?int
    {
        return $this->user_idUser;
    }

    public function setUserIdUser(int $user_idUser): self
    {
        $this->user_idUser = $user_idUser;

        return $this;
    }

    public function getGroupIdGroup(): ?int
    {
        return $this->group_idGroup;
    }

    public function setGroupIdGroup(int $group_idGroup): self
    {
        $this->group_idGroup = $group_idGroup;

        return $this;
    }

    public function getModificationDate(): ?\DateTimeInterface
    {
        return $this->modificationDate;
    }

    public function setModificationDate(?\DateTimeInterface $modificationDate): self
    {
        $this->modificationDate = $modificationDate;

        return $this;
    }
}
