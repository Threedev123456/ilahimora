<?php

namespace App\Controller;

use App\classe\Mail;
use App\Entity\News;
use App\Form\NewsType;
use App\Entity\Produits;
use App\Entity\Formulaire;
use App\Form\FormulaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/commande', name: 'app_commande')]
    public function index(Request $request): Response
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

        return $this->render('commande/index.html.twig', [
            
            'news' =>$news->createView(),
            'formul' =>$formul->createView()
            ,'notification'=>$notification
        ]);
    }

}
