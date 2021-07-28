<?php

namespace App\Entity;

use App\Repository\ImpressionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImpressionRepository::class)
 */
class Impression
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=Film::class)
     */
    private $datecreation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDatecreation(): ?Film
    {
        return $this->datecreation;
    }

    public function setDatecreation(?Film $datecreation): self
    {
        $this->datecreation = $datecreation;

        return $this;
    }
}
