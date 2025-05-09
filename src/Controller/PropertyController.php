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
    public function showProperty(Property $property): Response
    {
       
        // Render the property details in a Twig template
        return $this->render('property/show.html.twig', [
            'controller_name' => 'PropertyController',
            'property' => $property
        ]);
    }

    #[Route('/properties/create', name: 'property_create')]
    public function createProperty(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Create a new Property entity and form
        $property = new Property();
        // Create the form using the PropertyForm class
        $PropertyForm = $this->createForm(PropertyForm::class, $property);
        // Handle the form submission
        $PropertyForm->handleRequest($request);
        // Check if the form is submitted and valid
        if ($PropertyForm->isSubmitted() && $PropertyForm->isValid()) {
            // Handle the form submission and save the property to the database
            $property = $PropertyForm->getData();
            $entityManager->persist($property);
            $entityManager->flush();
            // Add a flash message to indicate success
            $this->addFlash('success', 'Property created successfully!');

            // Redirect to the property list page after successful creation
            return $this->redirectToRoute('property_show', [
                'id' => $property->getId()
            ]);
        }
        // Render the property creation form in a Twig template
        return $this->render('property/create.html.twig', [
            'controller_name' => 'PropertyController',
            'PropertyForm' => $PropertyForm
        ]);
    }

    #[Route('/properties/edit/{id<\d+>}', name: 'property_edit')]
    public function editProperty(Property $property ,Request $request, EntityManagerInterface $entityManager): Response
    {

        // Create the form using the PropertyForm class
        $PropertyForm = $this->createForm(PropertyForm::class, $property);
        // Handle the form submission
        $PropertyForm->handleRequest($request);
        // Check if the form is submitted and valid
        if ($PropertyForm->isSubmitted() && $PropertyForm->isValid()) {
            // Handle the form submission and update the property in the database
            $property = $PropertyForm->getData();
            $entityManager->persist($property);
            $entityManager->flush();
            // Add a flash message to indicate success
            $this->addFlash('success', 'Property updated successfully!');

            // Redirect to the property list page after successful update
            return $this->redirectToRoute('property_show', [
                'id' => $property->getId()
            ]);
        }
        // Render the property edit form in a Twig template
        return $this->render('property/edit.html.twig', [
            'controller_name' => 'PropertyController',
            'PropertyForm' => $PropertyForm,
            'property' => $property
        ]);
    }

    #[Route('/properties/delete/{id<\d+>}', name: 'property_delete')]
    public function deleteProperty(Property $property, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$property) {
            // Add a flash message to indicate failure
            $this->addFlash('error', 'Property not found!');
            // Redirect to the property list page if the property is not found
            return $this->redirectToRoute('properties');
        }

        if ($request->isMethod('POST')) {
            // Handle the form submission and delete the property from the database
            $entityManager->remove($property);
            $entityManager->flush();
            // Add a flash message to indicate success
            $this->addFlash('success', 
            'Property deleted successfully!');

            // Redirect to the property list page after successful deletion
            return $this->redirectToRoute('properties');
        }
        
        return $this->render('property/delete.html.twig', [
            'controller_name' => 'PropertyController',
            'title' => $property->getTitle(),
            'id' => $property->getId()
        ]);
    }
}
