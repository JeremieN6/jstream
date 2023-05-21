<?php

namespace App\Controller;

use App\Entity\Saison;
use App\Entity\SaisonEpisodes;
use App\Repository\AnimeSaisonRepository;
use App\Repository\AnimesRepository;
use App\Repository\EpisodeRepository;
use App\Repository\SaisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_page')]
    public function index(AnimesRepository $animesRepository, AnimeSaisonRepository $animeSaisonRepository): Response
    {   
        return $this->render('main/index.html.twig', [
            'Animes' => $animesRepository->findBy([], ['titre' => 'asc']),
            'AnimeSaisons' => $animeSaisonRepository->findBy([], ['anime_id' => 'asc']),
        ]);
    }

    // /**
    //  * @Route ("/{id}/{slug}", name="show_anime")
    //  * @param $slug
    //  */
    #[Route('/{id}/{slug}', name: 'show_anime', requirements: ['id' => '\d+'])]
    public function show_anime(
        AnimesRepository $animesRepository,
        EpisodeRepository $episodeRepository,
        SaisonRepository $saisonRepository,
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

    #[Route('/{slug}/{id}/saison/{numero_de_saison}/episode/{numero_d_episode}', name: 'show_episode', requirements: ['id' => '\d+'])]
    public function episodeDetail(int $id, int $numero_d_episode, int $numero_de_saison,
    AnimesRepository $animesRepository,
    EpisodeRepository $episodeRepository,
    SaisonRepository $saisonRepository,
    Saison $saisonAnimeid,
    Request $request): Response
    {
        $episode = $episodeRepository->find($id);
        
        if (!$episode) {
            throw $this->createNotFoundException('L\'épisode demandé n\'existe pas');
        }
    
        // Récupération de la saison à laquelle appartient l'épisode
        $saison = $saisonRepository->find($episode->getSaisonId()->getId());
        if (!$saison) {
            throw $this->createNotFoundException('La saison demandée n\'existe pas');
        }
    
        // Récupération des autres épisodes de la même saison
        $autresEpisodes = $episodeRepository->findBy([
            'saison_id' => $saison,
        ]);

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



        /* Récupération des informations de l'épisode actuelle */

        //Je récupère la saison actuelle dans laquelle je suis (grace à la variable : numero_de_saison)
        $currentSaison = $saisonRepository->findBy([
            'anime_id' => $id,
            'numeroDeSaison' => $numero_de_saison]);

        // vérifie si currentSaison existe (la saison dans laquelle je suis par rapport à l'url)
        if ($currentSaison) {
            $currentEpisode = null;
            $saison = $currentSaison[0]; // Accéder à la première ligne de $currentSaison (il n'y a qu'une ligne d'ou le 0. Je pense que j'aurai pu mettre sans le [0])
        
        //Récupère les épisodes de la saison, vérifie si  numeroDEpisode dans l'url est égal au numéro dans la bdd pour savoir si j'ai le bon épisode    
            foreach ($saison->getEpisodes() as $episode) {
                if ($episode->getNumeroDEpisode() == $numero_d_episode) {
                    $currentEpisode = $episode;
                    break;
                }
            }
            
            //Si currentEpisode existe je récupère dans descriptionEpisode la description de l'épisode en cours
            // if ($currentEpisode) {
            //     // Affichez la description de l'épisode
            //     $descriptionEpisode = $currentEpisode->getDescriptionEpisode();
            //     // ...
            // }
        }

        // Passage des données récupérées à la vue
        return $this->render('main/episode_detail.html.twig', [
            'Anime' => $animesRepository->find($id),
            'saison' => $saison,
            'saisonList' => $saisonList,
            'episode' => $episode,
            'listEpisodes' => $episodesList,
            'autresEpisodes' => $autresEpisodes,
            'currentEpisode' => $currentEpisode,
        ]);
    }
    
}
