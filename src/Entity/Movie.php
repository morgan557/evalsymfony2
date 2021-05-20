<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MovieRepository::class)
 */
class Movie
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $orginalName;

    /**
     * @ORM\Column(type="integer")
     */
    private $releaseDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $synopsis;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $seen;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $watchList;

    /**
     * @ORM\ManyToMany(targetEntity=Actor::class, inversedBy="movies")
     */
    private $actors;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, inversedBy="movies")
     */
    private $genres;

    /**
     * @ORM\ManyToMany(targetEntity=Studio::class, inversedBy="movies")
     */
    private $studio;

    public function __construct()
    {
        $this->actors = new ArrayCollection();
        $this->genres = new ArrayCollection();
        $this->studio = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOrginalName(): ?string
    {
        return $this->orginalName;
    }

    public function setOrginalName(string $orginalName): self
    {
        $this->orginalName = $orginalName;

        return $this;
    }

    public function getReleaseDate(): ?int
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(int $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(?string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getSeen(): ?bool
    {
        return $this->seen;
    }

    public function setSeen(?bool $seen): self
    {
        $this->seen = $seen;

        return $this;
    }

    public function getWatchList(): ?bool
    {
        return $this->watchList;
    }

    public function setWatchList(?bool $watchList): self
    {
        $this->watchList = $watchList;

        return $this;
    }

    /**
     * @return Collection|Actor[]
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Actor $actor): self
    {
        if (!$this->actors->contains($actor)) {
            $this->actors[] = $actor;
        }

        return $this;
    }

    public function removeActor(Actor $actor): self
    {
        $this->actors->removeElement($actor);

        return $this;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    /**
     * @return Collection|Studio[]
     */
    public function getStudio(): Collection
    {
        return $this->studio;
    }

    public function addStudio(Studio $studio): self
    {
        if (!$this->studio->contains($studio)) {
            $this->studio[] = $studio;
        }

        return $this;
    }

    public function removeStudio(Studio $studio): self
    {
        $this->studio->removeElement($studio);

        return $this;
    }

    public function __toString(){
        return $this->name;
    }
}
