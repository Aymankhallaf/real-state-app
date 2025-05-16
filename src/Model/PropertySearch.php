<?php

namespace App;

use App\Entity\PropertyType;

class PropertySearch
{
    private ?string $title = null;
    private ?string $purpose = null;
    private ?PropertyType  $type = null;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }
    public function getPurpose(): ?string
    {
        return $this->purpose;
    }
    public function setPurpose(?string $purpose): void
    {
        $this->purpose = $purpose;
    }
    public function getType(): ?PropertyType
    {
        return $this->type;
    }
    public function setType(PropertyType $type): void
    {
        $this->type = $type;
    }
}
