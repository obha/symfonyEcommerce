<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="courtDesc", type="string", length=250, nullable=true)
     */
    private $courtDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="longDesc", type="string", length=255, nullable=true)
     */
    private $longDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="coverImage", type="string", length=255)
     */
    private $coverImage;

    /**
     * @var string
     *
     * @ORM\Column(name="firstimage", type="string", length=255, nullable=true)
     */
    private $firstimage;

    /**
     * @var string
     *
     * @ORM\Column(name="secondeimage", type="string", length=255, nullable=true)
     */
    private $secondeimage;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="decimal", precision=10, scale=3)
     */
    private $prix;

    /**
     * @ORM\Column(name="stock", type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(name="evaluation", type="decimal", nullable=true)
     */
    private $evaluation;

    /**
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="produits")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
     */
    private $categorie;

    private $qte;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Produit
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set courtDesc
     *
     * @param string $courtDesc
     *
     * @return Produit
     */
    public function setCourtDesc($courtDesc)
    {
        $this->courtDesc = $courtDesc;

        return $this;
    }

    /**
     * Get courtDesc
     *
     * @return string
     */
    public function getCourtDesc()
    {
        return $this->courtDesc;
    }

    /**
     * Set longDesc
     *
     * @param string $longDesc
     *
     * @return Produit
     */
    public function setLongDesc($longDesc)
    {
        $this->longDesc = $longDesc;

        return $this;
    }

    /**
     * Get longDesc
     *
     * @return string
     */
    public function getLongDesc()
    {
        return $this->longDesc;
    }

    /**
     * Set coverImage
     *
     * @param string $coverImage
     *
     * @return Produit
     */
    public function setCoverImage($coverImage)
    {
        $this->coverImage = $coverImage;

        return $this;
    }

    /**
     * Get coverImage
     *
     * @return string
     */
    public function getCoverImage()
    {
        return $this->coverImage;
    }

    /**
     * Set firstimage
     *
     * @param string $firstimage
     *
     * @return Produit
     */
    public function setFirstimage($firstimage)
    {
        $this->firstimage = $firstimage;

        return $this;
    }

    /**
     * Get firstimage
     *
     * @return string
     */
    public function getFirstimage()
    {
        return $this->firstimage;
    }

    /**
     * Set secondeimage
     *
     * @param string $secondeimage
     *
     * @return Produit
     */
    public function setSecondeimage($secondeimage)
    {
        $this->secondeimage = $secondeimage;

        return $this;
    }

    /**
     * Get secondeimage
     *
     * @return string
     */
    public function getSecondeimage()
    {
        return $this->secondeimage;
    }

    /**
     * Set prix
     *
     * @param string $prix
     *
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     *
     * @return Produit
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set evaluation
     *
     * @param string $evaluation
     *
     * @return Produit
     */
    public function setEvaluation($evaluation)
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    /**
     * Get evaluation
     *
     * @return string
     */
    public function getEvaluation()
    {
        return $this->evaluation;
    }

    /**
     * Set categorie
     *
     * @param \AppBundle\Entity\Categorie $categorie
     *
     * @return Produit
     */
    public function setCategorie(\AppBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \AppBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    public function getQte() :?int
    {
        return $this->qte;
    }

    public function setQte(?int $n) 
    {
        $this->qte = $n;

        return $this;
    }

}
