<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/main', name: 'main_page')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    
    /**
     * @Route("/manage-profil", name="modif_profil")
     */
    public function manage_profil(): Response
    {
        return $this->render('params/manage_profil.html.twig', [
            'controller_name' => 'MainPageController',
        ]);
    }

    /**
     * @Route("/parametres", name="parametres")
     */
    public function mentions(): Response
    {
        return $this->render('params/parametres.html.twig', [
            'controller_name' => 'MainPageController',
        ]);
    }

    /**
     * @Route("/abonnement", name="abonnement")
     */
    public function abonnement(): Response
    {
        return $this->render('params/abonnement.html.twig', [
            'controller_name' => 'MainPageController',
        ]);
    }

    /**
     * @Route("/tarifs", name="pricing-plan")
     */
    public function tarifs(): Response
    {
        return $this->render('params/pricing-plan.html.twig', [
            'controller_name' => 'MainPageController',
        ]);
    }
}
