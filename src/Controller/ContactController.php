<?php

namespace App\Controller;

use App\classe\Mail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {
        if (isset($_GET['$email']) && isset($_GET['$message'])){
            $email = $_GET['$email'];
            $message = $_GET['$message'];
            $mail = new Mail();
            $mail->send($email,'ericantonio123456@gmail.com',$message);
            echo 'hahaha';
        }

        return $this->render('contact/index.html.twig', [
        ]);
    }
}
