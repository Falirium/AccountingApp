<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $idProduit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categoryProduit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeProduit;

    /**
     * @ORM\Column(type="float")
     */
    private $prixUnitProduit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomProduit;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionProduit;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $designationProduit;

    /**
     * @ORM\ManyToMany(targetEntity=Commande::class, mappedBy="produits")
     */
    private $commandes;

    /**
     * @ORM\Column(type="integer")
     */
    private $stockProduit;

    /**
     * @ORM\Column(type="float")
     */
    private $taxeProduit;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProduit(): ?string
    {
        return $this->idProduit;
    }

    public function setIdProduit(string $idProduit): self
    {
        $this->idProduit = $idProduit;

        return $this;
    }

    public function getCategoryProduit(): ?string
    {
        return $this->categoryProduit;
    }

    public function setCategoryProduit(string $categoryProduit): self
    {
        $this->categoryProduit = $categoryProduit;

        return $this;
    }

    public function getTypeProduit(): ?string
    {
        return $this->typeProduit;
    }

    public function setTypeProduit(string $typeProduit): self
    {
        $this->typeProduit = $typeProduit;

        return $this;
    }

    public function getPrixUnitProduit(): ?float
    {
        return $this->prixUnitProduit;
    }

    public function setPrixUnitProduit(float $prixUnitProduit): self
    {
        $this->prixUnitProduit = $prixUnitProduit;

        return $this;
    }

    public function getNomProduit(): ?string
    {
        return $this->nomProduit;
    }

    public function setNomProduit(string $nomProduit): self
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }

    public function getDescriptionProduit(): ?string
    {
        return $this->descriptionProduit;
    }

    public function setDescriptionProduit(?string $descriptionProduit): self
    {
        $this->descriptionProduit = $descriptionProduit;

        return $this;
    }

    public function getDesignationProduit(): ?string
    {
        return $this->designationProduit;
    }

    public function setDesignationProduit(?string $designationProduit): self
    {
        $this->designationProduit = $designationProduit;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->addProduit($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            $commande->removeProduit($this);
        }

        return $this;
    }

    public function getStockProduit(): ?int
    {
        return $this->stockProduit;
    }

    public function setStockProduit(int $stockProduit): self
    {
        $this->stockProduit = $stockProduit;

        return $this;
    }

    public function getTaxeProduit(): ?float
    {
        return $this->taxeProduit;
    }

    public function setTaxeProduit(float $taxeProduit): self
    {
        $this->taxeProduit = $taxeProduit;

        return $this;
    }
}
