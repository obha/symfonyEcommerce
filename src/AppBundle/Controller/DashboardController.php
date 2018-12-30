<?php


namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Produit;
use AppBundle\Entity\Categorie;
use AppBundle\Entity\Commande;
use AppBundle\Entity\Avis;
use AppBundle\Entity\ProduitCommande;

/**
 * @Route("admin")
 */
class DashboardController extends Controller
{

    /**
     * @Route("/")
     */
    public function indexAction(){
        return $this->redirectToRoute('dashboard_index');
    }


    /**
     * 
     * @Route("/dashboard", name="dashboard_index")
     */
    public function dashboardAction(){

        $produitRepo = $this->getDoctrine()->getRepository(Produit::class);
        $categorieRepo = $this->getDoctrine()->getRepository(Categorie::class);
        $commandeRepo = $this->getDoctrine()->getRepository(Commande::class);
        $PCRepo = $this->getDoctrine()->getRepository(ProduitCommande::class);
        $avisRepo = $this->getDoctrine()->getRepository(Avis::class);

        return $this->render('admin/index.html.twig', [
            "counts" => [
                "produit" => $produitRepo->count(),
                "categorie" => $categorieRepo->count(),
                "commande" => $commandeRepo->count(), 
                "avis" => $avisRepo->count()
            ],
            "montant" => $PCRepo->montant(),
            'commandes' => $commandeRepo->findAll(),
        ]);

    }

    /**
     * @Route("/dashboard/chart")
     */
    public function chart()
    {
        $PCRepo = $this->getDoctrine()->getRepository(ProduitCommande::class);
        
        return new JsonResponse($PCRepo->topSales());
        //return $this->redirect($this->generateUrl('dashboard_index',['chart' => $PCRepo->topSales()]));
    }
}