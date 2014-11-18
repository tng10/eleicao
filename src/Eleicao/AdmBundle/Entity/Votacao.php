<?php

namespace Eleicao\AdmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Votacao
 *
 * @ORM\Table(name="votacao")
 * @ORM\Entity
 */
class Votacao
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="votos", type="integer")
     */
    private $votos;

    /**
     * @ORM\ManyToOne(targetEntity="Candidato", inversedBy="votacoes")
     * @ORM\JoinColumn(name="candidato_id", referencedColumnName="id")
     */
    protected $partido;


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
     * Set votos
     *
     * @param integer $votos
     * @return Votacao
     */
    public function setVotos($votos)
    {
        $this->votos = $votos;

        return $this;
    }

    /**
     * Get votos
     *
     * @return integer 
     */
    public function getVotos()
    {
        return $this->votos;
    }

    /**
     * Set partido
     *
     * @param \Eleicao\AdmBundle\Entity\Candidato $partido
     * @return Votacao
     */
    public function setPartido(\Eleicao\AdmBundle\Entity\Candidato $partido = null)
    {
        $this->partido = $partido;

        return $this;
    }

    /**
     * Get partido
     *
     * @return \Eleicao\AdmBundle\Entity\Candidato 
     */
    public function getPartido()
    {
        return $this->partido;
    }
}
