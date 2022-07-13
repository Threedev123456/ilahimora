<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\User;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
    {
        $user = new Contact();
        $form = $this->createForm(ContactType::class,$user);
        $form->handleRequest($request);
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
