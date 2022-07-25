<?php

namespace App\Controller;

use App\classe\Mail;
use App\Entity\News;
use App\Form\NewsType;
use App\Entity\Category;
use App\Entity\Produits;
use App\Entity\Formulaire;
use App\Form\FormulaireType;
use App\Repository\BlogRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ImageTopBlogRepository;
use App\Repository\ImageTopHomeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/blogs', name: 'app_blog')]
    public function index(Request $request, BlogRepository $blogRepository,ImageTopBlogRepository $imageTopBlogRepository, CategoryRepository $categoryRepository, ProduitsRepository $produitsRepository): Response
    {

        $notification=null;
        $user = new News();
        $news = $this->createForm(NewsType::class,$user);
        $news->handleRequest($request);

        if($news->isSubmitted() && $news->isValid()){
            $user = $news->getData();
            
            $search_email = $this->entityManager->getRepository(News::class)->findOneByEmail($user->getEmail());
            if(!$search_email){
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                $notification ='Email envoyer avec success!';
            //$email = new Mail();
          // $email->send($user->getEmail(),'subject','Ilahimora','tongasoa ');
            }else{
                $notification ="L'email que vous avez renseigné exixte deja!";
            }
            
        }

        $produit = $produitsRepository->findAll();
        $category = $categoryRepository->findAll();
        $imageTopBlogs =$imageTopBlogRepository->findAll();
        $blogs = $blogRepository->findAll();
        

        return $this->render('blog/index.html.twig', [
            'blogs' => $blogs,
            'imageTopBlogs' => $imageTopBlogs,
            'category'=>$category,
            'produit'=> $produit,
            'news'=>$news->createView(),
            'notification'=>$notification
        ]);
    }

    #[Route('/category/{titre}', name: 'category')]
    public function cat($titre,ImageTopHomeRepository $imageTopHomeRepository, CategoryRepository $categoryRepository, ProduitsRepository $produitsRepository, BlogRepository $blogRepository,Request $request): Response
    {
        $notification=null;
        
        $cat =$this->entityManager->getRepository(Category::class)->findOneByTitre($titre);
        if(!$cat){
            return $this->redirectToRoute('app_home');
        }
        $imageTopHomes = $imageTopHomeRepository->findAll();
        $category = $categoryRepository->findAll();
        $produits = $produitsRepository->findAll();
        $blogs = $blogRepository->findAll();
        
        $user = new News();
        $news = $this->createForm(NewsType::class,$user);
        $news->handleRequest($request);

        if($news->isSubmitted() && $news->isValid()){
            $user = $news->getData();
            
            $search_email = $this->entityManager->getRepository(News::class)->findOneByEmail($user->getEmail());
            if(!$search_email){
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                $notification ='Email envoyer avec success!';
           $email = new Mail();
            $email->send($user->getEmail(),'subject','Ilahimora','Tongasoa');
            }else{
                $notification ="L'email que vous avez renseigné exixte deja!";
            }
            
        }

        $users = new Formulaire();
        $formul = $this->createForm(FormulaireType::class,$users);
        $formul->handleRequest($request);

        if($formul->isSubmitted() && $formul->isValid()){
            $users = $formul->getData();
            $this->entityManager->persist($users);
            $this->entityManager->flush();
        }


        return $this->render('cat/index.html.twig', [
            'imageTopHomes' => $imageTopHomes,
            'category' => $category,
            'produits' => $produits,
            'blogs' => $blogs,
            'news' => $news->createView(),
            'cat'=>$cat,
            'formul' =>$formul->createView()
            ,'notification'=>$notification
        ]);
    }

    #[Route('/produit/{titre}', name: 'produit')]
    public function show($titre,Request $request): Response
    {
        $notification = null;
        $user = new News();
        $news = $this->createForm(NewsType::class,$user);
        $news->handleRequest($request);

        if($news->isSubmitted() && $news->isValid()){
            $user = $news->getData();
            
            $search_email = $this->entityManager->getRepository(News::class)->findOneByEmail($user->getEmail());
            if(!$search_email){
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                $notification ='Email envoyer avec success!';
                $email = new Mail();
                $email->send($user->getEmail(),'subject','Ilahimora','Tongasoa');
            }else{
                $notification ="L'email que vous avez renseigné exixte deja!";
            }
            
        }
        $users = new Formulaire();
        $formul = $this->createForm(FormulaireType::class,$users);
        $formul->handleRequest($request);

        if($formul->isSubmitted() && $formul->isValid()){
            $users = $formul->getData();
            $this->entityManager->persist($users);
            $this->entityManager->flush();
            return $this->redirectToRoute('app_home');
            $notification = 'Email envoyer !';
        }
        $pr =$this->entityManager->getRepository(Produits::class)->findOneByTitre($titre);
        if(!$pr){
            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/index.html.twig', [
            'prod'=>$pr,
            'news' =>$news->createView(),
            'formul' =>$formul->createView()
            ,'notification'=>$notification
        ]);
    }
}
