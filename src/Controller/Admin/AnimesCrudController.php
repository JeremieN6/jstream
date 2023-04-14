<?php

namespace App\Controller\Admin;

use App\Entity\Animes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class AnimesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Animes::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            TextField::new('titre'),
            TextEditorField::new('description'),
            IntegerField::new('nbrDeSaisonsDansAnime', 'Nombre de Saisons dans l\'Animé'),
            NumberField::new('ageMax', 'Age minimum de visionnage')->hideOnIndex(),
            TextField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex(),
            ImageField::new('featured_image')->setBasePath('upload/images/featured')->onlyOnIndex(),
            SlugField::new('slug')->setTargetFieldName('titre')->hideOnIndex(),
            DateField::new('date_sortie','Crée le'),
        ];
    }

    // public function configureCrud(Crud $crud): Crud
    // {
    //     return $crud
    //         ->setDefaultSort(['date_sortie' => 'DESC']);
    // }

}
