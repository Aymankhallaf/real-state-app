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
    #[Route(name: 'app_search')]
    public function searchProperty(Request $request): Response
    {
        $propertySearch = new PropertySearch();
        // Create the form using the PropertySearchForm class
        $form = $this->createForm(PropertySearchForm::class, $propertySearch, [
            'method' => 'GET',
            'csrf_protection' => false,
            'action' => $this->generateUrl('search_results')
        ]);
        return $this->render('includes/_search_widget.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    

    #[Route('/search-results', name: 'search_results')]
    public function searchResults(Request $request, PropertyRepository $repository): Response
    {

        // Create a new PropertySearch object
        $propertySearch = new PropertySearch();
        // Create the form using the PropertySearchForm class
        $form = $this->createForm(PropertySearchForm::class, $propertySearch, [
            'method' => 'GET',
        ]);
        // Handle the form submission
        $form->handleRequest($request);
        // $properties=null;
        // Check if the form is submitted and valid
        // if ($form->isSubmitted() && $form->isValid()) {
        // passes directly propertySearch
        $properties = $repository->search($propertySearch);
        // Render the search results in a Twig template

        // }
        // Render the search form in a Twig template

        return $this->render('property/search-results.html.twig', [
            'form' => $form->createView(),
            'properties' => $properties
        ]);
    }
}
