<?php

namespace App\Entity;

use App\Repository\HorarioRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HorarioRepository::class)
 */
class Horario
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $dia;

    /**
     * @ORM\Column(type="time")
     */
    private $apertura;

    /**
     * @ORM\Column(type="time")
     */
    private $cierre;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurante::class, inversedBy="horarios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $restaurante;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDia(): ?int
    {
        return $this->dia;
    }

    public function setDia(int $dia): self
    {
        $this->dia = $dia;

        return $this;
    }

    public function getApertura(): ?\DateTimeInterface
    {
        return $this->apertura;
    }

    public function setApertura(\DateTimeInterface $apertura): self
    {
        $this->apertura = $apertura;

        return $this;
    }

    public function getCierre(): ?\DateTimeInterface
    {
        return $this->cierre;
    }

    public function setCierre(\DateTimeInterface $cierre): self
    {
        $this->cierre = $cierre;

        return $this;
    }

    public function getRestaurante(): ?Restaurante
    {
        return $this->restaurante;
    }

    public function setRestaurante(?Restaurante $restaurante): self
    {
        $this->restaurante = $restaurante;

        return $this;
    }
}
