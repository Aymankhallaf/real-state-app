<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PropertyRepository;


final class PropertyController extends AbstractController
{
    #[Route('/properties', name: 'properties')]
    public function index(PropertyRepository $repository): Response
    {
        // Fetch all properties from the database
        $properties = $repository->findAll();
        // Render the properties in a Twig template
        return $this->render('property/index.html.twig', [
            'controller_name' => 'PropertyController',
            'properties' => $properties
        ]);
    }

    #[Route('/properties/{id}', name: 'property_show')]
    public function show(PropertyRepository $repository, int $id): Response
    {
        // Fetch a single property by its ID
        $property = $repository->find($id);
        // Render the property details in a Twig template
        return $this->render('property/show.html.twig', [
            'controller_name' => 'PropertyController',
            'property' => $property
        ]);
    }
}
