<?php

namespace AppBundle\Form;

use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class InformationEntryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('backgroundImageFile', VichImageType::class, array(
                'required'      => false,
                'allow_delete'  => true,
                'download_link' => true,
                'label' => false
                ))
            ->add('contentColor')
            ->add('send', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-success btn-lg text-center'),
                'label' => 'Create'
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\InformationEntry'
        ));
    }
}
