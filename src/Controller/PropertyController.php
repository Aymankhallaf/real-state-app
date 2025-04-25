<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PropertyRepository;


final class PropertyController extends AbstractController
{
    #[Route('/property', name: 'app_property')]
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
}
