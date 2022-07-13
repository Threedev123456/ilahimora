<?php

namespace App\Controller\Admin;

use App\Entity\Produits;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProduitsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produits::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            BooleanField::new('MeilleurCommande'),
            ImageField::new('image')
                ->setUploadDir('public/uploads')
                ->setBasePath('uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            ImageField::new('image2')
                ->setUploadDir('public/uploads')
                ->setBasePath('uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false), BooleanField::new('MeilleurCommande'),
            ImageField::new('image3')
                ->setUploadDir('public/uploads')
                ->setBasePath('uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            TextField::new('titre'),
            BooleanField::new('VenteLivrer'),
            AssociationField::new('category'),
            MoneyField::new('prix')->setCurrency('EUR'),
            BooleanField::new('MeilleurCommande'),


        ];
    }

}
