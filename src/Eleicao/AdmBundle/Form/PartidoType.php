<?php

namespace Eleicao\AdmBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PartidoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sigla','text',array('attr' => array('class' => 'span6')))
            ->add('nome','text',array('attr' => array('class' => 'span6')))
            ->add('sobre','textarea',array('attr' => array('class' => 'span6', 'cols' => '5', 'rows' => '5')))
            ->add('imagem','file')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Eleicao\AdmBundle\Entity\Partido'
        ));
    }

    public function getName()
    {
        return 'eleicao_admbundle_partido';
    }
}
