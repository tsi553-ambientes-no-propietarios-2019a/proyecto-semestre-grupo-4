<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncidenciaRepository")
 */
class Incidencia
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Categoria", inversedBy="incidencias")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoria;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Denuncias", mappedBy="incidencia")
     */
    private $denuncias;

    public function __construct()
    {
        $this->denuncias = new ArrayCollection();
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

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * @return Collection|Denuncias[]
     */
    public function getDenuncias(): Collection
    {
        return $this->denuncias;
    }

    public function addDenuncia(Denuncias $denuncia): self
    {
        if (!$this->denuncias->contains($denuncia)) {
            $this->denuncias[] = $denuncia;
            $denuncia->setIncidencia($this);
        }

        return $this;
    }

    public function removeDenuncia(Denuncias $denuncia): self
    {
        if ($this->denuncias->contains($denuncia)) {
            $this->denuncias->removeElement($denuncia);
            // set the owning side to null (unless already changed)
            if ($denuncia->getIncidencia() === $this) {
                $denuncia->setIncidencia(null);
            }
        }

        return $this;
    }
}
