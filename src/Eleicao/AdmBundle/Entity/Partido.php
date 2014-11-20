<?php

namespace Eleicao\AdmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Partido
 *
 * @ORM\Table(name="partido")
 * @ORM\Entity
 */
class Partido
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
     * @ORM\Column(name="sigla", type="string", length=20)
     */
    private $sigla;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=100)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="sobre", type="text")
     */
    private $sobre;

    /**
     * @ORM\OneToMany(targetEntity="Candidato", mappedBy="partido")
     */
    protected $candidatos;

    
    public function __construct()
    {
        $this->candidatos = new ArrayCollection();
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
     * Set sigla
     *
     * @param string $sigla
     * @return Partido
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;

        return $this;
    }

    /**
     * Get sigla
     *
     * @return string 
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Partido
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
     * Add candidatos
     *
     * @param \Eleicao\AdmBundle\Entity\Candidato $candidatos
     * @return Partido
     */
    public function addCandidato(\Eleicao\AdmBundle\Entity\Candidato $candidatos)
    {
        $this->candidatos[] = $candidatos;

        return $this;
    }

    /**
     * Remove candidatos
     *
     * @param \Eleicao\AdmBundle\Entity\Candidato $candidatos
     */
    public function removeCandidato(\Eleicao\AdmBundle\Entity\Candidato $candidatos)
    {
        $this->candidatos->removeElement($candidatos);
    }

    /**
     * Get candidatos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCandidatos()
    {
        return $this->candidatos;
    }

    public function __toString()
    {
        return $this->nome;
    }
}
