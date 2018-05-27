<?php

namespace CS\ApplicationsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FichiersUp
 *
 * @ORM\Table(name="fichiers_up", indexes={@ORM\Index(name="ficher_auteur_idx", columns={"auteur"}), @ORM\Index(name="fichier_application_idx", columns={"application"})})
 * @ORM\Entity(repositoryClass="CS\ApplicationsBundle\Repository\FichiersUpRepository")
 */
class FichiersUp
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_fichier", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFichier;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_fichier", type="string", length=45, nullable=false)
     */
    private $nomFichier;

    /**
     * @var string
     *
     * @ORM\Column(name="chemin_fichier", type="string", length=100, nullable=false)
     */
    private $cheminFichier;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_upload", type="datetime", nullable=false)
     */
    private $dateUpload;

    /**
     * @var \CS\UtilisateursBundle\Entity\Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="\CS\UtilisateursBundle\Entity\Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="auteur", referencedColumnName="id_utilisateur")
     * })
     */
    private $auteur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Application", mappedBy="idFichier")
     */
    private $idApplication;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idApplication = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idFichier
     *
     * @return integer
     */
    public function getIdFichier()
    {
        return $this->idFichier;
    }

    /**
     * Set nomFichier
     *
     * @param string $nomFichier
     *
     * @return FichiersUp
     */
    public function setNomFichier($nomFichier)
    {
        $this->nomFichier = $nomFichier;

        return $this;
    }

    /**
     * Get nomFichier
     *
     * @return string
     */
    public function getNomFichier()
    {
        return $this->nomFichier;
    }

    /**
     * Set cheminFichier
     *
     * @param string $cheminFichier
     *
     * @return FichiersUp
     */
    public function setCheminFichier($cheminFichier)
    {
        $this->cheminFichier = $cheminFichier;

        return $this;
    }

    /**
     * Get cheminFichier
     *
     * @return string
     */
    public function getCheminFichier()
    {
        return $this->cheminFichier;
    }

    /**
     * Set dateUpload
     *
     * @param \DateTime $dateUpload
     *
     * @return FichiersUp
     */
    public function setDateUpload($dateUpload)
    {
        $this->dateUpload = $dateUpload;

        return $this;
    }

    /**
     * Get dateUpload
     *
     * @return \DateTime
     */
    public function getDateUpload()
    {
        return $this->dateUpload;
    }

    /**
     * Set auteur
     *
     * @param \CS\UtilisateursBundle\Entity\Utilisateur $auteur
     *
     * @return FichiersUp
     */
    public function setAuteur(\CS\UtilisateursBundle\Entity\Utilisateur $auteur = null)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return \CS\UtilisateursBundle\Entity\Utilisateur
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Add idApplication
     *
     * @param \CS\ApplicationsBundle\Entity\Application $idApplication
     *
     * @return FichiersUp
     */
    public function addIdApplication(\CS\ApplicationsBundle\Entity\Application $idApplication)
    {
        $this->idApplication[] = $idApplication;

        return $this;
    }

    /**
     * Remove idApplication
     *
     * @param \CS\ApplicationsBundle\Entity\Application $idApplication
     */
    public function removeIdApplication(\CS\ApplicationsBundle\Entity\Application $idApplication)
    {
        $this->idApplication->removeElement($idApplication);
    }

    /**
     * Get idApplication
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdApplication()
    {
        return $this->idApplication;
    }
}
