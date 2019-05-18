<?php

namespace acmjBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Lignefraisforfait
 *
 * @ORM\Table(name="lignefraisforfait", indexes={@ORM\Index(name="I_FK_LIGNEFRAISFORFAIT_FRAISFORFAIT", columns={"idFraisforfait"})})
 * @ORM\Entity(repositoryClass="acmjBundle\Repository\LignefraisforfaitRepository")
 */
class Lignefraisforfait
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Visiteur
     *
     * @ORM\ManyToOne(targetEntity="Fraisforfait")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idFraisforfait", referencedColumnName="ID")
     * })
     */
    private $idFraisforfait;


    /**
     * @var integer
     * @Assert\Regex("/^[0-9]{5}$/")
     * @ORM\Column(name="QUANTITE", type="bigint", nullable=true)
     */
    private $quantite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATEMODIFICATION", type="date", nullable=true)
     */
    private $datemodification;

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
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Lignefraisforfait
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set datemodification
     *
     * @param \DateTime $datemodification
     *
     * @return Lignefraisforfait
     */
    public function setDatemodification($datemodification)
    {
        $this->datemodification = $datemodification;

        return $this;
    }

    /**
     * Get datemodification
     *
     * @return \DateTime
     */
    public function getDatemodification()
    {
        return $this->datemodification;
    }

    /**
     * Set idFraisforfait
     *
     * @param \acmjBundle\Entity\Fraisforfait $idFraisforfait
     *
     * @return Lignefraisforfait
     */
    public function setIdFraisforfait(\acmjBundle\Entity\Fraisforfait $idFraisforfait = null)
    {
        $this->idFraisforfait = $idFraisforfait;

        return $this;
    }

    /**
     * Get idFraisforfait
     *
     * @return \acmjBundle\Entity\Fraisforfait
     */
    public function getIdFraisforfait()
    {
        return $this->idFraisforfait;
    }

    /**
     * Set idvisiteur
     *
     * @param \acmjBundle\Entity\Visiteur $idvisiteur
     *
     * @return Lignefraisforfait
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
     * @return Lignefraisforfait
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
