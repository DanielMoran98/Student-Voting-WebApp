<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vote", mappedBy="author")
     */
    private $votes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VoteEntry", mappedBy="author", orphanRemoval=true)
     */
    private $voteEntries;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="author", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SupportEntry", mappedBy="author", orphanRemoval=true)
     */
    private $supportEntries;

    public function __construct()
    {
        $this->votes = new ArrayCollection();
        $this->voteEntries = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->supportEntries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Vote[]
     */
    public function getVotes(): Collection
    {
        return $this->votes;
    }

    public function addVote(Vote $vote): self
    {
        if (!$this->votes->contains($vote)) {
            $this->votes[] = $vote;
            $vote->setAuthor($this);
        }

        return $this;
    }

    public function removeVote(Vote $vote): self
    {
        if ($this->votes->contains($vote)) {
            $this->votes->removeElement($vote);
            // set the owning side to null (unless already changed)
            if ($vote->getAuthor() === $this) {
                $vote->setAuthor(null);
            }
        }

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
            $voteEntry->setAuthor($this);
        }

        return $this;
    }

    public function removeVoteEntry(VoteEntry $voteEntry): self
    {
        if ($this->voteEntries->contains($voteEntry)) {
            $this->voteEntries->removeElement($voteEntry);
            // set the owning side to null (unless already changed)
            if ($voteEntry->getAuthor() === $this) {
                $voteEntry->setAuthor(null);
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
            $comment->setAuthor($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getAuthor() === $this) {
                $comment->setAuthor(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->username;
    }

    /**
     * @return Collection|SupportEntry[]
     */
    public function getSupportEntries(): Collection
    {
        return $this->supportEntries;
    }

    public function addSupportEntry(SupportEntry $supportEntry): self
    {
        if (!$this->supportEntries->contains($supportEntry)) {
            $this->supportEntries[] = $supportEntry;
            $supportEntry->setAuthor($this);
        }

        return $this;
    }

    public function removeSupportEntry(SupportEntry $supportEntry): self
    {
        if ($this->supportEntries->contains($supportEntry)) {
            $this->supportEntries->removeElement($supportEntry);
            // set the owning side to null (unless already changed)
            if ($supportEntry->getAuthor() === $this) {
                $supportEntry->setAuthor(null);
            }
        }

        return $this;
    }

}
