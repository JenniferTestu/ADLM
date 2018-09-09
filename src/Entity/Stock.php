<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StockRepository")
 */
class Stock
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $taille;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
    * @ORM\ManyToOne(targetEntity="Article")
    */
    private $article;

    /**
     * @ORM\Column(type="integer")
     */
    private $seuil;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getArticle(): ?int
    {
        return $this->article;
    }

    public function setArticle(int $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getSeuil(): ?int
    {
        return $this->seuil;
    }

    public function setSeuil(int $seuil): self
    {
        $this->seuil = $seuil;

        return $this;
    }
}
