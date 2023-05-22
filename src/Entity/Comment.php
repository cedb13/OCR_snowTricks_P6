<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idComment = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contentComment = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datePublication = null;

    #[ORM\Column]
    private ?int $user_idUser = null;

    #[ORM\Column]
    private ?int $tric_idTrick = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdComment(): ?int
    {
        return $this->idComment;
    }

    public function setIdComment(int $idComment): self
    {
        $this->idComment = $idComment;

        return $this;
    }

    public function getContentComment(): ?string
    {
        return $this->contentComment;
    }

    public function setContentComment(string $contentComment): self
    {
        $this->contentComment = $contentComment;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->datePublication;
    }

    public function setDatePublication(\DateTimeInterface $datePublication): self
    {
        $this->datePublication = $datePublication;

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

    public function getTricIdTrick(): ?int
    {
        return $this->tric_idTrick;
    }

    public function setTricIdTrick(int $tric_idTrick): self
    {
        $this->tric_idTrick = $tric_idTrick;

        return $this;
    }
}
