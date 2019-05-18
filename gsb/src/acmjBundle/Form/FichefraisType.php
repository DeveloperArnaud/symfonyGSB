<?php

namespace acmjBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FichefraisType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('mois', ChoiceType::class,array(
            'choices'  => [
                'Janvier 2019' => '201901',
                'Février 2019' => '201902',
                'Mars 2019' => '201903',
                'Avril 2019' => '201904',
                'Mai 2019' => '201905',
                'Juin 2019' => '201906',
                'Juillet 2019' => '201907',
                'Aout 2019' => '201908',
                'Septembre 2019' => '201909',
                'Octobre 2019' => '201910',
                'Novembre 2019' => '201911',
                'Décembre 2019' => '201912',
            ],
        'label'=>'Mois'))->add('submit',SubmitType::class,array('label'=>'Valider'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'acmjBundle\Entity\Fichefrais'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'acmjbundle_fichefrais';
    }


}
