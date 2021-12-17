<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoomRepository::class)
 */
class Room
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
     * @ORM\OneToMany(targetEntity="App\Entity\Concert", mappedBy="rooms")
     * @ORM\JoinColumn(nullable=true)
     */
    private $concerts;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Organizer", inversedBy="rooms")
     * @ORM\JoinColumn(nullable=true)
     */
    private Organizer $organizer;

    /**
     *
     */
    public function __construct()
    {
        $this->concerts = new ArrayCollection();
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
        }

        return $this;
    }

    /**
     * @param Concert|null $concert
     * @return $this
     */
    public function removeConcert(?Concert $concert): self
    {
        $this->concerts->removeElement($concert);

        return $this;
    }

    /**
     * @return Organizer|null
     */
    public function getOrganizer(): ?Organizer
    {
        return $this->organizer;
    }

    /**
     * @param Organizer|null $organizer
     * @return $this
     */
    public function setOrganizer(?Organizer $organizer): self
    {
        $this->organizer = $organizer;

        return $this;
    }
}
