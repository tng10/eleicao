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
     * @ORM\ManyToOne(targetEntity="Candidato", inversedBy="votacoes", cascade={"all"})
     * @ORM\JoinColumn(name="candidato_id", referencedColumnName="id")
     */
    protected $candidato;


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
     * Set candidato
     *
     * @param \Eleicao\AdmBundle\Entity\Candidato $candidato
     * @return Votacao
     */
    public function setCandidato(\Eleicao\AdmBundle\Entity\Candidato $candidato = null)
    {
        $this->candidato = $candidato;

        return $this;
    }

    /**
     * Get candidato
     *
     * @return \Eleicao\AdmBundle\Entity\Candidato 
     */
    public function getCandidato()
    {
        return $this->candidato;
    }
}
