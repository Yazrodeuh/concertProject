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
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    private string $name;


    /**
     * @ORM\Column(type="boolean")
     */
    private bool $full;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Band", inversedBy="concerts")
     * @ORM\JoinColumn(nullable=true)
     */
    private $bands;

    /**
     * @ORM\ManyToOne (targetEntity="App\Entity\Room", inversedBy="concerts")
     * @ORM\JoinColumn(nullable=true)
     */
    private $room;

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
     * @param Band|null $band
     * @return $this
     */
    public function addBand(?Band $band): self
    {
        if (!$this->bands->contains($band)) {
            $this->bands[] = $band;
        }

        return $this;
    }

    /**
     * @param Band|null $band
     * @return $this
     */
    public function removeBand(?Band $band): self
    {
        $this->bands->removeElement($band);

        return $this;
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
     * @return Concert
     */
    public function setName(string $name): Concert
    {
        $this->name = $name;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }

}
