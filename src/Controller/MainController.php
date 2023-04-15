<?php

namespace App\Controller;

use App\Entity\Animes;
use App\Entity\AnimeSaison;
use App\Entity\Saison;
use App\Entity\SaisonEpisodes;
use App\Repository\AnimeSaisonRepository;
use App\Repository\AnimesRepository;
use App\Repository\EpisodeRepository;
use App\Repository\SaisonEpisodesRepository;
use App\Repository\SaisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
        AnimesRepository $animeTest,
        EpisodeRepository $episodeRepository,
        SaisonRepository $saisonRepository,
        SaisonEpisodesRepository $saisonEpisodesRepository,
        Saison $saisonAnimeid,
        SaisonEpisodes $saison_id,
        Request $request,
        $id): Response
    {
        
        //Récupérer l'ID de l'anime
        $anime = $animesRepository->find($id);

        //Récupérer la liste des saisons de l'animé sélectionné
        $saisonList = $saisonRepository->findBy(['anime_id' => $id]);

        //Récupérer toutes les saisons d'un animé
        $saisons = $saisonRepository->findBy(['anime_id' => $saisonAnimeid]);

        //Récupérer tous les épisodes en rapport à l'animé sélectionné
        $episodesList = [];
        foreach ($saisons as $saison_id) {
            $episodesSaison = $episodeRepository->findBy(['saison_id' => $saison_id]);
            $episodesList = array_merge($episodesList, $episodesSaison);
        }

            // Récupération de l'ID de la saison sélectionnée dans le menu déroulant
             $seasonId = $request->query->get('season');

            // Récupération des épisodes de l'animé correspondant à la saison sélectionnée
            if ($seasonId) {
                $episodesList = $episodeRepository->findBy(['saison_id' => $seasonId]);
            } else {
                // Si aucune saison n'a été sélectionnée, on affiche tous les épisodes de l'animé
                $episodesList = [];
                foreach ($saisons as $saison_id) {
                    $episodesSaison = $episodeRepository->findBy(['saison_id' => $saison_id]);
                    $episodesList = array_merge($episodesList, $episodesSaison);
                }
            }
    

        return $this->render('main/show-anime.html.twig', [
            'Anime' => $animesRepository->find($id),
            'animeParId' => $anime,
            'listEpisodes' => $episodesList,
            'saisons' => $saisonRepository,
            'saisonList' => $saisonList,
            'saisons' => $saisons
                // 'episodes' => $episodesList
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
