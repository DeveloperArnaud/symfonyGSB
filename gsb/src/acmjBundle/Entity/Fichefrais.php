<?php

namespace acmjBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fichefrais
 *
 * @ORM\Table(name="fichefrais", indexes={@ORM\Index(name="I_FK_FICHEFRAIS_ETAT", columns={"ID_ETRE2"}), @ORM\Index(name="I_FK_FICHEFRAIS_VISITEUR", columns={"ID_DECLARER"})})
 * @ORM\Entity
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


}

