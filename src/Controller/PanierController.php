<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="app_panier")
     */
    public function index(Request $request): Response
    {
        // Récupère les éléments du panier depuis la session
        $cart = $request->getSession()->get('cart', []);

        return $this->render('categorie/panier.html.twig', [
            'cart' => $cart,
        ]);
    }
}
