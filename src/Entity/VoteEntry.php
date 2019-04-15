<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoteEntryRepository")
 */
class VoteEntry
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\vote", inversedBy="voteEntries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $voteID;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="voteEntries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $opinion;

    public function __construct($vote, $author, $opinion)
    {
        $this->voteID = $vote;
        $this->author = $author;
        $this->opinion = $opinion;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVoteID(): ?vote
    {
        return $this->voteID;
    }

    public function setVoteID(?vote $voteID): self
    {
        $this->voteID = $voteID;

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

    public function getOpinion(): ?string
    {
        return $this->opinion;
    }

    public function setOpinion(string $opinion): self
    {
        $this->opinion = $opinion;

        return $this;
    }
}
