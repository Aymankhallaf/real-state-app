<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PropertyRepository;
use App\Form\PropertyForm;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Property;

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

    #[Route('/properties/{id<\d+>}', name: 'property_show')]
    public function showProperty(PropertyRepository $repository, int $id): Response
    {
        // Fetch a single property by its ID
        $property = $repository->find($id);
        // Render the property details in a Twig template
        return $this->render('property/show.html.twig', [
            'controller_name' => 'PropertyController',
            'property' => $property
        ]);
    }

    #[Route('/properties/create', name: 'property_create')]
    public function createProperty(Request $request, EntityManagerInterface $entityManager): Response
    {
        $property = new Property();
        $productForm = $this->createForm(PropertyForm::class, $property);
        $productForm->handleRequest($request);
        if ($productForm->isSubmitted() && $productForm->isValid()) {
            // Handle the form submission and save the property to the database
            $property = $productForm->getData();
            $entityManager->persist($property);
            $entityManager->flush();

            // Redirect to the property list page after successful creation
            return $this->redirectToRoute('properties');
        }
        // Render the property creation form in a Twig template
        return $this->render('property/create.html.twig', [
            'controller_name' => 'PropertyController',
            'productForm' => $productForm
        ]);
    }
}
