<?php

namespace App\Controller\Admin;

use App\Entity\Episode;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use Vich\UploaderBundle\Form\Type\VichImageType;



class EpisodeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Episode::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', '#ID')->onlyOnIndex(),
            AssociationField::new('saison_id', 'Nom la saison'),
            // AssociationField::new('titre_saison','Nom de la Saison'),
            IntegerField::new('numero_d_episode', 'N° d\'épisode'),
            TextField::new('titre_episode','Titre de l\'episode'),
            TextEditorField::new('description_episode', 'Description'),
            IntegerField::new('duree_episode', 'Durée de l\'Episode'),
            TextField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex(),
            TextField::new('videoFile')->setFormType(VichImageType::class)->hideOnIndex(), /** ou alors la ligne d'en dessous pour ajouter une vidéo */
            UrlField::new('video_url', 'Url de la vidéo')->hideOnIndex(),
            ImageField::new('featured_image')->setBasePath('upload/images/featured')->onlyOnIndex(),
        ];
    }
    
}
