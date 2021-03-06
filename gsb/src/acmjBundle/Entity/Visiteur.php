<?php

namespace acmjBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Visiteur
 *
 * @ORM\Table(name="visiteur")
 * @ORM\Entity(repositoryClass="acmjBundle\Repository\VisiteurRepository")
 */
class Visiteur implements UserInterface,\Serializable
{
    /**
     * @var string
     *
     * @ORM\Column(name="ID", type="string", length=128, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMVISITEUR", type="string", length=128, nullable=true)
     */
    private $nomvisiteur;

    /**
     * @var string
     *
     * @ORM\Column(name="PRENOMVISITEUR", type="string", length=128, nullable=true)
     */
    private $prenomvisiteur;

    /**
     * @var string
     *
     * @ORM\Column(name="LOGINVISITEUR", type="string", length=128, nullable=true)
     */
    private $loginvisiteur;

    /**
     * @var string
     *
     * @ORM\Column(name="MDPVISITEUR", type="string", length=128, nullable=true)
     */
    private $mdpvisiteur;

    /**
     * @var string
     *
     * @ORM\Column(name="ADRVISITEUR", type="string", length=128, nullable=true)
     */
    private $adrvisiteur;

    /**
     * @var string
     *
     * @ORM\Column(name="CPVISITEUR", type="string", length=5, nullable=true)
     */
    private $cpvisiteur;

    /**
     * @var string
     *
     * @ORM\Column(name="VILLEVISITEUR", type="string", length=128, nullable=true)
     */
    private $villevisiteur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATEEMBAUCHE", type="date", nullable=true)
     */
    private $dateembauche;

    /**
     * @var boolean
     *
     * @ORM\Column(name="COMPTABLE", type="boolean", nullable=true)
     */
    private $comptable;




    public function setUsername($loginvisiteur)
    {
        $this->loginvisiteur = $loginvisiteur;
        return $this;
    }
    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->loginvisiteur;
    }
    /**
     * Set password
     *
     * @param string $password
     *
     * @return Utilisateur
     */
    public function setPassword($mdpvisiteur)
    {
        $this->mdpvisiteur = $mdpvisiteur;
        return $this;
    }
    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->mdpvisiteur;
    }



    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return array('ROLE_USER');
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        if ($this->comptable == false) {
            return ['ROLE_USER'];
        } else {
            return ['ROLE_ADMIN'];
        }
    }
    public function setRoles ($roles) {
        $this->roles = $roles;
        return $this;
    }
    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }
    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
    /**
     * String representation of object
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->loginvisiteur,
            $this->mdpvisiteur
        ]);
    }
    /**
     * Constructs the object
     * @link https://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        list ($this->id,
            $this->loginvisiteur,
            $this->mdpvisiteur
            ) = unserialize($serialized, ['allowed_classes' => false]);
    }



    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomvisiteur
     *
     * @param string $nomvisiteur
     *
     * @return Visiteur
     */
    public function setNomvisiteur($nomvisiteur)
    {
        $this->nomvisiteur = $nomvisiteur;

        return $this;
    }

    /**
     * Get nomvisiteur
     *
     * @return string
     */
    public function getNomvisiteur()
    {
        return $this->nomvisiteur;
    }

    /**
     * Set prenomvisiteur
     *
     * @param string $prenomvisiteur
     *
     * @return Visiteur
     */
    public function setPrenomvisiteur($prenomvisiteur)
    {
        $this->prenomvisiteur = $prenomvisiteur;

        return $this;
    }

    /**
     * Get prenomvisiteur
     *
     * @return string
     */
    public function getPrenomvisiteur()
    {
        return $this->prenomvisiteur;
    }

    /**
     * Set loginvisiteur
     *
     * @param string $loginvisiteur
     *
     * @return Visiteur
     */
    public function setLoginvisiteur($loginvisiteur)
    {
        $this->loginvisiteur = $loginvisiteur;

        return $this;
    }

    /**
     * Get loginvisiteur
     *
     * @return string
     */
    public function getLoginvisiteur()
    {
        return $this->loginvisiteur;
    }

    /**
     * Set mdpvisiteur
     *
     * @param string $mdpvisiteur
     *
     * @return Visiteur
     */
    public function setMdpvisiteur($mdpvisiteur)
    {
        $this->mdpvisiteur = $mdpvisiteur;

        return $this;
    }

    /**
     * Get mdpvisiteur
     *
     * @return string
     */
    public function getMdpvisiteur()
    {
        return $this->mdpvisiteur;
    }

    /**
     * Set adrvisiteur
     *
     * @param string $adrvisiteur
     *
     * @return Visiteur
     */
    public function setAdrvisiteur($adrvisiteur)
    {
        $this->adrvisiteur = $adrvisiteur;

        return $this;
    }

    /**
     * Get adrvisiteur
     *
     * @return string
     */
    public function getAdrvisiteur()
    {
        return $this->adrvisiteur;
    }

    /**
     * Set cpvisiteur
     *
     * @param string $cpvisiteur
     *
     * @return Visiteur
     */
    public function setCpvisiteur($cpvisiteur)
    {
        $this->cpvisiteur = $cpvisiteur;

        return $this;
    }

    /**
     * Get cpvisiteur
     *
     * @return string
     */
    public function getCpvisiteur()
    {
        return $this->cpvisiteur;
    }

    /**
     * Set villevisiteur
     *
     * @param string $villevisiteur
     *
     * @return Visiteur
     */
    public function setVillevisiteur($villevisiteur)
    {
        $this->villevisiteur = $villevisiteur;

        return $this;
    }

    /**
     * Get villevisiteur
     *
     * @return string
     */
    public function getVillevisiteur()
    {
        return $this->villevisiteur;
    }

    /**
     * Set dateembauche
     *
     * @param \DateTime $dateembauche
     *
     * @return Visiteur
     */
    public function setDateembauche($dateembauche)
    {
        $this->dateembauche = $dateembauche;

        return $this;
    }

    /**
     * Get dateembauche
     *
     * @return \DateTime
     */
    public function getDateembauche()
    {
        return $this->dateembauche;
    }

    /**
     * Set comptable
     *
     * @param boolean $comptable
     *
     * @return Visiteur
     */
    public function setComptable($comptable)
    {
        $this->comptable = $comptable;

        return $this;
    }

    /**
     * Get comptable
     *
     * @return boolean
     */
    public function getComptable()
    {
        return $this->comptable;
    }

    public function __toString()
    {
        return "nom ". $this->nomvisiteur;
    }
}
