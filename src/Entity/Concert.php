<?php

namespace App\Entity;

use App\Repository\ConcertRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConcertRepository::class)
 */
class Concert
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $full;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Band", inversedBy="concerts")
     */
    private ArrayCollection $bands;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Room", mappedBy="concerts")
     */
    private ArrayCollection $rooms;

    /**
     *
     */
    public function __construct()
    {
        $this->bands = new ArrayCollection();
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
     * @return bool|null
     */
    public function getFull(): ?bool
    {
        return $this->full;
    }

    /**
     * @param bool $full
     * @return $this
     */
    public function setFull(bool $full): self
    {
        $this->full = $full;

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
     * @param Band $band
     * @return $this
     */
    public function addBand(Band $band): self
    {
        if (!$this->bands->contains($band)) {
            $this->bands[] = $band;
        }

        return $this;
    }

    /**
     * @param Band $band
     * @return $this
     */
    public function removeBand(Band $band): self
    {
        $this->bands->removeElement($band);

        return $this;
    }

    /**
     * @return Collection|Room[]
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    /**
     * @param Room $room
     * @return $this
     */
    public function addRoom(Room $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
            $room->addConcert($this);
        }

        return $this;
    }

    /**
     * @param Room $room
     * @return $this
     */
    public function removeRoom(Room $room): self
    {
        if ($this->rooms->removeElement($room)) {
            $room->removeConcert($this);
        }

        return $this;
    }
}
