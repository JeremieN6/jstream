<?php

namespace App\Controller;

use App\Entity\Animes;
use App\Entity\Saison;
use App\Entity\SaisonEpisodes;
use App\Repository\AnimeSaisonRepository;
use App\Repository\AnimesRepository;
use App\Repository\EpisodeRepository;
use App\Repository\SaisonEpisodesRepository;
use App\Repository\SaisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/main', name: 'main_page')]
    public function index(AnimesRepository $animesRepository, AnimeSaisonRepository $animeSaisonRepository): Response
    {   
        return $this->render('main/index.html.twig', [
            'Animes' => $animesRepository->findBy([], ['titre' => 'asc']),
            'AnimeSaisons' => $animeSaisonRepository->findBy([], ['anime_id' => 'asc']),
        ]);
    }

    /**
     * @Route ("/{id}/{slug}", name="show_anime")
     * @param $slug
     */
    public function show_anime(
        AnimesRepository $animesRepository, 
        EpisodeRepository $episodeRepository,
        SaisonRepository $saisonRepository,
        SaisonEpisodesRepository $saisonEpisodesRepository,
        Saison $saisonAnimeid,
        SaisonEpisodes $saison_id,
        $id): Response
    {
    
        $anime = $animesRepository->find($id);
        $saisons = $saisonRepository->findBy(['anime_id' => $saisonAnimeid]);
        $episodesList = [];
        foreach ($saisons as $saison_id) {
            $episodesSaison = $episodeRepository->findBy(['saison_id' => $saison_id]);
            $episodesList = array_merge($episodesList, $episodesSaison);
        }

        return $this->render('main/show-anime.html.twig', [
            'Anime' => $animesRepository->find($id),
            'listEpisodes' => $episodesList,
            'saisons' => $saisonRepository,
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
