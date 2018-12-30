<?php


namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Produit;
use AppBundle\Services\OBJSerializer;

/**
 * @Route("/ajax")
 */
class ServiceController extends Controller
{

    /**
     * @Route("/panier/ajouter/{id}", name="panier_add_service")
     */
    public function addProductToCart(Produit $prd): Response{

        $produit = [
            "id" => $prd->getId(),
            "img" => $prd->getCoverImage(),
            "libelle" => $prd->getLibelle(),
            "prix" => $prd->getPrix(),
            "stock" => $prd->getStock()
        ];
        
        return $this->json($produit, 200);
    }



}