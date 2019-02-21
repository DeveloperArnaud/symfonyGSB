<?php

namespace acmjBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FichefraisType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('mois', EntityType::class, array(
            'label'=> 'Mois',
            'class' => 'acmjBundle:Fichefrais'
        ));
    }
    
    /**
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
