<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Categorie;
use AppBundle\Entity\Produit;
use AppBundle\Entity\Avis;
use AppBundle\Form\AvisType;
use AppBundle\Services\OBJSerializer;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="home_page")
     */
    public function indexAction()
    {

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'categories' => $this->getDoctrine()->getManager()->getRepository(Categorie::class)->findAll()
        ]);
    }

    /**
     * @Route("/categorie/{libelle}", name="shop_page")
     */
    public function categorieAction(Categorie $categorie)
    {
        // var_dump(ObjSerializer::serialize($categorie, 'json'));
        return $this->render('default/shop.html.twig', [
            'categories' => $this->getDoctrine()->getManager()->getRepository(Categorie::class)->findAll(),
            'produits' => $categorie->getProduits()
        ]);
    }

    /**
     * @Route("/produit/{libelle}", name="produit_page")
     */
    public function produitAction(Produit $produit, Request $request=null)
    {

        $em = $this
            ->getDoctrine()
            ->getManager();

        $avisRepo = $this->getDoctrine()->getRepository(Avis::class);

        $avis = new Avis();
        $avis->setProduit($produit);
        $avis->setCreatedAt(new \DateTime());
        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($avis);
            $em->flush();
        }

        
        return $this->render('default/produitDetails.html.twig', [
            'produit' => $produit,
            'avis' => $avisRepo->findBy(["produit" => $produit]),
            'formAvis' => $form->createView(),
        ]);
    }




}
