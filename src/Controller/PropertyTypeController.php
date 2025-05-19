<?php

namespace App\Controller;

use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PropertyTypeRepository;

final class PropertyTypeController extends AbstractController
{
    #[Route(name: 'app_property_type')]
    public function typeSection(PropertyTypeRepository $repository): Response
    {
        $types = $repository->findAll();
        return $this->render('includes/_type_section.html.twig', [
            'controller_name' => 'PropertyTypeController',
            'types' => $types
        ]);
    }

    #[Route('/types/{name}', name: 'property_type_show')]
    public function showPropertiesByType(string $name, PropertyTypeRepository $repository): Response
    {
        $type = $repository->findOneByName($name);


        $properties = $type->getProperties();
        // Render the property type details in a Twig template
        return $this->render('property_type/showType.html.twig', [
            'controller_name' => 'PropertyTypeController',
            'type' => $type,
            'properties' => $properties
        ]);
    }

    #[Route(name: 'type_menu')]
    public function showMenuTypes(PropertyTypeRepository $repository): Response
    {
        $types = $repository->findAll();
        return $this->render('includes/navbar.html.twig', [
            'controller_name' => 'PropertyTypeController',
            'types' => $types
        ]);
    }
}
