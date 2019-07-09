<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuariosRepository")
 */
class Usuarios
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $apellido;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sobrenombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Denuncia", mappedBy="usuarios", orphanRemoval=true)
     */
    private $denuncia;

    public function __construct()
    {
        $this->denuncia = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getSobrenombre(): ?string
    {
        return $this->sobrenombre;
    }

    public function setSobrenombre(string $sobrenombre): self
    {
        $this->sobrenombre = $sobrenombre;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
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
     * @return Collection|Denuncia[]
     */
    public function getDenuncia(): Collection
    {
        return $this->denuncia;
    }

    public function addDenuncium(Denuncia $denuncium): self
    {
        if (!$this->denuncia->contains($denuncium)) {
            $this->denuncia[] = $denuncium;
            $denuncium->setUsuarios($this);
        }

        return $this;
    }

    public function removeDenuncium(Denuncia $denuncium): self
    {
        if ($this->denuncia->contains($denuncium)) {
            $this->denuncia->removeElement($denuncium);
            // set the owning side to null (unless already changed)
            if ($denuncium->getUsuarios() === $this) {
                $denuncium->setUsuarios(null);
            }
        }

        return $this;
    }
}
