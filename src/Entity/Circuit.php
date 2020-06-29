<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CircuitRepository")
 */
class Circuit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text",nullable=false)
     */
    private $code_circuit;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $des_circuit;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree_circuit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EtapeCircuit", mappedBy="code_circuit", orphanRemoval=true)
     */
    private $code_circuit_etape;

    public function __construct()
    {
        $this->code_circuit_etape = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCircuit(): ?string
    {
        return $this->code_circuit;
    }

    public function setCodeCircuit(string $code_circuit): self
    {
        $this->code_circuit = $code_circuit;

        return $this;
    }

    public function getDesCircuit(): ?string
    {
        return $this->des_circuit;
    }

    public function setDesCircuit(?string $des_circuit): self
    {
        $this->des_circuit = $des_circuit;

        return $this;
    }

    public function getDureeCircuit(): ?int
    {
        return $this->duree_circuit;
    }

    public function setDureeCircuit(int $duree_circuit): self
    {
        $this->duree_circuit = $duree_circuit;

        return $this;
    }

    /**
     * @return Collection|EtapeCircuit[]
     */
    public function getCodeCircuitEtape(): Collection
    {
        return $this->code_circuit_etape;
    }

    public function addCodeCircuitEtape(EtapeCircuit $codeCircuitEtape): self
    {
        if (!$this->code_circuit_etape->contains($codeCircuitEtape)) {
            $this->code_circuit_etape[] = $codeCircuitEtape;
            $codeCircuitEtape->setCodeCircuit($this);
        }

        return $this;
    }

    public function removeCodeCircuitEtape(EtapeCircuit $codeCircuitEtape): self
    {
        if ($this->code_circuit_etape->contains($codeCircuitEtape)) {
            $this->code_circuit_etape->removeElement($codeCircuitEtape);
            // set the owning side to null (unless already changed)
            if ($codeCircuitEtape->getCodeCircuit() === $this) {
                $codeCircuitEtape->setCodeCircuit(null);
            }
        }

        return $this;
    }
}
