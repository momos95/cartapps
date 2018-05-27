<?php

namespace CS\ApplicationsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Commentaire
 *
 * @ORM\Table(name="commentaires", indexes={@ORM\Index(name="commentaire_auteur_idx", columns={"auteur"}), @ORM\Index(name="type", columns={"type"}), @ORM\Index(name="securite", columns={"securite"})})
 * @ORM\Entity(repositoryClass="CS\ApplicationsBundle\Repository\CommentaireRepository")
 */
class Commentaire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_commentaire", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCommentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text", length=65535, nullable=false)
     */
    private $texte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_commentaire", type="datetime", nullable=false)
     */
    private $dateCommentaire ;

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
     * @var \SecuriteCommentaire
     *
     * @ORM\ManyToOne(targetEntity="SecuriteCommentaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="securite", referencedColumnName="id_securite")
     * })
     */
    private $securite;

    /**
     * @var \TypeCommentaire
     *
     * @ORM\ManyToOne(targetEntity="TypeCommentaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type", referencedColumnName="id_type")
     * })
     */
    private $type;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Application", mappedBy="idCommentaire")
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
     * Get idCommentaire
     *
     * @return integer
     */
    public function getIdCommentaire()
    {
        return $this->idCommentaire;
    }

    /**
     * Set texte
     *
     * @param string $texte
     *
     * @return Commentaire
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set dateCommentaire
     *
     * @param \DateTime $dateCommentaire
     *
     * @return Commentaire
     */
    public function setDateCommentaire($dateCommentaire)
    {
        $this->dateCommentaire = $dateCommentaire;

        return $this;
    }

    /**
     * Get dateCommentaire
     *
     * @return \DateTime
     */
    public function getDateCommentaire()
    {
        return $this->dateCommentaire;
    }

    /**
     * Set auteur
     *
     * @param \CS\UtilisateursBundle\Entity\Utilisateur $auteur
     *
     * @return Commentaire
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
     * Set securite
     *
     * @param \CS\ApplicationsBundle\Entity\SecuriteCommentaire $securite
     *
     * @return Commentaire
     */
    public function setSecurite(\CS\ApplicationsBundle\Entity\SecuriteCommentaire $securite = null)
    {
        $this->securite = $securite;

        return $this;
    }

    /**
     * Get securite
     *
     * @return \CS\ApplicationsBundle\Entity\SecuriteCommentaire
     */
    public function getSecurite()
    {
        return $this->securite;
    }

    /**
     * Set type
     *
     * @param \CS\ApplicationsBundle\Entity\TypeCommentaire $type
     *
     * @return Commentaire
     */
    public function setType(\CS\ApplicationsBundle\Entity\TypeCommentaire $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \CS\ApplicationsBundle\Entity\TypeCommentaire
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add idApplication
     *
     * @param \CS\ApplicationsBundle\Entity\Application $idApplication
     *
     * @return Commentaire
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
