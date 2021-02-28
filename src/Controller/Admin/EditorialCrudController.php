<?php

namespace App\Controller\Admin;

use App\Entity\Editorial;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EditorialCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Editorial::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
