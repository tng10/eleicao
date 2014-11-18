<?php

namespace Eleicao\AdmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Candidato
 *
 * @ORM\Table(name="candidato")
 * @ORM\Entity
 */
class Candidato
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
     * @ORM\Column(name="nome", type="string", length=45)
     */
    private $nome;

    /**
     * @ORM\ManyToOne(targetEntity="Partido", inversedBy="candidatos")
     * @ORM\JoinColumn(name="partido_id", referencedColumnName="id")
     */
    protected $partido;

    /**
     * @ORM\OneToMany(targetEntity="Proposta", mappedBy="candidato")
     */
    protected $propostas;

    /**
     * @ORM\OneToMany(targetEntity="Votacao", mappedBy="candidato")
     */
    protected $votacoes;

    
    public function __construct()
    {
        $this->propostas = new ArrayCollection();
        $this->votacoes = new ArrayCollection();
    }

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
     * Set nome
     *
     * @param string $nome
     * @return Candidato
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set partido
     *
     * @param \Eleicao\AdmBundle\Entity\Partido $partido
     * @return Candidato
     */
    public function setPartido(\Eleicao\AdmBundle\Entity\Partido $partido = null)
    {
        $this->partido = $partido;

        return $this;
    }

    /**
     * Get partido
     *
     * @return \Eleicao\AdmBundle\Entity\Partido 
     */
    public function getPartido()
    {
        return $this->partido;
    }

    /**
     * Add propostas
     *
     * @param \Eleicao\AdmBundle\Entity\Proposta $propostas
     * @return Candidato
     */
    public function addProposta(\Eleicao\AdmBundle\Entity\Proposta $propostas)
    {
        $this->propostas[] = $propostas;

        return $this;
    }

    /**
     * Remove propostas
     *
     * @param \Eleicao\AdmBundle\Entity\Proposta $propostas
     */
    public function removeProposta(\Eleicao\AdmBundle\Entity\Proposta $propostas)
    {
        $this->propostas->removeElement($propostas);
    }

    /**
     * Get propostas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPropostas()
    {
        return $this->propostas;
    }

    /**
     * Add votacoes
     *
     * @param \Eleicao\AdmBundle\Entity\Votacao $votacoes
     * @return Candidato
     */
    public function addVotaco(\Eleicao\AdmBundle\Entity\Votacao $votacoes)
    {
        $this->votacoes[] = $votacoes;

        return $this;
    }

    /**
     * Remove votacoes
     *
     * @param \Eleicao\AdmBundle\Entity\Votacao $votacoes
     */
    public function removeVotaco(\Eleicao\AdmBundle\Entity\Votacao $votacoes)
    {
        $this->votacoes->removeElement($votacoes);
    }

    /**
     * Get votacoes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVotacoes()
    {
        return $this->votacoes;
    }
}
