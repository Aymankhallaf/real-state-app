<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use App\Repository\PropertyTypeRepository;

class GlobalPropertyTypesExtension extends AbstractExtension
{
    private PropertyTypeRepository $repository;

    public function __construct(PropertyTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_property_types', [$this, 'getPropertyTypes']),
        ];
    }

    public function getPropertyTypes()
    {
        return $this->repository->findAll();
    }
}
