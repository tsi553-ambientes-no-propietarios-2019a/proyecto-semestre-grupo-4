<?php
// src/Entity/User.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Denuncias", mappedBy="user")
     */
    private $denuncias;

    public function __construct()
    {
        parent::__construct();
        $this->denuncias = new ArrayCollection();
        // your own logic
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
            $denuncia->setUser($this);
        }

        return $this;
    }

    public function removeDenuncia(Denuncias $denuncia): self
    {
        if ($this->denuncias->contains($denuncia)) {
            $this->denuncias->removeElement($denuncia);
            // set the owning side to null (unless already changed)
            if ($denuncia->getUser() === $this) {
                $denuncia->setUser(null);
            }
        }

        return $this;
    }
}