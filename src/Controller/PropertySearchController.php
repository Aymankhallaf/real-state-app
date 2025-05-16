<?php

namespace App\Controller;
use App\Form\PropertySearchForm;
use App\Model\PropertySearch;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PropertySearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    
    public function searchProperty(Request $request, PropertyRepository $repository): Response
    {
        // Create a new PropertySearch object
        $propertySearch = new PropertySearch();
        // Create the form using the PropertySearchForm class
        $form = $this->createForm(PropertySearchForm::class, $propertySearch);
        // Handle the form submission
        $form->handleRequest($request);
        // Check if the form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            // Fetch properties based on the search criteria
            $propertySearch = $request->query->get('q');
            $properties = $repository->search($propertySearch);
            // Render the search results in a Twig template
            return $this->render('includes/search.html.twig', [
                'controller_name' => 'PropertyController',
                //set the properties to the search results and show the form
                'properties' => $properties,
                'form' => $form->createView()
            ]);
        }
        // Render the search form in a Twig template
        return $this->render('includes/search.html.twig', [
            'controller_name' => 'PropertyController',
            'form' => $form->createView()
        ]);
    }
}
