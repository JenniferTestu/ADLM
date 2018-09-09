<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="float")
     */
    private $total;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $statut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateLivraison;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $modePaiement;

    /**
    * @ORM\ManyToOne(targetEntity="Utilisateur")
    */
    private $client;

    /**
    * @ORM\ManyToMany(targetEntity="ArticlePanier")
    */
    private $articles;

    /**
    * @ORM\OneToOne(targetEntity="Adresse")
    */
    private $lieuLivraison;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->dateLivraison;
    }

    public function setDateLivraison(\DateTimeInterface $dateLivraison): self
    {
        $this->dateLivraison = $dateLivraison;

        return $this;
    }

    public function getModePaiement(): ?string
    {
        return $this->modePaiement;
    }

    public function setModePaiement(string $modePaiement): self
    {
        $this->modePaiement = $modePaiement;

        return $this;
    }

    public function getClient(): ?Utilisateur
    {
        return $this->client;
    }

    public function setClient(?Utilisateur $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection|ArticlePanier[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(ArticlePanier $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
        }

        return $this;
    }

    public function removeArticle(ArticlePanier $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
        }

        return $this;
    }

    public function getLieuLivraison(): ?Adresse
    {
        return $this->lieuLivraison;
    }

    public function setLieuLivraison(?Adresse $lieuLivraison): self
    {
        $this->lieuLivraison = $lieuLivraison;

        return $this;
    }
}
