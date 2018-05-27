<?php

namespace CS\UtilisateursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="roles")
 * @ORM\Entity(repositoryClass="CS\UtilisateursBundle\Repository\RoleRepository")
 */
class Role
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_role", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRole;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_role", type="string", length=45, nullable=true)
     */
    private $libRole;

    /**
     * Get idRole
     *
     * @return integer
     */
    public function getIdRole()
    {
        return $this->idRole;
    }

    /**
     * Set libRole
     *
     * @param string $libRole
     *
     * @return Role
     */
    public function setLibRole($libRole)
    {
        $this->libRole = $libRole;

        return $this;
    }

    /**
     * Get libRole
     *
     * @return string
     */
    public function getLibRole()
    {
        return $this->libRole;
    }
}
