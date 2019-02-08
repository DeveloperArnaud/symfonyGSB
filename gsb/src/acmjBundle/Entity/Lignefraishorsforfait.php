<?php

namespace acmjBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lignefraishorsforfait
 *
 * @ORM\Table(name="lignefraishorsforfait", indexes={@ORM\Index(name="I_FK_LIGNEFRAISHORSFORFAIT_ETAT", columns={"ID_ETRE1"}), @ORM\Index(name="I_FK_LIGNEFRAISHORSFORFAIT_FICHEFRAIS", columns={"ID_1"}), @ORM\Index(name="I_FK_LIGNEFRAISHORSFORFAIT_LIGNEFRAISFORFAIT", columns={"ID_2"}), @ORM\Index(name="I_FK_LIGNEFRAISHORSFORFAIT_FICHEFRAIS1", columns={"ID_3"})})
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
     * @var integer
     *
     * @ORM\Column(name="ID_ETRE1", type="smallint", nullable=false)
     */
    private $idEtre1;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_1", type="integer", nullable=false)
     */
    private $id1;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_2", type="smallint", nullable=false)
     */
    private $id2;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_3", type="integer", nullable=false)
     */
    private $id3;

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
}
