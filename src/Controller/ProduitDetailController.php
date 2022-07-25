<?php

namespace App\Controller;

use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitDetailController extends AbstractController
{
    #[Route('/produit/detail', name: 'app_produit_detail')]
    public function index(ProduitsRepository $produitsRepository): Response
    {
        $product = $produitsRepository->findAll();
        return $this->render('produit_detail/index.html.twig', [
            'product' => $product,
        ]);
    }
}
