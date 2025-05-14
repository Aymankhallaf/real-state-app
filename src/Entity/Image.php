<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;


#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: Property::class, inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Property $property;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $url = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $alt = null;


    #[Vich\UploadableField(mapping: 'property_image', fileNameProperty: 'url')]
    private ?File $imageFile = null;


    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProperty(): ?Property
    {
        return $this->property;
    }

    public function setProperty(?Property $property): static
    {
        $this->property = $property;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(?string $alt): static
    {
        $this->alt = $alt;

        return $this;
    }

    public function setImageFile(?File $file = null): void
    {
        $this->imageFile = $file;

        if ($file !== null) {
            $this->updatedAt = new \DateTimeImmutable(); // Important for Doctrine to trigger update
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
    public function getWebPath(): string
    {
        return '/uploads/images/' . $this->getUrl();
    }
}
