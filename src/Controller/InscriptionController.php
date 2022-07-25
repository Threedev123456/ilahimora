<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AdminType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class InscriptionController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/inscription', name: 'app_inscription')]
    public function index(Request $request,UserPasswordHasherInterface $hasher): Response
    {
        $notification = null;
        $admin = new User();
        $form = $this->createForm(AdminType::class,$admin);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $admin = $form->getData();
            $password = $hasher->hashPassword($admin,$admin->getPassword());
            $admin->setPassword($password);
            
            $search_email = $this->entityManager->getRepository(User::class)->findOneByEmail($admin->getEmail());
            if(!$search_email){
                $this->entityManager->persist($admin);
                $this->entityManager->flush();
                $notification ='Email envoyer avec success!';
            //$email = new Mail();
          // $email->send($user->getEmail(),'subject','Ilahimora','tongasoa tonn');
            }else{
                $notification ="L'email que vous avez renseigné exixte deja!";
            }
            
        }
        return $this->render('inscription/index.html.twig', [
            'form' =>$form->createView(),
            'notification'=>$notification,
        ]);
    }
}
