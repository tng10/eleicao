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
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=100)
     */
    private $cargo;

    /**
     * @var string
     *
     * @ORM\Column(name="sobre", type="text")
     */
    private $sobre;

    /**
     * @var int
     *
     * @ORM\Column(name="numero", type="integer")
     */
    private $numero;

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
     * Set cargo
     *
     * @param string $cargo
     * @return Candidato
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get cargo
     *
     * @return string 
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set sobre
     *
     * @param string $sobre
     * @return Candidato
     */
    public function setSobre($sobre)
    {
        $this->sobre = $sobre;

        return $this;
    }

    /**
     * Get sobre
     *
     * @return string 
     */
    public function getSobre()
    {
        return $this->sobre;
    }

    /**
     * Set numero
     *
     * @param int $numero
     * @return Candidato
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return int 
     */
    public function getNumero()
    {
        return $this->numero;
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
    public function addVotacao(\Eleicao\AdmBundle\Entity\Votacao $votacoes)
    {
        $this->votacoes[] = $votacoes;

        return $this;
    }

    /**
     * Remove votacoes
     *
     * @param \Eleicao\AdmBundle\Entity\Votacao $votacoes
     */
    public function removeVotacao(\Eleicao\AdmBundle\Entity\Votacao $votacoes)
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

    public function __toString()
    {
        return $this->nome;
    }
}
