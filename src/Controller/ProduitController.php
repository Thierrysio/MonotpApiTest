<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Fournisseur;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }

    #[Route('/produit/CreerProduit', name: 'app_produit_creer_produit')]
    public function CreerProduit(EntityManagerInterface $entityManager): Response
    {

        $produit1 = new Produit();
        $produit1->setNom("Produit 04");
        $produit1->setPrix((300));
        $entityManager->persist($produit1);

        $produit2 = new Produit();
        $produit2->setNom("Produit 05");
        $produit2->setPrix((300));
        $entityManager->persist($produit2);

        $produit3 = new Produit();
        $produit3->setNom("Produit 06");
        $produit3->setPrix((300));
        $entityManager->persist($produit3);

        $entityManager->flush();

        return new Response("ok"); 
    }

    #[Route('/produit/Creer', name: 'app_produit_creer')]
    public function creer(EntityManagerInterface $entityManager): Response
    {
        $categorie = new Categorie();
        $categorie->setNom(("categorie 01"));
        $entityManager->persist($categorie);

        $fournisseur1 = new Fournisseur();
        $fournisseur1->setNom(("fournisseur 01"));
        $fournisseur1->setVille(("Ville 01"));
        $entityManager->persist($fournisseur1);

        $fournisseur2 = new Fournisseur();
        $fournisseur2->setNom(("fournisseur 02"));
        $fournisseur2->setVille(("Ville 02"));
        $entityManager->persist($fournisseur2);

        $fournisseur3 = new Fournisseur();
        $fournisseur3->setNom(("fournisseur 03"));
        $fournisseur3->setVille(("Ville 03"));
        $entityManager->persist($fournisseur3);

        $produit = new Produit();
        $produit->setNom("Produit 03");
        $produit->setPrix((300));
        $produit->setLaCategorie($categorie);
        $produit->addLesFournisseur($fournisseur1);
        $produit->addLesFournisseur($fournisseur2);
        $produit->addLesFournisseur($fournisseur3);
        $entityManager->persist($produit);

        $entityManager->flush();

        return new Response("ok"); 





    }
}
