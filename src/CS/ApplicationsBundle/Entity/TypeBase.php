<?php

namespace CS\ApplicationsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeBase
 *
 * @ORM\Table(name="types_bases")
 * @ORM\Entity(repositoryClass="CS\ApplicationsBundle\Repository\TypeBaseRepository")
 */
class TypeBase
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id_type", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idType;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_type", type="string", length=45, nullable=true)
     */
    private $libType;

    /**
     * Get idType
     *
     * @return integer
     */
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * Set libType
     *
     * @param string $libType
     *
     * @return TypeBase
     */
    public function setLibType($libType)
    {
        $this->libType = $libType;

        return $this;
    }

    /**
     * Get libType
     *
     * @return string
     */
    public function getLibType()
    {
        return $this->libType;
    }
}
