<?php

namespace CS\ServeursBundle\Entity;

use Doctrine\ORM\Mapping as ORM ;

/**
 * Os
 *
 * @ORM\Table(name="os")
 * @ORM\Entity(repositoryClass="CS\ServeursBundle\Repository\OsRepository")
 */
class Os
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_os", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOs;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_os", type="string", length=45, nullable=true)
     */
    private $libOs;



    /**
     * Set libOs
     *
     * @param string $libOs
     *
     * @return Os
     */
    public function setLibOs($libOs)
    {
        $this->libOs = $libOs;

        return $this;
    }

    /**
     * Get libOs
     *
     * @return string
     */
    public function getLibOs()
    {
        return $this->libOs;
    }

    /**
     * Get idOs
     *
     * @return integer
     */
    public function getIdOs()
    {
        return $this->idOs;
    }
}
