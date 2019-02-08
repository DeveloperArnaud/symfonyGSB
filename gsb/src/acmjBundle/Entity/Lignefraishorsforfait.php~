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


}

