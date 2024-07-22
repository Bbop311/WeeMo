<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

#[ORM\Entity(repositoryClass: PropertyRepository::class)]
class Property
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $date_mutation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nature_mutation = null;

    #[ORM\Column(nullable: true)]
    private ?int $valeur_fonciere = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $no_voie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $b_t_q = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type_voie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code_voie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $voie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code_postal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $commune = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code_departement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code_commune = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $section = null;

    #[ORM\Column(nullable: true)]
    private ?int $nb_lots = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code_type_local = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type_local = null;

    #[ORM\Column(nullable: true)]
    private ?int $surface_reelle_bati = null;

    #[ORM\Column(nullable: true)]
    private ?int $nb_pieces = null;

    #[ORM\Column(nullable: true)]
    private ?int $surface_terrain = null;

    /**
     * @var Collection<int, Image>
     */
    #[ORM\OneToMany(targetEntity: Image::class, mappedBy: 'property')]
    private Collection $images;

    #[ORM\ManyToOne(inversedBy: 'property')]
    private ?User $user = null;

    /**
     * @var Collection<int, Listing>
     */
    #[ORM\OneToMany(targetEntity: Listing::class, mappedBy: 'property')]
    private Collection $listings;

    #[ORM\OneToOne(mappedBy: 'property', cascade: ['persist', 'remove'])]
    private ?PropertyFeatures $propertyFeatures = null;
    
    

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->listings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateMutation(): ?string
    {
        return $this->date_mutation;
    }

    public function setDateMutation(?string $date_mutation): static
    {
        $this->date_mutation = $date_mutation;

        return $this;
    }

    public function getNatureMutation(): ?string
    {
        return $this->nature_mutation;
    }

    public function setNatureMutation(?string $nature_mutation): static
    {
        $this->nature_mutation = $nature_mutation;

        return $this;
    }

    public function getValeurFonciere(): ?int
    {
        return $this->valeur_fonciere;
    }

    public function setValeurFonciere(?int $valeur_fonciere): static
    {
        $this->valeur_fonciere = $valeur_fonciere;

        return $this;
    }

    public function getNoVoie(): ?string
    {
        return $this->no_voie;
    }

    public function setNoVoie(?string $no_voie): static
    {
        $this->no_voie = $no_voie;

        return $this;
    }

    public function getBTQ(): ?string
    {
        return $this->b_t_q;
    }

    public function setBTQ(?string $b_t_q): static
    {
        $this->b_t_q = $b_t_q;

        return $this;
    }

    public function getTypeVoie(): ?string
    {
        return $this->type_voie;
    }

    public function setTypeVoie(?string $type_voie): static
    {
        $this->type_voie = $type_voie;

        return $this;
    }

    public function getCodeVoie(): ?string
    {
        return $this->code_voie;
    }

    public function setCodeVoie(?string $code_voie): static
    {
        $this->code_voie = $code_voie;

        return $this;
    }

    public function getVoie(): ?string
    {
        return $this->voie;
    }

    public function setVoie(?string $voie): static
    {
        $this->voie = $voie;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(?string $code_postal): static
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(?string $commune): static
    {
        $this->commune = $commune;

        return $this;
    }

    public function getCodeDepartement(): ?string
    {
        return $this->code_departement;
    }

    public function setCodeDepartement(?string $code_departement): static
    {
        $this->code_departement = $code_departement;

        return $this;
    }

    public function getCodeCommune(): ?string
    {
        return $this->code_commune;
    }

    public function setCodeCommune(?string $code_commune): static
    {
        $this->code_commune = $code_commune;

        return $this;
    }

    public function getSection(): ?string
    {
        return $this->section;
    }

    public function setSection(?string $section): static
    {
        $this->section = $section;

        return $this;
    }

    public function getNbLots(): ?int
    {
        return $this->nb_lots;
    }

    public function setNbLots(?int $nb_lots): static
    {
        $this->nb_lots = $nb_lots;

        return $this;
    }

    public function getCodeTypeLocal(): ?string
    {
        return $this->code_type_local;
    }

    public function setCodeTypeLocal(?string $code_type_local): static
    {
        $this->code_type_local = $code_type_local;

        return $this;
    }

    public function getTypeLocal(): ?string
    {
        return $this->type_local;
    }

    public function setTypeLocal(?string $type_local): static
    {
        $this->type_local = $type_local;

        return $this;
    }

    public function getSurfaceReelleBati(): ?int
    {
        return $this->surface_reelle_bati;
    }

    public function setSurfaceReelleBati(?int $surface_reelle_bati): static
    {
        $this->surface_reelle_bati = $surface_reelle_bati;

        return $this;
    }

    public function getNbPieces(): ?int
    {
        return $this->nb_pieces;
    }

    public function setNbPieces(?int $nb_pieces): static
    {
        $this->nb_pieces = $nb_pieces;

        return $this;
    }

    public function getSurfaceTerrain(): ?int
    {
        return $this->surface_terrain;
    }

    public function setSurfaceTerrain(?int $surface_terrain): static
    {
        $this->surface_terrain = $surface_terrain;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setProperty($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getProperty() === $this) {
                $image->setProperty(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    // public function setUser(?User $user): static
    // {
    //     $this->user = $user;

    //     return $this;
    // }
    
    //Fix property id not stored in user table
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Listing>
     */
    public function getListings(): Collection
    {
        return $this->listings;
    }

    public function addListing(Listing $listing): static
    {
        if (!$this->listings->contains($listing)) {
            $this->listings->add($listing);
            $listing->setProperty($this);
        }

        return $this;
    }

    public function removeListing(Listing $listing): static
    {
        if ($this->listings->removeElement($listing)) {
            // set the owning side to null (unless already changed)
            if ($listing->getProperty() === $this) {
                $listing->setProperty(null);
            }
        }

        return $this;
    }

    public function getPropertyFeatures(): ?PropertyFeatures
    {
        return $this->propertyFeatures;
    }

    public function setPropertyFeatures(?PropertyFeatures $propertyFeatures): static
    {
        // unset the owning side of the relation if necessary
        if ($propertyFeatures === null && $this->propertyFeatures !== null) {
            $this->propertyFeatures->setProperty(null);
        }

        // set the owning side of the relation if necessary
        if ($propertyFeatures !== null && $propertyFeatures->getProperty() !== $this) {
            $propertyFeatures->setProperty($this);
        }

        $this->propertyFeatures = $propertyFeatures;

        return $this;
    }

}
