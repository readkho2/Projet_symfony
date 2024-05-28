<?php
// src/Controller/PanierController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PaiementController extends AbstractController
{
    /**
     * @Route("/panier", name="app_panier")
     */
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        $cart = $session->get('cart', []);

        return $this->render('paiement/paiement.html.twig', [
            'cart' => $cart,
        ]);
    }
}
