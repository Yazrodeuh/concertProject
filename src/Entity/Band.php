<?php

namespace App\Entity;

use App\Repository\BandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BandRepository::class)
 *
 */
class Band
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private string $name;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private int $membersNumber;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $style;


    /**
     * @ORM\ManyToMany(targetEntity=Artist::class, inversedBy="bands")
     * @ORM\JoinColumn(nullable=true)
     */
    private $artists;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Concert", mappedBy="bands")
     * @ORM\JoinColumn(nullable=true)
     */
    private $concerts;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Picture", inversedBy="bands")
     * @ORM\JoinColumn(nullable=true)
     */
    private ?Picture $picture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $urlName;

    /**
     *
     */
    public function __construct()
    {
        $this->artists = new ArrayCollection();
        $this->concerts = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getMembersNumber(): int
    {
        return $this->membersNumber;
    }

    /**
     * @param int $membersNumber
     * @return $this
     */
    public function setMembersNumber(int $membersNumber): self
    {
        $this->membersNumber = $membersNumber;

        return $this;
    }



    /**
     * @return Collection|Artist[]
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    /**
     * @param Artist|null $artist
     * @return $this
     */
    public function addArtist(?Artist $artist): self
    {
        if (!$this->artists->contains($artist)) {
            $this->artists[] = $artist;
        }

        return $this;
    }

    /**
     * @param Artist|null $artist
     * @return $this
     */
    public function removeArtist(?Artist $artist): self
    {
        $this->artists->removeElement($artist);

        return $this;
    }

    /**
     * @return Collection|Concert[]
     */
    public function getConcerts(): Collection
    {
        return $this->concerts;
    }

    /**
     * @param Concert|null $concert
     * @return $this
     */
    public function addConcert(?Concert $concert): self
    {
        if (!$this->concerts->contains($concert)) {
            $this->concerts[] = $concert;
            $concert->addBand($this);
        }

        return $this;
    }

    /**
     * @param Concert|null $concert
     * @return $this
     */
    public function removeConcert(?Concert $concert): self
    {
        if ($this->concerts->removeElement($concert)) {
            $concert->removeBand($this);
        }

        return $this;
    }

    /**
     * @return Picture|null
     */
    public function getPicture(): ?Picture
    {
        return $this->picture;
    }

    /**
     * @param Picture|null $picture
     * @return $this
     */
    public function setPicture(?Picture $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStyle(): ?string
    {
        return $this->style;
    }

    /**
     * @param string|null $style
     * @return $this
     */
    public function setStyle(?string $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function getUrlName(): ?string
    {
        return $this->urlName;
    }

    public function setUrlName(string $urlName): self
    {
        $this->urlName = $urlName;

        return $this;
    }

}
