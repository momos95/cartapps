<?php

namespace CS\ApplicationsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeCommentaire
 *
 * @ORM\Table(name="type_commentaire", uniqueConstraints={@ORM\UniqueConstraint(name="lib_type", columns={"lib_type"})})
 * @ORM\Entity(repositoryClass="CS\ApplicationsBundle\Repository\TypeCommentaireRepository")
 */
class TypeCommentaire
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
     * @ORM\Column(name="lib_type", type="string", length=50, nullable=false)
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
     * @return TypeCommentaire
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
