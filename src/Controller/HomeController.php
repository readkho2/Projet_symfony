<?php
// src/Controller/HomeController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        // Affiche la page d'accueil
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/categorie/{type}", name="categorie")
     */
    public function categorie(string $type): Response
    {
        // Récupère les produits en fonction de la catégorie
        $produits = $this->getProduitsByCategorie($type);

        // Affiche la page avec la liste des produits de la catégorie
        return $this->render('categorie/hommes.html.twig', [
            'type' => $type,
            'produits' => $produits,
        ]);
    }

    /**
     * Fonction de récupération des produits par catégorie (à remplacer par votre propre logique).
     */
    private function getProduitsByCategorie(string $type): array
    {
        // Logique de récupération des produits (remplacez par votre propre logique)
        return [
            ['nom' => 'Produit 1', 'prix' => 19.99],
            ['nom' => 'Produit 2', 'prix' => 29.99],
            // ... autres produits ...
        ];
    }
}

?>
