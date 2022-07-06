<?php

namespace App\Controller\Admin;

use App\Entity\About;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AboutCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return About::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('imagetop')
            ->setUploadDir('public/uploads')
            ->setBasePath('uploads')
            ->setUploadedFileNamePattern('[randomhash].[extention]')
            ->setRequired(false),
            TextareaField::new('texthistoire'),
            ImageField::new('imagehistoire')
                ->setUploadDir('public/uploads')
                ->setBasePath('uploads')
                ->setUploadedFileNamePattern('[randomhash].[extention]')
                ->setRequired(false),
            TextareaField::new('textservice'),
            ImageField::new('imageservice')
                ->setUploadDir('public/uploads')
                ->setBasePath('uploads')
                ->setUploadedFileNamePattern('[randomhash].[extention]')
                ->setRequired(false),
            TextareaField::new('sitation'),
            TextField::new('auteur'),

        ];
    }

}
