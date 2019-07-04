<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\Validator\Constraints as Assert;

/**

 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")

 * @UniqueEntity(fields={"email"}, message="Cet email existe déjà")

 */

class User implements UserInterface

{

    /**

     * @ORM\Id()

     * @ORM\GeneratedValue()

     * @ORM\Column(type="integer")

     */

    private $id;

    /**

     * @ORM\Column(type="string", length=180, unique=true)

     * @Assert\NotBlank(message="Le mail est obligatoire")

     * @Assert\Email(message="L'email n'est pas valide")

     */

    private $email;

    /**

     * @ORM\Column(type="string", length=50)

     * @Assert\NotBlank(message="Le nom est obligatoire")

     * @Assert\Length(max="50",

     *     maxMessage="Le nom ne doit pas faire plus de {{ 50 }} caractères")

     */

    private $lastname;

    /**

     * @ORM\Column(type="string", length=50)

     * @Assert\NotBlank(message="Le prénom est obligatoire")

     * @Assert\Length(max="50",

     *     maxMessage="Le nom ne doit pas faire plus de {{ 50 }} caractères.")

     */

    private $firstname;

    /**

     * @ORM\Column(type="string", length=15, nullable=true)

     */

    private $phone;

    /**

     * @ORM\Column(type="string", length=255)

     */

    private $password;

    /**

     * @ORM\ManyToOne(targetEntity="App\Entity\Address", inversedBy="users")

     * @ORM\JoinColumn(nullable=true)

     */

    private $address;

    /**

     * @ORM\OneToOne(targetEntity="App\Entity\Card", inversedBy="user", cascade={"persist", "remove"})

     */

    private $card;

    /**

     * @ORM\Column(type="date", nullable=true)

     */

    private $birthdate;

    public function getId(): ?int

    {

        return $this->id;

    }

    public function getEmail(): ?string

    {

        return $this->email;

    }

    public function setEmail(string $email): self

    {

        $this->email = $email;

        return $this;

    }

    /**

     * A visual identifier that represents this user.

     *

     * @see UserInterface

     */

    public function getUsername(): string

    {

        return (string) $this->email;

    }

    /**

     * @see UserInterface

     */

    public function getSalt()

    {

        return null;

    }

    /**

     * @see UserInterface

     */

    public function eraseCredentials()

    {

        // If you store any temporary, sensitive data on the user, clear it here

        //$this->plainPassword = null;

    }

    public function getLastname(): ?string

    {

        return $this->lastname;

    }

    public function setLastname(string $lastname): self

    {

        $this->lastname = $lastname;

        return $this;

    }

    public function getFirstname(): ?string

    {

        return $this->firstname;

    }

    public function setFirstname(string $firstname): self

    {

        $this->firstname = $firstname;

        return $this;

    }

    public function getPhone(): ?string

    {

        return $this->phone;

    }

    public function setPhone(?string $phone): self

    {

        $this->phone = $phone;

        return $this;

    }

    /**

     * Returns the roles granted to the user.

     *

     *     public function getRoles()

     *     {

     *         return ['ROLE_USER'];

     *     }

     *

     * Alternatively, the roles might be stored on a ``roles`` property,

     * and populated in any number of different ways when the user object

     * is created.

     *

     * @return (Role|string)[] The user roles

     */

    public function getRoles()

    {

        return ['ROLE_USER'];

    }

    /**

     * Returns the password used to authenticate the user.

     *

     * This should be the encoded password. On authentication, a plain-text

     * password will be salted, encoded, and then compared to this value.

     *

     * @return string The password

     */

    public function getPassword()

    {

        return $this->password;

    }

    public function setPassword(string $password): self

    {

        $this->password = $password;

        return $this;

    }

    public function getAddress(): ?Address

    {

        return $this->address;

    }

    public function setAddress(?Address $address): self

    {

        $this->address = $address;

        return $this;

    }

    public function getCard(): ?Card

    {

        return $this->card;

    }

    public function setCard(?Card $card): self

    {

        $this->card = $card;

        return $this;

    }

    public function getBirthdate(): ?\DateTimeInterface

    {

        return $this->birthdate;

    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self

    {

        $this->birthdate = $birthdate;

        return $this;

    }

}
