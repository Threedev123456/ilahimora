<?php

namespace App\Controller\Admin;

use App\Entity\ImageTopBlog;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class ImageTopBlogCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ImageTopBlog::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('image')
                ->setUploadDir('public/uploads')
                ->setBasePath('uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
        ];
    }

}
