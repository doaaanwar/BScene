<?php

namespace Acme\bsceneBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoriesType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', 'text', array(
                    'label' => 'Category Name',
                    'required' => true))
                ->add('description', 'textarea', array(
                    'label' => 'Category Description',
                    'required' => true))
                ->add('ranking', 'choice', array(
                    'choices' => array(
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6',
                        '7' => '7',
                        '8' => '8',
                        '9' => '9',
                        '10' => '10'
                    ),
                    'label' => 'Homepage Ranking',
                    'required' => true))
                ->add('image', 'entity', array(
                    'class' => 'AcmebsceneBundle:Image',
                    'label' => 'Select Image',
                    'required' => true))
                ->add('meetupCategory', 'entity', array(
                    'class' => 'AcmebsceneBundle:MeetupCategories',
                    'label' => 'Corresponding Meetup.com Category',
                    'required' => true))
                ->add('eventBriteCategory', 'entity', array(
                    'class' => 'AcmebsceneBundle:EventBriteCategories',
                    'label' => 'Corresponding EventBrite.com Category',
                    'required' => true))
                ->add('eventfullCategory', 'entity', array(
                    'class' => 'AcmebsceneBundle:EventfulCategories',
                    'label' => 'Corresponding Eventful.com Category',
                    'required' => true))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\bsceneBundle\Entity\Categories'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'acme_bscenebundle_categories';
    }

}
