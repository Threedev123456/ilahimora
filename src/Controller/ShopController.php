<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/magasin', name: 'app_shop')]
    public function index(ProduitsRepository $produitsRepository,Request $request): Response
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
          // $email->send($user->getEmail(),'subject','Ilahimora','tongasoa tonn');
            }else{
                $notification ="L'email que vous avez renseigné exixte deja!";
            }
            
        }

        $products = $produitsRepository->findAll();
        return $this->render('shop/index.html.twig', [
            'products' => $products,
            'news'=>$news->createView(),
            'notification'=>$notification
        ]);
    }
}
