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
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

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
