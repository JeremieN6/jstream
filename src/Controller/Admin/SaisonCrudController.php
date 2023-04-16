<?php

namespace App\Controller\Admin;

use App\Entity\Saison;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class SaisonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Saison::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            AssociationField::new('anime_id', 'Nom de l\'Animé'),
            TextField::new('titre_saison','Titre de la saison'),
            IntegerField::new('numero_de_saison', 'N° de la saison'),
            IntegerField::new('nbrEpisodeDansLaSaison', 'Nombre d\'épisode dans la saison'),
            TextEditorField::new('description_saison', 'Description'),
            TextField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex(),
            ImageField::new('featured_image')->setBasePath('upload/images/featured')->onlyOnIndex(),
        ];
    }
    
}
