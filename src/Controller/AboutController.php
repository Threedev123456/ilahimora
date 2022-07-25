<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use App\Repository\AboutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AboutController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/apropos', name: 'app_about')]
    public function index(AboutRepository $aboutRepository,Request $request): Response
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
            
        $about = $aboutRepository->findAll();
    
        return $this->render('about/index.html.twig', [
            'about' => $about,
            'news'=>$news->createView(),
            'notification'=>$notification
        ]);
    }
}
