<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Infinite\FormBundle\Attachment\Attachment;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class GalleryItem extends Attachment
{
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    #[ORM\Id]
    protected ?int $id = null;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: Gallery::class, inversedBy: 'items')]
    protected ?Gallery $gallery = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string')]
    protected string $title = '';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGallery(): ?Gallery
    {
        return $this->gallery;
    }

    public function setGallery(?Gallery $gallery): void
    {
        $this->gallery = $gallery;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title !== null ? $title : '';
    }
}
