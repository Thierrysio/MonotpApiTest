<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Utils\Utils;



class ApiController extends AbstractController
{
    #[Route('/api', name: 'app_api')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
    #[Route('/api/getallproduits', name: 'app_api_get_all_produits')]
    public function getallproduits(ProduitRepository $produitRepository): JsonResponse
    {
       $produits = $produitRepository->findAll();
       return $this->json($produits);
    }

    #[Route('/api/getproduit', name: 'app_api_get_produit')]
    public function getproduit(Request $request,ProduitRepository $produitRepository)
    {
        $utils =new Utils();
        $postData= json_decode($request->getContent());

       $produit = $produitRepository->find( $postData->Id);
       $ignorer= ["lesproduits"];
       return $utils->GetJsonResponse($request,$produit,$ignorer);
    }

    #[Route('/api/getallproduits', name: 'app_api_get_all_produits')]
    public function getallproduits2(Request $request,ProduitRepository $produitRepository)
    {
        $response =new Utils();
        $produits = $produitRepository->findAll();
        return $response->GetJsonResponse($request,$produits);
    }

    #[Route('/api/getproduit2', name: 'app_api_get_produit2')]
    public function getproduit2(Request $request,ProduitRepository $produitRepository): JsonResponse
    {
        $getData= json_decode($request->getContent());
        $produit = $produitRepository->find( $getData->Id);
        return $this->json($produit);
    }

}
