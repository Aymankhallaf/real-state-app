<?php
namespace App;

class PropertySearch
{
private ?string $title = null;
private ?string $purpose = null;
private ?int $type = null;

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
public function getType(): ?int
{
return $this->type;
}
public function setType(?int $type): void
{
$this->type = $type;
}
}