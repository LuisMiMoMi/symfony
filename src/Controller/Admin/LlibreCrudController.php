<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

use App\Entity\Llibre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LlibreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Llibre::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('isbn'),
            TextField::new('titol'),
            TextField::new('autor'),
            IntegerField::new('pagines'),
            AssociationField::new('editorial'),
        ];
    }
}
