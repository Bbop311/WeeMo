<?php

namespace App\Entity;

use App\Repository\ListingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListingRepository::class)]
class Listing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $listing_title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $listing_description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $start_date = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $end_date = null;

    #[ORM\Column(length: 20)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'listings')]
    private ?Property $property = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getListingTitle(): ?string
    {
        return $this->listing_title;
    }

    public function setListingTitle(string $listing_title): static
    {
        $this->listing_title = $listing_title;

        return $this;
    }

    public function getListingDescription(): ?string
    {
        return $this->listing_description;
    }

    public function setListingDescription(string $listing_description): static
    {
        $this->listing_description = $listing_description;

        return $this;
    }

    public function getStartDate(): ?\DateTimeImmutable
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeImmutable $start_date): static
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeImmutable
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeImmutable $end_date): static
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

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
