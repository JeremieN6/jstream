<?php

namespace App\Controller\Admin;

use App\Entity\SaisonEpisodes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class SaisonEpisodesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SaisonEpisodes::class;
    }

    /**/
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('saison_id'),
            AssociationField::new('episode_id'),
            DateField::new('created_at'),
            DateField::new('updated_at'),
        ];
    }
    
}
