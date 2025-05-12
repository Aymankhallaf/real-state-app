<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PropertyRepository::class)]
class Property
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 5, max: 50)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 10, max: 1000)]
    private ?string $description = null;

    #[ORM\Column(type: Types::FLOAT, precision: 10, scale: 2)]
    #[Assert\NotBlank]
    #[Assert\Positive]
    #[Assert\Range(min: 0, max: 10000000)]
    private ?float $price = null;

    #[ORM\Column(type:Types::STRING,length: 100)]
    #[Assert\NotBlank]
    private ?string $address = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\NotBlank]
    #[Assert\Positive]
    #[Assert\Range(min: 0, max: 100)]
    #[Assert\Regex(
        pattern: '/^\d+$/',
        message: 'The number of rooms must be a positive integer.'
    )]
    private ?int $room = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\NotBlank]
    #[Assert\Positive]
    #[Assert\Range(min: 0, max: 100)]
    #[Assert\Regex(
        pattern: '/^\d+$/',
        message: 'The number of beds must be a positive integer.'
    )]
    private ?int $bed = null;

    #[ORM\Column (type: Types::FLOAT, precision: 10, scale: 2)]
    #[Assert\NotBlank]
    #[Assert\Positive]
    #[Assert\Range(min: 0, max: 10000000)]
    #[Assert\Regex(
        pattern: '/^\d+(\.\d{1,2})?$/',
        message: 'The area must be a positive number with up to two decimal places.'
    )]
    private ?float $area = null;

    #[ORM\Column(type: Types::STRING ,length: 15)]
    #[Assert\NotBlank]
    #[Assert\Choice(choices: ['Apartment', 'House', 'Townhouse', 'Garage', 'Villa', 'Office', 'Shop', 'Home', 'Building'], message: 'Choose a valid type.')]
    private ?string $type = null;

    #[ORM\Column(type: Types::STRING ,length: 10)]
    #[Assert\NotBlank]
    #[Assert\Choice(choices: ['For Rent', 'For Sale'], message: 'Choose a valid purpose.')]
    #[Assert\Length(min: 4, max: 10)]
    private ?string $purpose = null;

    #[ORM\Column(type: Types::SMALLINT, length:3 )]
    #[Assert\NotBlank]
    #[Assert\Positive]
    #[Assert\Range(min: 0, max: 100)]
    #[Assert\Regex(
        pattern: '/^\d+$/',
        message: 'The number of bathrooms must be a positive integer.'
    )]
    private ?int $bathroom = null;

    /**
     * @var Collection<int, Image>
     */
    #[ORM\OneToMany(targetEntity: Image::class, mappedBy: 'property')]
    private Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getaddress(): ?string
    {
        return $this->address;
    }

    public function setaddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getRoom(): ?int
    {
        return $this->room;
    }

    public function setRoom(int $room): static
    {
        $this->room = $room;

        return $this;
    }

    public function getBed(): ?int
    {
        return $this->bed;
    }

    public function setBed(int $bed): static
    {
        $this->bed = $bed;

        return $this;
    }

    public function getArea(): ?float
    {
        return $this->area;
    }

    public function setArea(float $area): static
    {
        $this->area = $area;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPurpose(): ?string
    {
        return $this->purpose;
    }

    public function setPurpose(string $purpose): static
    {
        $this->purpose = $purpose;

        return $this;
    }

    public function getBathroom(): ?int
    {
        return $this->bathroom;
    }

    public function setBathroom(int $bathroom): static
    {
        $this->bathroom = $bathroom;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setProperty($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getProperty() === $this) {
                $image->setProperty(null);
            }
        }

        return $this;
    }
}
