<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $img_url = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?property $property = null;
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImgUrl(): ?string
    {
        return $this->img_url;
    }

    public function setImgUrl(string $img_url): static
    {
        $this->img_url = $img_url;

        return $this;
    }

    public function getProperty(): ?property
    {
        return $this->property;
    }

    public function setProperty(?property $property): static
    {
        $this->property = $property;

        return $this;
    }
   
}
