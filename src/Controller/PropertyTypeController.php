<?php

namespace App\Controller;

use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PropertyTypeRepository;
use App\Entity\PropertyType;

final class PropertyTypeController extends AbstractController
{
    #[Route('/types', name: 'app_property_type')]
    public function index(PropertyTypeRepository $repository): Response
    {
        $types = $repository->findAll();
        return $this->render('property_type/index.html.twig', [
            'controller_name' => 'PropertyTypeController',
            'types' => $types
        ]);
    }
}
