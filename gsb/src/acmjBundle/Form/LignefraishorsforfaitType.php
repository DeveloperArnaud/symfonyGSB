<?php

namespace acmjBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class LignefraishorsforfaitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('libelle',null,array('attr' => array('style' => 'width: 200px')))->add('date', DateType::class ,array ('years'=> range(2018,2019),'widget' => 'single_text','attr'=> array('style' => 'width : 200px') ))->add('montant',null,array('attr' => array('style' => 'width: 200px')))->add ('save', SubmitType::class, array ('label'=> 'Valider'))->add ('reset', ResetType::class, array ('label'=> 'Effacer'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'acmjBundle\Entity\Lignefraishorsforfait'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'acmjbundle_lignefraishorsforfait';
    }


}
