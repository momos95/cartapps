<?php

namespace CS\ServeursBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServeurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class)
            ->add('login',TextType::class)
            ->add('mdp',TextType::class)
            ->add('loginPhpmyadmin',TextType::class,
                array(
                    'required'   => false
                ))
            ->add('mdpPhpmyadmin',TextType::class,
                array(
                    'required'   => false
                ))
            ->add('os',EntityType::class,
                array(
                    'class' => 'CSServeursBundle:Os',
                    'choice_label' => 'libOs'
                ))
            ->add('typeServeur',EntityType::class,
                array(
                    'class' => 'CSServeursBundle:TypeServeur',
                    'choice_label' => 'libTypeServeur'
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CS\ServeursBundle\Entity\Serveur'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'cs_serveursbundle_serveur';
    }


}
