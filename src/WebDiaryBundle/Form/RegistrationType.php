<?php

namespace WebDiaryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        //dodaje pole z wyborem klasy przy rejestracji konta
        //$builder->add('class', 'entity', array('class' => 'WebDiaryBundle:Classes', 'choice_label' => 'title', 'label' => 'Przypisz do klasy:'));
    }

    public function getParent() {
        //return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        return 'fos_user_registration';
    }

    public function getBlockPrefix() {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName() {
        return $this->getBlockPrefix();
    }
}

