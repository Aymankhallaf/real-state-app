<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PropertyRepository;
use App\Entity\Property;

final class HomeController extends AbstractController
{
    #[Route(path: '/', name: 'home')]
    /**
     * 
     * @Route( "/", name="home")
     * @return Response
     */
    public function index(PropertyRepository $repository): Response
    {
        $properties = $repository->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'properties' => $properties

        ]);
    }
}
