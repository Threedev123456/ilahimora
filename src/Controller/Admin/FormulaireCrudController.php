<?php

namespace App\Controller\Admin;

use App\Entity\Formulaire;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;

class FormulaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Formulaire::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('tel'),
            EmailField::new('email'),
            TextField::new('message'),
        ];
    }
    
}
