<?php

namespace CS\ServeursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeServeur
 *
 * @ORM\Table(name="types_serveurs")
 * @ORM\Entity(repositoryClass="CS\ServeursBundle\Repository\TypeServeurRepository")
 */
class TypeServeur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_type_serveur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTypeServeur;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_type_serveur", type="string", length=45, nullable=true)
     */
    private $libTypeServeur;

    /**
     * Get idTypeServeur
     *
     * @return integer
     */
    public function getIdTypeServeur()
    {
        return $this->idTypeServeur;
    }

    /**
     * Set libTypeServeur
     *
     * @param string $libTypeServeur
     *
     * @return TypeServeur
     */
    public function setLibTypeServeur($libTypeServeur)
    {
        $this->libTypeServeur = $libTypeServeur;

        return $this;
    }

    /**
     * Get libTypeServeur
     *
     * @return string
     */
    public function getLibTypeServeur()
    {
        return $this->libTypeServeur;
    }
}
