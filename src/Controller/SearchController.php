<?php

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PropertyRepository;
use App\Form\PropertyForm;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Property;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Form\PropertySearchForm;
use App\Model\PropertySearch;

//remove final from the class declaration to allow inhertied, extended
class SearchController extends AbstractController
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
