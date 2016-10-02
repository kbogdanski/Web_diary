<?php

namespace WebDiaryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class SubjectType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name','text', array('label' => 'NAZWA PRZEDMIOTU: '))
            ->add('initials','text', array('label' => 'SKRÓT PRZEDMIOTU (3 znaki): '))
            ->add('description', 'textarea', array('label' => 'OPIS PRZEDMIOTU: '))
            ->add('save', 'submit', array('label' => 'Zapisz'));
    }
    
    public function getName() {
        
    }
}