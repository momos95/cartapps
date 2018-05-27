<?php

namespace CS\UtilisateursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateurs", indexes={@ORM\Index(name="foreign 1", columns={"role"}), @ORM\Index(name="user_fonction_idx", columns={"fonction"})})
 * @ORM\Entity(repositoryClass="CS\UtilisateursBundle\Repository\UtilisateurRepository")
 */
class Utilisateur implements UserInterface

{
    private $roles ;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_utilisateur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUtilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=45, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=45, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=45, nullable=false)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="num_poste", type="string", length=45, nullable=true)
     */
    private $numPoste;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=45, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=250, nullable=false)
     */
    private $mdp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime", nullable=false)
     */
    private $dateCreation ;

    /**
     * @var \Fonction
     *
     * @ORM\ManyToOne(targetEntity="Fonction")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fonction", referencedColumnName="id_fonction")
     * })
     */
    private $fonction;

    /**
     * @var \Role
     *
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role", referencedColumnName="id_role")
     * })
     */
    private $role;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="\CS\ApplicationsBundle\Entity\Application", mappedBy="idDeveloppeur")
     */
    private $idApplication;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idApplication = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dateCreation  = new \DateTime() ;
    }

    /**
     * Get idUtilisateur
     *
     * @return integer
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Utilisateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Utilisateur
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set numPoste
     *
     * @param string $numPoste
     *
     * @return Utilisateur
     */
    public function setNumPoste($numPoste)
    {
        $this->numPoste = $numPoste;

        return $this;
    }

    /**
     * Get numPoste
     *
     * @return string
     */
    public function getNumPoste()
    {
        return $this->numPoste;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return Utilisateur
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set mdp
     *
     * @param string $mdp
     *
     * @return Utilisateur
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get mdp
     *
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Utilisateur
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set fonction
     *
     * @param \CS\UtilisateursBundle\Entity\Fonction $fonction
     *
     * @return Utilisateur
     */
    public function setFonction(\CS\UtilisateursBundle\Entity\Fonction $fonction = null)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return \CS\UtilisateursBundle\Entity\Fonction
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set role
     *
     * @param \CS\UtilisateursBundle\Entity\Role $role
     *
     * @return Utilisateur
     */
    public function setRole(\CS\UtilisateursBundle\Entity\Role $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \CS\UtilisateursBundle\Entity\Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Add idApplication
     *
     * @param \CS\ApplicationsBundle\Entity\Application $idApplication
     *
     * @return Utilisateur
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

    public function getRoles()
    {
        return array($this->role->getlibRole()) ;
    }

    public function setRoles(array $roles){
        $this->roles = $roles ;
    }

    public function getPassword()
    {
        return $this->getMdp() ;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        return $this->getLogin();
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function has_role($roles){

    }

    public function getNomPrenomLogin(){
        return $this->getNom() . ' ' . $this->getPrenom() . ' / ' . $this->getLogin() ;
    }
}
