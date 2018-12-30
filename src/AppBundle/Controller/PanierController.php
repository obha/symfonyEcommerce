<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Commande;
use AppBundle\Entity\Produit;
use AppBundle\Entity\ProduitCommande;
use AppBundle\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/panier")
 */
class PanierController extends Controller
{

    private $sess;

    private $produits;

    public function __construct()
    {
        $this->sess = new Session;
    }

    /**
     * @Route("/checkout", name="checkout_page")
     */
    public function checkoutAction(Request $request)
    {

        @$panier = $this->sess->get('panier');

        if (!$panier) {
            return $this->redirectToRoute('panier_show');
        }

        $commande = new Commande();
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($panier as $id => $qte) {

                $produitCommande = new ProduitCommande();

                $produit = $this->getDoctrine()
                    ->getRepository(Produit::class)
                    ->find($id);

                $produit
                    ->setQte($qte);

                $produitCommande
                    ->setCommande($commande)
                    ->setProduit($produit)
                    ->setPrix($produit->getPrix())
                    ->setQte($produit->getQte());

                $em->persist($produitCommande);
            }

            $em->persist($commande);
            $em->flush();
        }

        return $this->render('default/checkout.html.twig', [
            "total" => $this->total(),
            "commandeForm" => $form->createView(),
        ]);

    }

    /**
     * @Route("/ajouter/{id}", name="panier_add")
     */
    public function addToCart($id, Request $request)
    {
        var_dump($request->query->get('quantity'));
        @$panier = $this->sess->get('panier');
        @$panier[$id]++;
        $this->sess->set('panier', $panier);

        return $this->redirectToRoute("panier_show");
    }

    /**
     * @Route("/detail", name="panier_show")
     */
    public function show()
    {
        @$produits_id = $this->sess->get('panier');

        // var_dump($produits_id);
        // exit();
        $panier = [];

        if ($produits_id) {
            foreach ($produits_id as $id => $qte) {
                $produit = $this->getDoctrine()
                    ->getManager()
                    ->getRepository(Produit::class)
                    ->find($id);

                $produit->setQte($qte);
                $panier[] = $produit;
            }
        }

        return $this->render('default/carte.html.twig', [
            "panier" => $panier,
            "total" => $this->total(),
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="panier_delete")
     */
    public function supprimerProduit($id)
    {
        $panier = [];

        @$produits_id = $this->sess->get('panier');
        unset($produits_id[$id]);

        foreach ($produits_id as $id => $qte) {
            $produit = $this->getDoctrine()
                ->getManager()
                ->getRepository(Produit::class)
                ->find($id);

            $produit->setQte($qte);

        }

        $this->sess->set('panier', $produits_id);

        return $this->redirectToRoute("panier_show");
    }

    private function total()
    {

        @$prd = $this->sess->get('panier');
        $total = [];

        if ($prd) {
            foreach ($prd as $id => $qte) {
                $p = $produit = $this->getDoctrine()
                    ->getManager()
                    ->getRepository(Produit::class)
                    ->find($id);

                @$total["sous"] += $p->getQte() * $p->getPrix();
                @$total["tva"] = ($total["finale"] * 10) / 100;
                @$total["finale"] = $total["tva"] + $total["sous"];
            }
        }
        return $total;

    }

    public function nbProduits()
    {
        $panier = $this->sess->get('panier');
        @$nb = count($panier);
        return new Response($nb);
    }

    /**
     * @Route("/vider", name="panier_clear")
     */
    public function viderPanierAction()
    {
        $this->sess->set('panier', null);
        return $this->redirectToRoute("panier_show");

    }

    public function produitCountAction()
    {
        $panier = $this->sess->get('panier');
        @$nb = count($panier);
        return new Response($nb);
    }

}
