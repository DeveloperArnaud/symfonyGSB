<?php

namespace acmjBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Lignefraishorsforfait
 *
 * @ORM\Table(name="lignefraishorsforfait")
 * @ORM\Entity
 */
class Lignefraishorsforfait
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBELLE", type="string", length=128, nullable=true)
     */
    private $libelle;

    /**
     * @var \DateTime
     * @Assert\Range(
     *      min = "2018/0/01",
     *      max = "now",
     *     minMessage="La date doit se situer dans l'année écoulée."
     * )
     * @ORM\Column(name="DATE", type="date", nullable=true)
     */
    private $date;

    /**
     * @var string
     * @Assert\Type(type="int")
     * @ORM\Column(name="MONTANT", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $montant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATEMODIF", type="date", nullable=true)
     */
    private $datemodif;

    /**
     * @var \Visiteur
     *
     * @ORM\ManyToOne(targetEntity="Visiteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idVisiteur", referencedColumnName="ID")
     * })
     */
    private $idvisiteur;

    /**
     * @var \Fichefrais
     *
     * @ORM\ManyToOne(targetEntity="Fichefrais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idFichefrais", referencedColumnName="id")
     * })
     */
    private $idFichefrais;





    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Lignefraishorsforfait
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Lignefraishorsforfait
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set montant
     *
     * @param string $montant
     *
     * @return Lignefraishorsforfait
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return string
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set datemodif
     *
     * @param \DateTime $datemodif
     *
     * @return Lignefraishorsforfait
     */
    public function setDatemodif($datemodif)
    {
        $this->datemodif = $datemodif;

        return $this;
    }

    /**
     * Get datemodif
     *
     * @return \DateTime
     */
    public function getDatemodif()
    {
        return $this->datemodif;
    }

    /**
     * Set idvisiteur
     *
     * @param \acmjBundle\Entity\Visiteur $idvisiteur
     *
     * @return Lignefraishorsforfait
     */
    public function setIdvisiteur(\acmjBundle\Entity\Visiteur $idvisiteur = null)
    {
        $this->idvisiteur = $idvisiteur;

        return $this;
    }

    /**
     * Get idvisiteur
     *
     * @return \acmjBundle\Entity\Visiteur
     */
    public function getIdvisiteur()
    {
        return $this->idvisiteur;
    }

    /**
     * Set idFichefrais
     *
     * @param \acmjBundle\Entity\Fichefrais $idFichefrais
     *
     * @return Lignefraishorsforfait
     */
    public function setIdFichefrais(\acmjBundle\Entity\Fichefrais $idFichefrais = null)
    {
        $this->idFichefrais = $idFichefrais;

        return $this;
    }

    /**
     * Get idFichefrais
     *
     * @return \acmjBundle\Entity\Fichefrais
     */
    public function getIdFichefrais()
    {
        return $this->idFichefrais;
    }
}
