<?php

namespace CS\UtilisateursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fonction
 *
 * @ORM\Table(name="fonctions")
 * @ORM\Entity(repositoryClass="CS\UtilisateursBundle\Repository\FonctionRepository")
 */
class Fonction
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_fonction", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFonction;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_fonction", type="string", length=45, nullable=true)
     */
    private $libFonction;

    /**
     * Get idFonction
     *
     * @return integer
     */
    public function getIdFonction()
    {
        return $this->idFonction;
    }

    /**
     * Set libFonction
     *
     * @param string $libFonction
     *
     * @return Fonction
     */
    public function setLibFonction($libFonction)
    {
        $this->libFonction = $libFonction;

        return $this;
    }

    /**
     * Get libFonction
     *
     * @return string
     */
    public function getLibFonction()
    {
        return $this->libFonction;
    }
}
