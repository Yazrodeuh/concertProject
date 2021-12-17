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
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private int $membersNumber;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private string $style;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Artist", inversedBy="bands")
     */
    private ArrayCollection $artists;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Concert", mappedBy="bands")
     */
    private ArrayCollection $concerts;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Picture", inversedBy="bands")
     */
    private ?Picture $picture;

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
    public function getName(): string
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
     * @return string|null
     */
    public function getStyle(): string
    {
        return $this->style;
    }

    /**
     * @param string $style
     * @return $this
     */
    public function setStyle(string $style): self
    {
        $this->style = $style;

        return $this;
    }



    /**
     * @return Collection|Artist[]
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function addArtist(Artist $artist): self
    {
        if (!$this->artists->contains($artist)) {
            $this->artists[] = $artist;
        }

        return $this;
    }

    /**
     * @param Artist $artist
     * @return $this
     */
    public function removeArtist(Artist $artist): self
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
     * @param Concert $concert
     * @return $this
     */
    public function addConcert(Concert $concert): self
    {
        if (!$this->concerts->contains($concert)) {
            $this->concerts[] = $concert;
            $concert->addBand($this);
        }

        return $this;
    }

    /**
     * @param Concert $concert
     * @return $this
     */
    public function removeConcert(Concert $concert): self
    {
        if ($this->concerts->removeElement($concert)) {
            $concert->removeBand($this);
        }

        return $this;
    }

    public function getPicture(): ?Picture
    {
        return $this->picture;
    }

    public function setPicture(?Picture $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

}
