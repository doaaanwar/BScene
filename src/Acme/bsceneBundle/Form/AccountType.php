<?php

namespace Acme\bsceneBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AccountType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', array(
                'label' => '* Username',
                'required' => 'true',
                'attr' => array('name' =>'username')))
            
            ->add('password', 'repeated', array(
                'first_name'  => 'password',
                'second_name' => 'confirm',
                'first_options'  => array(
                    'label' => '* Password'),
                'second_options' => array('label' => '* Repeat Password'),
                'required' => 'true',
                'type' => 'password',
                'attr' => array ('name' => 'password')))
            
            ->add('firstName', 'text', array (
                'label' => '* First Name',
                'required' => 'true',
                'attr' => array('name' => 'firstName')))
                
            ->add('lastName', 'text', array (
                'label' => '* Last Name',
                'required' => 'true',
                'attr' => array('name' => 'lastName')))
                
            ->add('email', 'email', array (
                'label' => '* E-mail Address',
                'required' => 'true',
                'attr' => array ('name' => 'email')))
                
            ->add('backupEmail', 'hidden', array (
                'label' => 'Secondary E-mail Address',
                'required' => 'false',
                'attr' => array('name' => 'backupEmail')))
                
            ->add('businessPhone', 'text', array (
                'label' => '* Business Phone',
                'required' => 'true',
                'attr' => array('name' => 'busPhone')))
                
            ->add('url', 'url', array (
                'label' => 'URL',
                'required' => 'false',
                'attr' => array('name' => 'memberUrl')))
                
            ->add('address1', 'text', array (
                'label' => 'Address Line 1',
                'required' => 'false',
                'attr' => array('name' => 'address1')))
                
            ->add('address2', 'text', array (
                'label' => 'Address Line 2',
                'required' => 'false',
                'attr' => array('name' => 'address2')))
                
            ->add('province', 'entity', array (
                'class' => 'AcmebsceneBundle:Province',
                'label' => 'Province',
                'required' => 'false',
                'attr' => array('name' => 'prov')))
                
            ->add('paymentAmount', 'hidden', array (
                'label' => 'Payment Amount',
                'required' => 'false',
                'attr' => array('name' => 'fee')))
                
            ->add('memberSince', 'hidden', array (
                'label' => 'Member Since: ',
                'required' => 'false',
                'attr' => array('name' => 'memberSince')))
                
            ->add('isAdmin', 'hidden', array (
                'label' => 'Admin',
                'required' => 'false',
                'attr' => array('name' => 'isAdmin')))
                
            ->add('lastLogin','hidden',  array (
                'label' => 'Last Login: ',
                'required' => 'false',
                'attr' => array('name' => 'lastLogin')))
                
            ->add('city', 'text', array (
                'label' => 'City',
                'required' => 'false',
                'attr' => array('name' => 'city')))
                
            ->add('organization', 'entity', array (
                'class' => 'AcmebsceneBundle:Organization',
                'label' => '* Organization/Company',
                'required' => 'true',
                'attr' => array('name' => 'organization')))
                
            ->add('status', 'hidden', array (
                'label' => 'Account Status',
                'required' => 'false',
                'attr' => array('name' => 'accountStatus')))
                            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\bsceneBundle\Entity\Account'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_bscenebundle_account';
    }
}
