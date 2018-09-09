<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
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
    private $cat;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $sousCat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCat(): ?string
    {
        return $this->cat;
    }

    public function setCat(string $cat): self
    {
        $this->cat = $cat;

        return $this;
    }

    public function getSousCat(): ?string
    {
        return $this->sousCat;
    }

    public function setSousCat(string $sousCat): self
    {
        $this->sousCat = $sousCat;

        return $this;
    }

    public function getCatAndSousCat(): ?string
    {
        $sc = $this -> getSousCat();
        $c = $this -> getCat();
        return $c." - ".$sc;
    }
}
