<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtapeCircuitRepository")
 */
class EtapeCircuit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree_etape;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $ordre_etape;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ville", inversedBy="code_ville_etape")
     * @ORM\JoinColumn(nullable=false)
     */
    private $code_ville;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Circuit", inversedBy="code_circuit_etape")
     * @ORM\JoinColumn(nullable=false)
     */
    private $code_circuit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDureeEtape(): ?int
    {
        return $this->duree_etape;
    }

    public function setDureeEtape(int $duree_circuit): self
    {
        $this->duree_etape = $duree_circuit;

        return $this;
    }

    public function getOrdreEtape(): ?string
    {
        return $this->ordre_etape;
    }

    public function setOrdreEtape(?string $ordre_etape): self
    {
        $this->ordre_etape = $ordre_etape;

        return $this;
    }

    public function getCodeVille(): ?Ville

    {
        return $this->code_ville;
    }

    public function setCodeVille(?Ville $code_ville): self
    {
        $this->code_ville = $code_ville;

        return $this;
    }

    public function getCodeCircuit(): ?circuit
    {
        return $this->code_circuit;
    }

    public function setCodeCircuit(?circuit $code_circuit): self
    {
        $this->code_circuit = $code_circuit;

        return $this;
    }
}
