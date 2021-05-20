<?php

namespace App\Controller\Admin;

use App\Entity\Studio;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
class StudioCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Studio::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
        ];
    }
    
}
