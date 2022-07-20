<?php

namespace App\Controller;

use App\classe\Mail;
use App\Entity\Blog;
use App\Entity\ImageTopBlog;
use App\Entity\News;
use App\Entity\Produits;
use App\Entity\User;
use App\Form\HomeType;
use App\Form\NewsType;
use App\Repository\BlogRepository;
use App\Repository\CategoryRepository;
use App\Repository\ImageTopBlogRepository;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ImageTopHomeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/home', name: 'app_home')]
    public function index(ImageTopHomeRepository $imageTopHomeRepository, CategoryRepository $categoryRepository, ProduitsRepository $produitsRepository, BlogRepository $blogRepository,Request $request): Response
    {
       // $email = new Mail();
        //$email->send('ericantonio123456@gmail.com','Antonio','Ilahimora','Tongasoa eto aminay','Manasanao itsidika ny pejy');

        $imageTopHomes = $imageTopHomeRepository->findAll();
        $category = $categoryRepository->findAll();
        $produits = $produitsRepository->findAll();
        $blogs = $blogRepository->findAll();
        
        $user = new News();
        $news = $this->createForm(NewsType::class,$user);
        $news->handleRequest($request);


        return $this->render('base.html.twig', [
            'imageTopHomes' => $imageTopHomes,
            'category' => $category,
            'produits' => $produits,
            'blogs' => $blogs,
            'news' =>$news->createView()
        ]);
    }

    #[Route('/produit/{titre}', name: 'produit')]
    public function show($titre,Request $request): Response
    {
        $user = new News();
        $news = $this->createForm(NewsType::class,$user);
        $news->handleRequest($request);
        //$email = new Mail();
        //$email->send('ericantonio123456@gmail.com','ericantonio123456@gmail.com','teste');
        $pr =$this->entityManager->getRepository(Produits::class)->findOneByTitre($titre);
        if(!$pr){
            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/index.html.twig', [
            'prod'=>$pr,
            'news' =>$news->createView()
        ]);
    }

    #[Route('/blog/{titre}', name: 'blog')]
    public function afficher($titre,ImageTopBlogRepository $imageTopBlogRepository,ImageTopHomeRepository $imageTopHomeRepository, CategoryRepository $categoryRepository, ProduitsRepository $produitsRepository, BlogRepository $blogRepository,Request $request): Response
    {
        $imageTopHomes = $imageTopHomeRepository->findAll();
        $category = $categoryRepository->findAll();
        $produits = $produitsRepository->findAll();
        $blogs = $blogRepository->findAll();
        $user = new News();
        $news = $this->createForm(NewsType::class,$user);
        $news->handleRequest($request);
        //$email = new Mail();
        //$email->send('ericantonio123456@gmail.com','ericantonio123456@gmail.com','teste');
        $bl =$this->entityManager->getRepository(Blog::class)->findOneByTitre($titre);
        if(!$bl){
            return $this->redirectToRoute('app_blog');
        }
        $imageTopBlog = $imageTopBlogRepository->findAll();
        //dd($imageTopBlog);
        return $this->render('blogD/index.html.twig', [
            'bl'=>$bl,
            'imageTopBlog' => $imageTopBlog,
            'imageTopHomes' => $imageTopHomes,
            'category' => $category,
            'produit' => $produits,
            'blogs' => $blogs,
            'news' =>$news->createView()
        ]);
    }
}
