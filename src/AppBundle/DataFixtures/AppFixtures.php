<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Avis;
use AppBundle\Entity\Categorie;
use AppBundle\Entity\Commande;
use AppBundle\Entity\Produit;
use AppBundle\Entity\ProduitCommande;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
        $faker->addProvider(new \Bezhanov\Faker\Provider\Placeholder($faker));

        for ($i = 0; $i < 10; $i++) {

            $categorie = new Categorie();
            $categorie->setLibelle($faker->department(1))
                ->setDescription($faker->sentence(6, true))
                ->setImage($faker->placeholder());

            // for ($j = 0; $j < 20; $j++) {

            //     $avis = new Avis();
            //     $produit = new Produit();

            //     $produit->setCategorie($categorie)
            //         ->setLibelle($faker->productName())
            //         ->setCoverImage($faker->placeholder())
            //         ->setFirstimage($faker->placeholder())
            //         ->setSecondeimage($faker->placeholder())
            //         ->setCourtDesc($faker->sentence(10, true))
            //         ->setLongDesc($faker->paragraph(1, true))
            //         ->setPrix(rand(18, 3000))
            //         ->setStock(rand(0, 40))
            //         ->setEvaluation(rand(0, 5));

            //     $avis->setProduit($produit)
            //         ->setCorp($faker->sentence(rand(3, 14)))
            //         ->setCreatedAt($faker->dateTime())
            //         ->setRate(rand(0, 5));

            //     $manager->persist($avis);
            //     $manager->persist($produit);
            // }

            // for ($k = 0; $k < 20; $k++) {
            //     $commande = new Commande();

            //     $commande->setNom($faker->firstName())
            //         ->setPrenom($faker->lastName())
            //         ->setEmail($faker->email())
            //         ->setCodePostal(rand(1000, 4000));

            //     $manager->persist($commande);
            // }

            for ($p = 0; $p < 20; $p++) {
                $avis = new Avis();
                $produit = new Produit();
                $commande = new Commande();
                $produitCommande = new ProduitCommande();

                $produit->setCategorie($categorie)
                    ->setLibelle($faker->word())
                    ->setCoverImage($faker->placeholder())
                    ->setFirstimage($faker->placeholder())
                    ->setSecondeimage($faker->placeholder())
                    ->setCourtDesc($faker->sentence(10, true))
                    ->setLongDesc($faker->paragraph(1, true))
                    ->setPrix(rand(18, 1400))
                    ->setStock(rand(0, 40))
                    ->setEvaluation(rand(0, 5));

                $commande->setNom($faker->firstName())
                    ->setPrenom($faker->lastName())
                    ->setEmail($faker->email())
                    ->setCodePostal(rand(1000, 4000));

                $produitCommande
                    ->setProduit($produit)
                    ->setCommande($commande)
                    ->setQte(rand(1, $produit->getStock()))
                    ->setPrix($produit->getPrix());

                $avis->setProduit($produit)
                    ->setCorp($faker->sentence(rand(3, 14)))
                    ->setCreatedAt($faker->dateTime())
                    ->setRate(rand(0, 5));

                $manager->persist($avis);

                $manager->persist($avis);
                $manager->persist($produit);
                $manager->persist($commande);
                $manager->persist($produitCommande);
            }

            $manager->persist($categorie);
        }

        $manager->flush();
    }

}
