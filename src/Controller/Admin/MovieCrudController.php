<?php

namespace App\Controller\Admin;

use App\Entity\Movie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class MovieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Movie::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('orginalName'),
            IntegerField::new('releaseDate'),
            TextEditorField::new('synopsis'),
            AssociationField::new('actors'),
            AssociationField::new('genres'),
            AssociationField::new('studio'),
            ImageField::new('image')->setUploadDir("/public/assets/upload/images")
                                    ->setBasePath("/assets/upload/images")
        ];
    }
    
}
