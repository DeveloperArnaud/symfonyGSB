<?php

namespace acmjBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fichefrais
 *
 * @ORM\Table(name="fichefrais", indexes={@ORM\Index(name="I_FK_FICHEFRAIS_ETAT", columns={"ID_ETRE2"}), @ORM\Index(name="I_FK_FICHEFRAIS_VISITEUR", columns={"ID_DECLARER"})})
 * @ORM\Entity(repositoryClass="acmjBundle\Repository\FichefraisRepository")
 */
class Fichefrais
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
     * @var integer
     *
     * @ORM\Column(name="ID_ETRE2", type="smallint", nullable=false)
     */
    private $idEtre2;

    /**
     * @var string
     *
     * @ORM\Column(name="ID_DECLARER", type="string", length=128, nullable=false)
     */
    private $idDeclarer;

    /**
     * @var string
     *
     * @ORM\Column(name="MOIS", type="string", length=6, nullable=true)
     */
    private $mois;

    /**
     * @var integer
     *
     * @ORM\Column(name="NBJUSTIFICATIFS", type="integer", nullable=true)
     */
    private $nbjustificatifs;

    /**
     * @var string
     *
     * @ORM\Column(name="MONTANTVALIDE", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $montantvalide;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATEMODIF", type="date", nullable=true)
     */
    private $datemodif;


    /**
     * @ORM\OneToMany(targetEntity="acmjBundle\Entity\Lignefraishorsforfait", mappedBy="idFichefrais")
     */
    private $lignefraisHF;





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
     * Set idEtre2
     *
     * @param integer $idEtre2
     *
     * @return Fichefrais
     */
    public function setIdEtre2($idEtre2)
    {
        $this->idEtre2 = $idEtre2;

        return $this;
    }

    /**
     * Get idEtre2
     *
     * @return integer
     */
    public function getIdEtre2()
    {
        return $this->idEtre2;
    }

    /**
     * Set idDeclarer
     *
     * @param string $idDeclarer
     *
     * @return Fichefrais
     */
    public function setIdDeclarer($idDeclarer)
    {
        $this->idDeclarer = $idDeclarer;

        return $this;
    }

    /**
     * Get idDeclarer
     *
     * @return string
     */
    public function getIdDeclarer()
    {
        return $this->idDeclarer;
    }

    /**
     * Set mois
     *
     * @param string $mois
     *
     * @return Fichefrais
     */
    public function setMois($mois)
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * Get mois
     *
     * @return string
     */
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * Set nbjustificatifs
     *
     * @param integer $nbjustificatifs
     *
     * @return Fichefrais
     */
    public function setNbjustificatifs($nbjustificatifs)
    {
        $this->nbjustificatifs = $nbjustificatifs;

        return $this;
    }

    /**
     * Get nbjustificatifs
     *
     * @return integer
     */
    public function getNbjustificatifs()
    {
        return $this->nbjustificatifs;
    }

    /**
     * Set montantvalide
     *
     * @param string $montantvalide
     *
     * @return Fichefrais
     */
    public function setMontantvalide($montantvalide)
    {
        $this->montantvalide = $montantvalide;

        return $this;
    }

    /**
     * Get montantvalide
     *
     * @return string
     */
    public function getMontantvalide()
    {
        return $this->montantvalide;
    }

    /**
     * Set datemodif
     *
     * @param \DateTime $datemodif
     *
     * @return Fichefrais
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

    public function __toString()
    {
        
            return $this->mois;
        
       
    }
    
}
