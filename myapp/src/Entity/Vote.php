<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoteRepository")
 */
class Vote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="votes")
     */
    private $author;

    /**
     * @ORM\Column(type="integer")
     */
    private $forCount;

    /**
     * @ORM\Column(type="integer")
     */
    private $againstCount;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="integer")
     */
    private $state;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VoteEntry", mappedBy="voteID", orphanRemoval=true)
     */
    private $voteEntries;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="voteID", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\Column(type="integer")
     */
    private $supporters;

    public function __construct()
    {
        $this->voteEntries = new ArrayCollection();
        $this->comments = new ArrayCollection();

        $this->forCount = 0;
        $this->againstCount = 0;
        $this->state = 0;
        $this->dateCreated = new \DateTime('now');
        $this->supporters=0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getForCount(): ?int
    {
        return $this->forCount;
    }

    public function setForCount(int $forCount): self
    {
        $this->forCount = $forCount;

        return $this;
    }

    public function getAgainstCount(): ?int
    {
        return $this->againstCount;
    }

    public function setAgainstCount(int $againstCount): self
    {
        $this->againstCount = $againstCount;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(int $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return Collection|VoteEntry[]
     */
    public function getVoteEntries(): Collection
    {
        return $this->voteEntries;
    }

    public function addVoteEntry(VoteEntry $voteEntry): self
    {
        if (!$this->voteEntries->contains($voteEntry)) {
            $this->voteEntries[] = $voteEntry;
            $voteEntry->setVoteID($this);
        }

        return $this;
    }

    public function removeVoteEntry(VoteEntry $voteEntry): self
    {
        if ($this->voteEntries->contains($voteEntry)) {
            $this->voteEntries->removeElement($voteEntry);
            // set the owning side to null (unless already changed)
            if ($voteEntry->getVoteID() === $this) {
                $voteEntry->setVoteID(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setVoteID($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getVoteID() === $this) {
                $comment->setVoteID(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this->title;
    }

    public function getSupporters(): ?int
    {
        return $this->supporters;
    }

    public function setSupporters(int $supporters): self
    {
        $this->supporters = $supporters;

        return $this;
    }
}
