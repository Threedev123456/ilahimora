<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\News;
use App\Entity\User;
use App\Form\ContactType;
use App\Form\NewsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
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
 

        $users = new Contact();
        $form = $this->createForm(ContactType::class,$users);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $users = $form->getData();
            $this->entityManager->persist($users);
            $this->entityManager->flush();
            $notification = 'Email envoyer !';
            return $this->redirectToRoute('app_home');
            
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'news'=>$news->createView(),
            'notification'=>$notification
        ]);
    }
}
