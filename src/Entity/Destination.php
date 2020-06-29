<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DestinationRepository")
 */
class Destination
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
    private $code_dest;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $des_dest;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeDest(): ?int
    {
        return $this->code_dest;
    }

    public function setCodeDest(int $code_dest): self
    {
        $this->code_dest = $code_dest;

        return $this;
    }

    public function getDesDest(): ?string
    {
        return $this->des_dest;
    }

    public function setDesDest(?string $des_dest): self
    {
        $this->des_dest = $des_dest;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
