<?php

namespace CS\ServeursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Serveur
 *
 * @ORM\Table(name="serveurs", indexes={@ORM\Index(name="serveur_os_idx", columns={"os"}), @ORM\Index(name="serveur_type_idx", columns={"type_serveur"})})
 * @ORM\Entity(repositoryClass="CS\ServeursBundle\Repository\ServeurRepository")
 */
class Serveur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_serveur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idServeur;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=45, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=45, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=45, nullable=false)
     */
    private $mdp;

    /**
     * @var string
     *
     * @ORM\Column(name="login_phpmyadmin", type="string", length=45, nullable=true)
     */
    private $loginPhpmyadmin;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp_phpmyadmin", type="string", length=45, nullable=true)
     */
    private $mdpPhpmyadmin;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_applications", type="integer", nullable=false)
     */
    private $nbApplications = '0';

    /**
     * @var \Os
     *
     * @ORM\ManyToOne(targetEntity="Os")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="os", referencedColumnName="id_os")
     * })
     */
    private $os;

    /**
     * @var \TypeServeur
     *
     * @ORM\ManyToOne(targetEntity="TypeServeur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_serveur", referencedColumnName="id_type_serveur")
     * })
     */
    private $typeServeur;


    /**
     * Get idServeur
     *
     * @return integer
     */
    public function getIdServeur()
    {
        return $this->idServeur;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Serveur
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
     * Set login
     *
     * @param string $login
     *
     * @return Serveur
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
     * @return Serveur
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
     * Set loginPhpmyadmin
     *
     * @param string $loginPhpmyadmin
     *
     * @return Serveur
     */
    public function setLoginPhpmyadmin($loginPhpmyadmin)
    {
        $this->loginPhpmyadmin = $loginPhpmyadmin;

        return $this;
    }

    /**
     * Get loginPhpmyadmin
     *
     * @return string
     */
    public function getLoginPhpmyadmin()
    {
        return $this->loginPhpmyadmin;
    }

    /**
     * Set mdpPhpmyadmin
     *
     * @param string $mdpPhpmyadmin
     *
     * @return Serveur
     */
    public function setMdpPhpmyadmin($mdpPhpmyadmin)
    {
        $this->mdpPhpmyadmin = $mdpPhpmyadmin;

        return $this;
    }

    /**
     * Get mdpPhpmyadmin
     *
     * @return string
     */
    public function getMdpPhpmyadmin()
    {
        return $this->mdpPhpmyadmin;
    }

    /**
     * Set nbApplications
     *
     * @param integer $nbApplications
     *
     * @return Serveur
     */
    public function setNbApplications($nbApplications)
    {
        $this->nbApplications = $nbApplications;

        return $this;
    }

    /**
     * Get nbApplications
     *
     * @return integer
     */
    public function getNbApplications()
    {
        return $this->nbApplications;
    }

    /**
     * Set os
     *
     * @param \CS\ServeursBundle\Entity\Os $os
     *
     * @return Serveur
     */
    public function setOs(\CS\ServeursBundle\Entity\Os $os = null)
    {
        $this->os = $os;

        return $this;
    }

    /**
     * Get os
     *
     * @return \CS\ServeursBundle\Entity\Os
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * Set typeServeur
     *
     * @param \CS\ServeursBundle\Entity\TypeServeur $typeServeur
     *
     * @return Serveur
     */
    public function setTypeServeur(\CS\ServeursBundle\Entity\TypeServeur $typeServeur = null)
    {
        $this->typeServeur = $typeServeur;

        return $this;
    }

    /**
     * Get typeServeur
     *
     * @return \CS\ServeursBundle\Entity\TypeServeur
     */
    public function getTypeServeur()
    {
        return $this->typeServeur;
    }

    public function increaseNbApplications()
    {
        $this->nbApplications++;
    }

    public function decreaseNbApplications()
    {
        $this->nbApplications--;
    }
}
