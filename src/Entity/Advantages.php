<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdvantagesRepository")
 */
class Advantages
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $discount;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $free_games;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $goodies = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function setDiscount(?int $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getFreeGames(): ?int
    {
        return $this->free_games;
    }

    public function setFreeGames(?int $free_games): self
    {
        $this->free_games = $free_games;

        return $this;
    }

    public function getGoodies(): ?array
    {
        return $this->goodies;
    }

    public function setGoodies(?array $goodies): self
    {
        $this->goodies = $goodies;

        return $this;
    }
}
