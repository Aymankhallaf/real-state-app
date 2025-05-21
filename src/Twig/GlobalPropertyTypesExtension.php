<?php
namespace App\Twig;

use App\Repository\PropertyTypeRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class GlobalPropertyTypesExtension extends AbstractExtension
{
    private $repository;

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
