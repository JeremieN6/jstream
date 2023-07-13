<?php

namespace App\Controller\Admin;

use App\Entity\AnimeSaison;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class AnimeSaisonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AnimeSaison::class;
    }

    /**/
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('anime_id'),
            IntegerField::new('nombre_de_saisons'),
            DateField::new('date_sortie'),
        ];
    }
    
}
