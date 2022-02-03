<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PictureRepository::class)
 */
class Picture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="text")
     */
    private string $alternativeName;

    /**
     * @ORM\Column(type="text")
     */
    private string $url;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Band", mappedBy="picture")
     * @ORM\JoinColumn(nullable=true)
     */
    private $bands;

    /**
     * @ORM\OneToOne(targetEntity=Concert::class, mappedBy="picture")
     * @ORM\JoinColumn(nullable=true)
     */
    private $concerts;

    /**
     * @ORM\OneToOne(targetEntity=Room::class, mappedBy="picture")
     * @ORM\JoinColumn(nullable=true)
     */
    private $rooms;

    /**
     * @ORM\OneToOne(targetEntity=Artist::class, mappedBy="picture")
     * @ORM\JoinColumn(nullable=true)
     */
    private $artists;

    /**
     *
     */
    public function __construct()
    {
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
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
     * @return string|null
     */
    public function getAlternativeName(): ?string
    {
        return $this->alternativeName;
    }

    /**
     * @param string $alternativeName
     * @return $this
     */
    public function setAlternativeName(string $alternativeName): self
    {
        $this->alternativeName = $alternativeName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection|Band[]
     */
    public function getBands(): Collection
    {
        return $this->bands;
    }

    /**
     * @param Band|null $band
     * @return $this
     */
    public function addBand(?Band $band): self
    {
        if (!$this->bands->contains($band)) {
            $this->bands[] = $band;
            $band->setPicture($this);
        }

        return $this;
    }

    /**
     * @param Band|null $band
     * @return $this
     */
    public function removeBand(?Band $band): self
    {
        if ($this->bands->removeElement($band)) {
            // set the owning side to null (unless already changed)
            if ($band->getPicture() === $this) {
                $band->setPicture(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Concert[]
     */
    public function getConcerts(): Collection
    {
        return $this->concerts;
    }

    public function setConcerts(?Concert $concerts): self
    {
        // unset the owning side of the relation if necessary
        if ($concerts === null && $this->concerts !== null) {
            $this->concerts->setPicture(null);
        }

        // set the owning side of the relation if necessary
        if ($concerts !== null && $concerts->getPicture() !== $this) {
            $concerts->setPicture($this);
        }

        $this->concerts = $concerts;

        return $this;
    }

    public function addConcert(Concert $concert): self
    {
        if (!$this->concerts->contains($concert)) {
            $this->concerts[] = $concert;
            $concert->setPicture($this);
        }

        return $this;
    }

    public function removeConcert(Concert $concert): self
    {
        if ($this->concerts->removeElement($concert)) {
            // set the owning side to null (unless already changed)
            if ($concert->getPicture() === $this) {
                $concert->setPicture(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Room[]
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function setRooms(?Room $rooms): self
    {
        // unset the owning side of the relation if necessary
        if ($rooms === null && $this->rooms !== null) {
            $this->rooms->setPicture(null);
        }

        // set the owning side of the relation if necessary
        if ($rooms !== null && $rooms->getPicture() !== $this) {
            $rooms->setPicture($this);
        }

        $this->rooms = $rooms;

        return $this;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
            $room->setPicture($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): self
    {
        if ($this->rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getPicture() === $this) {
                $room->setPicture(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Artist[]
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function setArtists(?Artist $artists): self
    {
        // unset the owning side of the relation if necessary
        if ($artists === null && $this->artists !== null) {
            $this->artists->setPicture(null);
        }

        // set the owning side of the relation if necessary
        if ($artists !== null && $artists->getPicture() !== $this) {
            $artists->setPicture($this);
        }

        $this->artists = $artists;

        return $this;
    }

    public function addArtist(Artist $artist): self
    {
        if (!$this->artists->contains($artist)) {
            $this->artists[] = $artist;
            $artist->setPicture($this);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): self
    {
        if ($this->artists->removeElement($artist)) {
            // set the owning side to null (unless already changed)
            if ($artist->getPicture() === $this) {
                $artist->setPicture(null);
            }
        }

        return $this;
    }
}
