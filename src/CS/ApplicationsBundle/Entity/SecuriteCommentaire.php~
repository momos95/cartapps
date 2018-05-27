<?php

namespace CS\ApplicationsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecuriteCommentaire
 *
 * @ORM\Table(name="securite_commentaire", uniqueConstraints={@ORM\UniqueConstraint(name="lib_securite", columns={"lib_securite"})})
 * @ORM\Entity(repositoryClass="CS\ApplicationsBundle\Repository\SecuriteCommentaireRepository")
 *
 */
class SecuriteCommentaire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_securite", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSecurite;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_securite", type="string", length=50, nullable=false)
     */
    private $libSecurite;



    /**
     * Get idSecurite
     *
     * @return integer
     */
    public function getIdSecurite()
    {
        return $this->idSecurite;
    }

    /**
     * Set libSecurite
     *
     * @param string $libSecurite
     *
     * @return SecuriteCommentaire
     */
    public function setLibSecurite($libSecurite)
    {
        $this->libSecurite = $libSecurite;

        return $this;
    }

    /**
     * Get libSecurite
     *
     * @return string
     */
    public function getLibSecurite()
    {
        return $this->libSecurite;
    }
}
