<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiProperty;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This is a dummy entity. Remove it!
 */
#[ApiResource(mercure: true)]
#[ORM\Entity]
class Greeting
{
    /**
     * The entity ID
     */
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    private ?int $id = null;

    /**
     * A nice person
     */
    #[ORM\Column]
    #[ApiProperty(security: 'is_granted("ROLE_ADMIN") || object?.ownerName == user.getUserIdentifier()')]
    #[Assert\NotBlank]
    public string $name = '';

    /**
     * A nice person
     */
    #[ORM\Column]
    #[ApiProperty(security: 'is_granted("ROLE_ADMIN")')]
    #[Assert\NotBlank]
    public string $ownerName = '';

    public function getId(): ?int
    {
        return $this->id;
    }
}
