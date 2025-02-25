<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType; // Added EmailType
use Symfony\Component\Form\Extension\Core\Type\TextType;  // Added TextType
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType; // Added ChoiceType

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'E-mail'

            ])
            // ->add('roles', ChoiceType::class, [
            //     'choices' => [
            //         'User' => 'ROLE_USER',
            //         'Admin' => 'ROLE_ADMIN',
            //     ],
            //     'multiple' => true,  // allows multiple selections
            //     'expanded' => true,  // renders as checkboxes
            // ])
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                  'label' => 'Nom'
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                  'label' => 'Prenom'
            ])
            ->add('adresse', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                  'label' => 'Adresse'
            ])
            ->add('codepostal', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                  'label' => 'Code Postal'
            ])
            ->add('ville', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                  'label' => 'Ville'
            ])
            // ->add('created_at')
            // ->add('numero_siret', TextType::class, [
            //     'attr' => [
            //         'class' => 'form-control'
            //     ],  // If you want to add the class
            //       'label' => 'N Siret'

            // ])
            
            ->add('RGPDConsent', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
                'label' => 'En m\'inscrivant à ce site j\'accept...'
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'form-control'
                ],
           
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 4096,
                    ]),
                ],
                'label' => 'Mot de Passe',  // Added missing comma
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
