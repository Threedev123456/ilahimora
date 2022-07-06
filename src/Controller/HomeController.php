<?php

namespace App\Controller;

use App\classe\Mail;
use App\Repository\BlogRepository;
use App\Repository\CategoryRepository;
use App\Repository\ImageTopHomeRepository;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(ImageTopHomeRepository $imageTopHomeRepository, CategoryRepository $categoryRepository, ProduitsRepository $produitsRepository, BlogRepository $blogRepository): Response
    {
        //$email = new Mail();
        //$email->send('ericantonio123456@gmail.com','ericantonio123456@gmail.com','teste');

        $imageTopHomes = $imageTopHomeRepository->findAll();
        $category = $categoryRepository->findAll();
        $produits = $produitsRepository->findAll();
        $blogs = $blogRepository->findAll();
        $home = 1;
        

        return $this->render('home/index.html.twig', [
            'imageTopHomes' => $imageTopHomes,
            'category' => $category,
            'produits' => $produits,
            'blogs' => $blogs,
            'home'=>$home,
        ]);
    }
}
