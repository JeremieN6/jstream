<?php

namespace App\Controller;

use App\Repository\AnimeSaisonRepository;
use App\Repository\AnimesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageAnnexeController extends AbstractController
{

    #[Route('/faq', name: 'faq')]
    public function faq(): Response
    {  
        
        return $this->render('page_annexe/faq.html.twig', [
            'controller_name' => 'MainPageController',
        ]);
    }
    
    #[Route('/politique-de-confidentialité', name: 'policy_privacy')]
    public function privacyPolicy(): Response
    {   
        
        return $this->render('page_annexe/policy_privacy.html.twig', [
            'controller_name' => 'MainPageController',
        ]);
    }

    #[Route('/condition-d-utilisation', name: 'condition_use')]
    public function conditionUse(): Response
    {   
        
        return $this->render('page_annexe/condition_use.html.twig', [
            'controller_name' => 'MainPageController',
        ]);
    }

    #[Route('/a-propos', name: 'about')]
    public function about(AnimesRepository $animesRepository): Response
    {   

        $animeCount = $animesRepository->count([]);
        
        return $this->render('page_annexe/about.html.twig', [
            'animeCount' => $animeCount,
            'controller_name' => 'MainPageController',
        ]);
    }

    #[Route('/nous-contacter', name: 'contact')]
    public function contact(): Response
    {  
        
        return $this->render('page_annexe/contact.html.twig', [
            'controller_name' => 'MainPageController',
        ]);
    }

    #[Route('/liste-anime', name: 'liste_anime')]
    public function listeAnime(
        AnimesRepository $animesRepository,
        AnimeSaisonRepository $animeSaisonRepository): Response
    {
        return $this->render('page_annexe/liste_anime.html.twig', [
            'Animes' => $animesRepository->findBy([], ['titre' => 'asc']),
            'AnimeSaisons' => $animeSaisonRepository->findBy([], ['anime_id' => 'asc']),
            'controller_name' => 'MainPageController',
        ]);
    }
}
