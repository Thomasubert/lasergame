<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CardRepository")
 *
 */
class Card
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le code du centre de ne peut pas être nul.")
     *
     */
    private $code_center = 132;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le code de la carte ne peut pas être nul.")
     */
    private $code_card;

    /**
     * @ORM\Column(type="integer")
     */
    private $checksum;

    /**
     * @ORM\Column(type="array")
     */
    private $status = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number_of_games;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCentre(): ?int
    {
        return $this->code_center;
    }

    public function setCodeCentre(int $code_center): self
    {
        $this->code_center = $code_center;

        return $this;
    }

    public function getCodeCard(): ?int
    {
        return $this->code_card;
    }

    public function setCodeCard(int $code_card): self
    {
        $this->code_card = $code_card;

        return $this;
    }

    public function getChecksum(): ?int
    {
        return $this->checksum;
    }

    public function setChecksum(int $checksum): self
    {
        $this->checksum = $checksum;

        return $this;
    }

    public function getStatus(): ?array
    {
        return $this->status;
    }

    public function setStatus(array $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getNumberOfGames(): ?int
    {
        return $this->number_of_games;
    }

    public function setNumberOfGames(?int $number_of_games): self
    {
        $this->number_of_games = $number_of_games;

        return $this;
    }
}
