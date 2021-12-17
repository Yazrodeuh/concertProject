<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\OneToMany(targetEntity="App\Entity\Band", mappedBy="picture")
     * @ORM\JoinColumn(nullable=true)
     */
    private ArrayCollection $bands;

    /**
     * @ORM\OneToMany(targetEntity=Concert::class, mappedBy="picture")
     */
    private $concerts;

    /**
     * @ORM\OneToMany(targetEntity=Room::class, mappedBy="picture")
     */
    private $rooms;

    /**
     *
     */
    public function __construct()
    {
        $this->bands = new ArrayCollection();
        $this->concerts = new ArrayCollection();
        $this->rooms = new ArrayCollection();
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
}
