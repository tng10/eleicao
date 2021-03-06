<?php

namespace Eleicao\AdmBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PropostaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo','text',array('attr' => array('class' => 'span6', 'cols' => '5', 'rows' => '5')))
            ->add('candidato',null,array('attr' => array('class' => 'span6', 'cols' => '5', 'rows' => '5')))
            ->add('texto','textarea',array('attr' => array('class' => 'span6', 'cols' => '5', 'rows' => '5')))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Eleicao\AdmBundle\Entity\Proposta'
        ));
    }

    public function getName()
    {
        return 'eleicao_admbundle_proposta';
    }
}
