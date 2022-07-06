<?php

namespace App\Controller\Admin;

use App\Entity\ImageTopHome;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ImageTopHomeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ImageTopHome::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('image')
                ->setUploadDir('public/uploads')
                ->setBasePath('uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            TextField::new('titre'),
            TextareaField::new('contenu'),
            TextField::new('boutton')
        ];
    }

}
