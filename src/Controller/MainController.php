<?php

namespace App\Controller;

use App\Entity\Animes;
use App\Entity\AnimeSaison;
use App\Entity\Saison;
use App\Entity\SaisonEpisodes;
use App\Entity\Users;
use App\Form\UserFormType;
use App\Repository\AnimeSaisonRepository;
use App\Repository\AnimesRepository;
use App\Repository\EpisodeRepository;
use App\Repository\SaisonEpisodesRepository;
use App\Repository\SaisonRepository;
use App\Repository\UsersRepository;
use App\Service\PictureService;
use Container2M96TVv\getMercuryseriesFlashy_FlashyNotifierService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

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
     * @Route ("/{slug}/{id}/saison/{numero_de_saison}/episode/{numero_d_episode}", name="show_episode")
     * @param $slug
     * @param $numero_de_saison
     * @param $numero_d_episode
     */
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

    /**
     * @Route ("/{id}/{slug}", name="show_anime")
     * @param $slug
     */
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

    
    /**
     * @Route("/manage-profil", name="modif_profil")
     */
    public function manage_profil(
    Request $request, 
    EntityManagerInterface $em,): Response
    {

        //On récupère l'utilisateur connecté
        $user = $this->getUser();
        //On crée le formulaire
        $userForm = $this->createForm(UserFormType::class, $user);
        //On traite la requête du formulaire
        $userForm->handleRequest($request);


        //On vérifie si le formulaire est soumis ET valide
        if($userForm->isSubmitted() && $userForm->isValid()){

            // //On récupère mes images
            // $images = $userForm->get('images')->getData();

            // foreach($images as $image){
            //     $folder = 'users';

            //     //On appelle le service d'ajout
            //     $fichier = $pictureService->add($image, $folder, 150, 150);

            //     $img = new Images();

            //     $img->setName($fichier);
            //     $user->addImage($img);
            // }

            //On génère le slug
            // $slug = $slugger->slug($user->getPseudo());
            // $user->setSlug($slug);

            //envoie a l'entité
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Ton profil a été modifié avec succès ! 🚀');

            //On redirige
            return $this->redirectToRoute('parametres');
        }

        return $this->render('params/manage_profil.html.twig', [
            'controller_name' => 'MainPageController',
            'userForm' => $userForm->createView()
        ]);
    }

    /**
     * @Route("/parametres", name="parametres")
     */
    public function mentions(): Response
    {

        //On récupère l'utilisateur connecté
        $connectedUser = $this->getUser();

        return $this->render('params/parametres.html.twig', [
            'controller_name' => 'MainPageController',
            'user' => $connectedUser,
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
