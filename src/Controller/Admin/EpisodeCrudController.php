<?php

namespace App\Controller\Admin;

use App\Entity\Episode;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
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
            AssociationField::new('saison_id', 'Nom la saison')->hideOnIndex(),
            // AssociationField::new('titre_saison','Nom de la Saison'),
            IntegerField::new('numero_d_episode', 'N° d\'épisode')->hideOnIndex(),
            TextField::new('titre_episode','Titre de l\'episode'),
            TextEditorField::new('description_episode', 'Description'),
            IntegerField::new('duree_episode', 'Durée de l\'Episode'),
            TextField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex(),
            ImageField::new('featured_image')->setBasePath('upload/images/featured')->onlyOnIndex(),
        ];
    }
    
}
