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
            ->add('texto','textarea',array('attr' => array('cols' => '5', 'rows' => '5')))
            ->add('candidato')
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
