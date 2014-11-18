<?php

namespace Eleicao\AdmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proposta
 *
 * @ORM\Table(name="proposta")
 * @ORM\Entity
 */
class Proposta
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
     * @var string
     *
     * @ORM\Column(name="texto", type="text")
     */
    private $texto;

    /**
     * @ORM\ManyToOne(targetEntity="Candidato", inversedBy="propostas")
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
     * Set texto
     *
     * @param string $texto
     * @return Proposta
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string 
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set candidato
     *
     * @param \Eleicao\AdmBundle\Entity\Candidato $candidato
     * @return Proposta
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
