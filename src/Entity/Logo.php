<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LogoRepository")
 */
class Logo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var File|null
     *
     * @Assert\Image(
     *     maxSize="2M",
     *     mimeTypes={"image/jpeg"}
     * )
     */
    private $file;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Company", mappedBy="logo", cascade={"persist", "remove"})
     */
    private $company;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        // set (or unset) the owning side of the relation if necessary
        $newLogo = null === $company ? null : $this;
        if ($company->getLogo() !== $newLogo) {
            $company->setLogo($newLogo);
        }

        return $this;
    }

    /**
     * @param File|null $file
     * @return $this
     */
    public function setFile(?File $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getFile(): ?File
    {
        return $this->file;
    }
}
