<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="t_user")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="idUser")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=180, unique=true, name="useUsername")
     */
    private $username;

    /**
     * @ORM\Column(type="json", name="useRoles")
     */
    private $roles = [];

    /**
     * @Assert\NotBlank
     * @var string The hashed password
     * @ORM\Column(type="string", name="usePassword")
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return (string)$this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $roles[] = 'ROLE_USER';
        $this->roles = array_unique($roles);

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('username', new NotBlank());

        $metadata->addPropertyConstraint('password', new NotBlank());

    }
}
