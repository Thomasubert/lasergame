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
    private $codeCenter=123;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le code de la carte ne peut pas être nul.")
     */
    private $codeCard;

    /**
     * @ORM\Column(type="integer")
     */
    private $checksum;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $status = "libre";

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number_of_games;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="card", cascade={"persist", "remove"})
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCentre(): ?int
    {
        return $this->codeCenter;
    }

    public function setCodeCentre(int $code_center): self
    {
        $this->codeCenter = $code_center;

        return $this;
    }

    public function getCodeCard(): ?int
    {
        return $this->codeCard;
    }

    public function setCodeCard(int $codeCard): self
    {
        $this->codeCard = $codeCard;

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

    public function getStatus():?string
    {
        return $this->status;
    }



    public function setStatus($status): self
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        // set (or unset) the owning side of the relation if necessary
        $newCard = $user === null ? null : $this;
        if ($newCard !== $user->getCard()) {
            $user->setCard($newCard);
        }

        return $this;
    }
}
