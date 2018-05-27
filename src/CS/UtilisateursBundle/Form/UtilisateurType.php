<?php

namespace CS\UtilisateursBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('mail',TextType::class)
            ->add('numPoste',TextType::class)
            ->add('login',TextType::class)
            ->add('mdp',PasswordType::class)
            ->add('fonction',EntityType::class,
                array(
                    'class' => 'CSUtilisateursBundle:Fonction',
                    'choice_label' => 'libFonction'
                )
            )
            ->add('role',EntityType::class,
                array(
                    'class' => 'CSUtilisateursBundle:Role',
                    'choice_label' => 'libRole'
                )
            );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CS\UtilisateursBundle\Entity\Utilisateur'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'cs_utilisateursbundle_utilisateur';
    }


}
