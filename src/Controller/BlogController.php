<?php

namespace App\Controller;

use App\Repository\BlogRepository;
use App\Repository\CategoryRepository;
use App\Repository\ImageTopBlogRepository;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(BlogRepository $blogRepository,ImageTopBlogRepository $imageTopBlogRepository, CategoryRepository $categoryRepository, ProduitsRepository $produitsRepository): Response
    {
        $produit = $produitsRepository->findAll();
        $category = $categoryRepository->findAll();
        $imageTopBlogs =$imageTopBlogRepository->findAll();
        $blogs = $blogRepository->findAll();
        return $this->render('blog/index.html.twig', [
            'blogs' => $blogs,
            'imageTopBlogs' => $imageTopBlogs,
            'category'=>$category,
            'produit'=> $produit,
        ]);
    }
}
