<?php

namespace PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;

class RegisterForm extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
                
        $builder
            ->add('salutation', ChoiceType::class, array(
                        'required'    => false,
                        'placeholder' => 'Salutation',
                        'label_attr'  => array('class' => 'sr-only', 'edit_label'),
                        'choices'     => array('MME.' => 0, 'MLE.' => 1,'MR.' => 2, 'DR.' =>3, 'PR.' =>4),
                        'choices_as_values' => true
            ))
            ->add('firstname', TextType::class, array('attr' => array(
                        'placeholder' => 'Prénom'),
                        'required' => true,
                        'label_attr' => array('class' => 'sr-only', 'edit_label')
            ))

            ->add('username', TextType::class, array('attr' => array(
                        'required' => true,
                        'placeholder' => 'Nom'),
                        'label_attr' => array('class' => 'sr-only', 'edit_label')
            ))
            ->add('email', EmailType::class, array('attr' => array(
                        'required' => true,
                        'placeholder' => 'Email'),
                        'label_attr' => array('class' => 'sr-only', 'edit_label'),

            ))

            ->add('plainPassword', RepeatedType::class, array(
                        'type' => PasswordType::class,
                        'invalid_message' => 'Le mot de passe doit être identique.',
                        'options' => array('attr' => array('class' => 'password-field')),
                        'required' => true,
                        'first_options'  => array(
                            'label_attr' => array('class' => 'sr-only', 'edit_label'),
                            'attr' => array('placeholder'=> 'Mot de passe')
                        ),
                        'second_options' => array(
                            'label_attr' => array('class' => 'sr-only', 'edit_label'),
                            'attr' => array('placeholder'=> 'Confirmer le mot de passe'),
                        ),
            ))

           /* ->add('plainPassword', PasswordType::class, array('attr' => array(
                        'placeholder' => 'Mot de passe'),
                        'required' => true,
                        'label_attr' => array('class' => 'sr-only', 'edit_label'),
            ))


            ->add('passwordConfirm', PasswordType::class, array('attr' => array(
                        'placeholder' => 'Confirmer le mot de passe', 'required' => false),
                        'required' => false,
                        'label_attr' => array('class' => 'sr-only', 'edit_label'),
            ))*/


            ->add('job', ChoiceType::class, array(
                        'attr' => array(
                        'placeholder' => ' Choisisez votre métier '),
                        'label_attr' => array('class' => 'sr-only', 'edit_label'),
                        'multiple'    => false,
                        'required'    => true,
                        'choices'     => [
                            'Situation professionnelle'=>'Situation professionnelle',
                            'infirmier'=>'infirmier',
                            'medecin urgentiste'          =>'medecin urgentiste',
                            'dentiste'  =>'dentiste',
                        ]
            ))

            ->add('localisation', ChoiceType::class, array('attr' => array(
                        'placeholder' => 'Choisisez votre département'),
                        'label_attr'  => array('class' => 'sr-only', 'edit_label'),
                        'multiple'    => false,
                        'required'    => true,
                        'choices'     => [
                            'Département de résidence' =>'Département de résidence',
                            'Chimpanzé commun'=>'Chimpanzé commun',
                            'Bonobo'          =>'Bonobo',
                            'Chimpanzé nain'  =>'Chimpanzé nain',
                        ]
            ))

            /* champs terms n'est pas mappé dans l'entité user (pas enregistré en bd) mais présent dans le form */
            ->add('terms', CheckboxType::class, array(
                        'mapped'      => false,
                        'required'    => true,
                        'label_attr'  => array('class' => 'sr-only', 'edit_label'),
                        'constraints' => new IsTrue(array('message' => 'Veuillez accepter les conditions.')),

            ))
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'PlatformBundle\Entity\User',

        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'platformbundle_user';
    }

}
