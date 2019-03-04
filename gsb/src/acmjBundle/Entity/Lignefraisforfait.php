<?php

namespace acmjBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lignefraisforfait
 *
 * @ORM\Table(name="lignefraisforfait", indexes={@ORM\Index(name="I_FK_LIGNEFRAISFORFAIT_FRAISFORFAIT", columns={"ID_CONCERNER"}), @ORM\Index(name="I_FK_LIGNEFRAISFORFAIT_ETAT", columns={"ID_ETRE"})})
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
     * @var string
     *
     * @ORM\Column(name="ID_CONCERNER", type="string", length=128, nullable=false)
     */
    private $idConcerner;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_ETRE", type="smallint", nullable=false)
     */
    private $idEtre;

    /**
     * @var integer
     *
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idConcerner
     *
     * @param string $idConcerner
     *
     * @return Lignefraisforfait
     */
    public function setIdConcerner($idConcerner)
    {
        $this->idConcerner = $idConcerner;

        return $this;
    }

    /**
     * Get idConcerner
     *
     * @return string
     */
    public function getIdConcerner()
    {
        return $this->idConcerner;
    }

    /**
     * Set idEtre
     *
     * @param integer $idEtre
     *
     * @return Lignefraisforfait
     */
    public function setIdEtre($idEtre)
    {
        $this->idEtre = $idEtre;

        return $this;
    }

    /**
     * Get idEtre
     *
     * @return integer
     */
    public function getIdEtre()
    {
        return $this->idEtre;
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
}
