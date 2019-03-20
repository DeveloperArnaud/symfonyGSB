<?php

namespace acmjBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lignefraishorsforfait
 *
 * @ORM\Table(name="lignefraishorsforfait")
 * @ORM\Entity(repositoryClass="acmjBundle\Repository\LignefraishorsforfaitRepository")
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
     *
     * @ORM\Column(name="DATE", type="date", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
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
     * @var string
     *
     * @ORM\Column(name="idVisiteur", type="string", length=128, nullable=false)
     */
     private $idVisiteur;

     /**
     * @ORM\Column(name="idFichefrais", type="string", length=128, nullable=false)
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
     * Set idEtre1
     *
     * @param integer $idEtre1
     *
     * @return Lignefraishorsforfait
     */
    public function setIdEtre1($idEtre1)
    {
        $this->idEtre1 = $idEtre1;

        return $this;
    }

    /**
     * Get idEtre1
     *
     * @return integer
     */
    public function getIdEtre1()
    {
        return $this->idEtre1;
    }

    /**
     * Set id1
     *
     * @param integer $id1
     *
     * @return Lignefraishorsforfait
     */
    public function setId1($id1)
    {
        $this->id1 = $id1;

        return $this;
    }

    /**
     * Get id1
     *
     * @return integer
     */
    public function getId1()
    {
        return $this->id1;
    }

    /**
     * Set id2
     *
     * @param integer $id2
     *
     * @return Lignefraishorsforfait
     */
    public function setId2($id2)
    {
        $this->id2 = $id2;

        return $this;
    }

    /**
     * Get id2
     *
     * @return integer
     */
    public function getId2()
    {
        return $this->id2;
    }

    /**
     * Set id3
     *
     * @param integer $id3
     *
     * @return Lignefraishorsforfait
     */
    public function setId3($id3)
    {
        $this->id3 = $id3;

        return $this;
    }

    /**
     * Get id3
     *
     * @return integer
     */
    public function getId3()
    {
        return $this->id3;
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
     * Set idFichefrais
     *
     * @param \acmjBundle\Entity\Fichefrais $idFichefrais
     *
     * @return Lignefraishorsforfait
     */
    public function setIdFichefrais($id)
    {
        $this->idFichefrais = $id;

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

    /**
     * Set idVisiteur
     *
     * @param string $idVisiteur
     *
     * @return Lignefraishorsforfait
     */
    public function setIdVisiteur($idVisiteur)
    {
        $this->idVisiteur = $idVisiteur;

        return $this;
    }

    /**
     * Get idVisiteur
     *
     * @return string
     */
    public function getIdVisiteur()
    {
        return $this->idVisiteur;
    }
}
