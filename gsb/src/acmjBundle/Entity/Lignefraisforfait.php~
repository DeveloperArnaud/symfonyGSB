<?php

namespace acmjBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lignefraisforfait
 *
 * @ORM\Table(name="lignefraisforfait", indexes={@ORM\Index(name="I_FK_LIGNEFRAISFORFAIT_FRAISFORFAIT", columns={"ID_CONCERNER"}), @ORM\Index(name="I_FK_LIGNEFRAISFORFAIT_ETAT", columns={"ID_ETRE"})})
 * @ORM\Entity
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


}

