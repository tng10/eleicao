<?php

namespace Eleicao\AdmBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CandidatoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome','text',array('attr' => array('class' => 'span6')))
            ->add('numero',null,array('attr' => array('class' => 'span6')))
            ->add('cargo','choice',
                array(
                    'choices'=>
                    (
                        array(
                            'Presidência da República' => 'Presidência da República'
                        )
                    ),
                    'attr' => array('class' => 'span6', 'cols' => '5', 'rows' => '5')
                )
            )
            ->add('sobre','textarea',array('attr' => array('class' => 'span6', 'cols' => '5', 'rows' => '5')))
            ->add('partido',null,array('attr' => array('class' => 'span6', 'cols' => '5', 'rows' => '5')))
            ->add('imagem','file')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Eleicao\AdmBundle\Entity\Candidato'
        ));
    }

    public function getName()
    {
        return 'eleicao_admbundle_candidato';
    }
}
