<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParametresUserController extends AbstractController
{
    #[Route('/manage-profil', name: 'modif_profil')]
    public function manage_profil(
        Request $request, 
        EntityManagerInterface $em): Response
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

        return $this->render('parametres_user/manage_profil.html.twig', [
            'controller_name' => 'MainPageController',
            'userForm' => $userForm->createView()
        ]);
    }

    #[Route('/parametres', name: 'parametres')]
    public function mentions(): Response
    {

        //On récupère l'utilisateur connecté
        $connectedUser = $this->getUser();

        return $this->render('parametres_user/parametres.html.twig', [
            'controller_name' => 'MainPageController',
            'user' => $connectedUser,
        ]);
    }

    #[Route('/abonnement', name: 'abonnement')]
    public function abonnement(): Response
    {
        return $this->render('parametres_user/abonnement.html.twig', [
            'controller_name' => 'MainPageController',
        ]);
    }

    #[Route('/tarifs', name: 'pricing-plan')]
    public function tarifs(): Response
    {
        return $this->render('parametres_user/pricing-plan.html.twig', [
            'controller_name' => 'MainPageController',
        ]);
    }
}
