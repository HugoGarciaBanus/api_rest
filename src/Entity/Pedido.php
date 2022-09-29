<?php

namespace App\Entity;

use App\Repository\PedidoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PedidoRepository::class)
 */
class Pedido
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $total;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaEntrega;

    /**
     * @ORM\ManyToOne(targetEntity=Cliente::class, inversedBy="pedidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cliente;

    /**
     * @ORM\OneToOne(targetEntity=Direccion::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $direccion;

    /**
     * @ORM\OneToOne(targetEntity=Estado::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurante::class, inversedBy="pedidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $restaurante;

    /**
     * @ORM\OneToMany(targetEntity=PlatoCantidad::class, mappedBy="pedido", orphanRemoval=true)
     */
    private $platoCantidades;

    public function __construct()
    {
        $this->platoCantidades = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getFechaEntrega(): ?\DateTimeInterface
    {
        return $this->fechaEntrega;
    }

    public function setFechaEntrega(\DateTimeInterface $fechaEntrega): self
    {
        $this->fechaEntrega = $fechaEntrega;

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getDireccion(): ?Direccion
    {
        return $this->direccion;
    }

    public function setDireccion(Direccion $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getEstado(): ?Estado
    {
        return $this->estado;
    }

    public function setEstado(Estado $estado): self
    {
        $this->estado = $estado;

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

    /**
     * @return Collection<int, PlatoCantidad>
     */
    public function getPlatoCantidades(): Collection
    {
        return $this->platoCantidades;
    }

    public function addPlatoCantidade(PlatoCantidad $platoCantidade): self
    {
        if (!$this->platoCantidades->contains($platoCantidade)) {
            $this->platoCantidades[] = $platoCantidade;
            $platoCantidade->setPedido($this);
        }

        return $this;
    }

    public function removePlatoCantidade(PlatoCantidad $platoCantidade): self
    {
        if ($this->platoCantidades->removeElement($platoCantidade)) {
            // set the owning side to null (unless already changed)
            if ($platoCantidade->getPedido() === $this) {
                $platoCantidade->setPedido(null);
            }
        }

        return $this;
    }


}
