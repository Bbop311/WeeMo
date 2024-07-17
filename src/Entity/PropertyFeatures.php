<?php

namespace App\Entity;

use App\Repository\PropertyFeaturesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PropertyFeaturesRepository::class)]
class PropertyFeatures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $type_of_rooms = null;

    #[ORM\Column(nullable: true)]
    private ?int $number_of_bedrooms = null;

    #[ORM\Column(nullable: true)]
    private ?int $floor = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $property_condition = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $energy_class = null;

    #[ORM\Column(nullable: true)]
    private ?bool $elevator = null;

    #[ORM\Column(nullable: true)]
    private ?bool $balcony = null;

    #[ORM\Column(nullable: true)]
    private ?bool $parking = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $heating_type = null;

    #[ORM\Column(nullable: true)]
    private ?bool $air_condition = null;

    #[ORM\OneToOne(inversedBy: 'propertyFeatures', cascade: ['persist', 'remove'])]
    private ?Property $property = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeOfRooms(): ?string
    {
        return $this->type_of_rooms;
    }

    public function setTypeOfRooms(?string $type_of_rooms): static
    {
        $this->type_of_rooms = $type_of_rooms;

        return $this;
    }

    public function getNumberOfBedrooms(): ?int
    {
        return $this->number_of_bedrooms;
    }

    public function setNumberOfBedrooms(?int $number_of_bedrooms): static
    {
        $this->number_of_bedrooms = $number_of_bedrooms;

        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(?int $floor): static
    {
        $this->floor = $floor;

        return $this;
    }

    public function getPropertyCondition(): ?string
    {
        return $this->property_condition;
    }

    public function setPropertyCondition(?string $property_condition): static
    {
        $this->property_condition = $property_condition;

        return $this;
    }

    public function getEnergyClass(): ?string
    {
        return $this->energy_class;
    }

    public function setEnergyClass(?string $energy_class): static
    {
        $this->energy_class = $energy_class;

        return $this;
    }

    public function isElevator(): ?bool
    {
        return $this->elevator;
    }

    public function setElevator(?bool $elevator): static
    {
        $this->elevator = $elevator;

        return $this;
    }

    public function isBalcony(): ?bool
    {
        return $this->balcony;
    }

    public function setBalcony(?bool $balcony): static
    {
        $this->balcony = $balcony;

        return $this;
    }

    public function isParking(): ?bool
    {
        return $this->parking;
    }

    public function setParking(?bool $parking): static
    {
        $this->parking = $parking;

        return $this;
    }

    public function getHeatingType(): ?string
    {
        return $this->heating_type;
    }

    public function setHeatingType(?string $heating_type): static
    {
        $this->heating_type = $heating_type;

        return $this;
    }

    public function isAirCondition(): ?bool
    {
        return $this->air_condition;
    }

    public function setAirCondition(?bool $air_condition): static
    {
        $this->air_condition = $air_condition;

        return $this;
    }

    public function getProperty(): ?Property
    {
        return $this->property;
    }

    public function setProperty(?Property $property): static
    {
        $this->property = $property;

        return $this;
    }
}
