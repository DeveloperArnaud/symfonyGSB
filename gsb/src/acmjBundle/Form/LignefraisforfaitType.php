<?php

namespace acmjBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class LignefraisforfaitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ETP',IntegerType::class,array(
            'label' => 'Forfait Etape',
            'attr'=> array('placeholder' => '               €')))
            ->add('KM',IntegerType::class,array (
            'label'=> 'Forfait kilométrique','attr'=>array('placeholder'=> '               €')))
            ->add('NUI',IntegerType::class,array(
            'label'=>'Nuitée Hôtel','attr'=> array('placeholder'=> '               €')))
            ->add('REP',IntegerType::class,array(
            'label'=>'Repas Restaurant','attr'=>array('placeholder'=>'               €')))
            ->add('save',SubmitType::class,array('label'=> 'Valider'))
            ->add('reset',ResetType::class,array('label'=> 'Effacer'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'acmjbundle_lignefraisforfait';
    }


}
