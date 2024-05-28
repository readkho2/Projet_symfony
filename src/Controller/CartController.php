<?php
// src/Controller/CartController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class CartController extends AbstractController
{
    /**
     * @Route("/add-to-cart", name="add_to_cart", methods={"POST"})
     */
    public function addToCart(Request $request)
    {
        $cartItem = json_decode($request->getContent(), true);
    
        // Vérifiez si le panier est dans la session
        $session = $request->getSession();
        $cart = $session->get('cart', []);
    
        $itemId = $cartItem['id'];
    
        // Vérifiez si l'article est déjà dans le panier
        if (isset($cart[$itemId])) {
            // Si oui, augmentez la quantité
            $cart[$itemId]['quantity'] += $cartItem['quantity'];
        } else {
            // Sinon, ajoutez l'article avec la quantité par défaut de 1
            $cartItem['quantity'] = 1;
            $cart[$itemId] = $cartItem;
        }
    
        // Sauvegardez le panier mis à jour dans la session
        $session->set('cart', $cart);
    
        return new JsonResponse(['success' => true]);
    }
    
    /**
     * @Route("/remove-from-cart/{id}", name="remove_from_cart", methods={"POST"})
     */
    public function removeFromCart(Request $request, $id): JsonResponse
    {
        $session = $request->getSession();
        $cart = $session->get('cart', []);

        foreach ($cart as $key => $item) {
            if ($item['id'] == $id) {
                unset($cart[$key]);
                break;
            }
        }

        $session->set('cart', array_values($cart));

        return new JsonResponse(['success' => true]);
    }

    /**
     * @Route("/update-cart", name="update_cart", methods={"POST"})
     */
    public function updateCart(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!$data || !isset($data['id'], $data['quantity'])) {
            return new JsonResponse(['success' => false], Response::HTTP_BAD_REQUEST);
        }

        $session = $request->getSession();
        $cart = $session->get('cart', []);

        foreach ($cart as &$item) {
            if ($item['id'] === $data['id']) {
                $item['quantity'] = $data['quantity'];
                break;
            }
        }

        $session->set('cart', $cart);

        return new JsonResponse(['success' => true]);
    }
}



