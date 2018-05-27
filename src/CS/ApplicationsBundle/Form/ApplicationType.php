<?php

namespace CS\ApplicationsBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApplicationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class)
            ->add('lienProd',TextType::class)
            ->add('lienDev',TextType::class)
            ->add('description',TextareaType::class,
                array(
                    'attr' => array(
                        'rows' => '5',
                        'class'=> 'widgEditor nothing'),
                ))
            ->add('typeBase',EntityType::class,
                array(
                    'class'         => 'CSApplicationsBundle:TypeBase',
                    'choice_label'  => 'libType'
                ))
            ->add('serveurDev',EntityType::class,
                array(
                    'class'         => 'CSServeursBundle:Serveur',
                    'choice_label'  => 'nom'
                ))
            ->add('developpeur',EntityType::class,
                array(
                    'class'         => 'CSUtilisateursBundle:Utilisateur',
                    'choice_label'  => 'nomPrenomLogin'
                ))
            ->add('serveurProd',EntityType::class,
                array(
                    'class'         => 'CSServeursBundle:Serveur',
                    'choice_label'  => 'nom'
                ))
            ->add('technologie',EntityType::class,
                array(
                    'class'         => 'CSApplicationsBundle:Technologie',
                    'choice_label'  => 'libTechnologie'
                ))
            ->add('idDeveloppeur',EntityType::class,
                array(
                    'class'         => 'CSUtilisateursBundle:Utilisateur',
                    'choice_label'  => 'nomPrenomLogin',
                    'multiple'      => 'true'
                )) ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CS\ApplicationsBundle\Entity\Application'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'cs_applicationsbundle_application';
    }


}
