<?php

namespace App\Form;


use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use PHPStan\PhpDocParser\Ast\Type\ArrayTypeNode;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UseradminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email')
        ->add('agreeTerms', CheckboxType::class, [
            'label' => 'Accepter les conditions' ,
            'mapped' => false,
            'constraints' => [
                new IsTrue([
                    'message' => 'Vous devez accepter nos conditions.',
                ]),
            ],
        ])
        ->add('plainPassword', PasswordType::class, [
            'label' => 'Mot de passe compliqué exmple  1tmq//@tt1tmq//@tt' ,
            // instead of being set onto the object directly,
            // this is read and encoded in the controller
            'mapped' => false,
            'attr' => ['autocomplete' => 'new-password'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez entrer un mot de passe',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Votre mot de passe doit être au moins {{ limit }} caractères',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
            ],
        ])
        ->add('roles', ChoiceType::class, [
            'choices' => [
                'Utilisateur' => 'ROLE_USER',
                'Editeur' => 'ROLE_EDITOR',
                'Administrateur' => 'ROLE_ADMIN',
                'Pôle_média' => 'ROLE_MEDIA',
                'Pôle_cénima' => 'ROLE_CINEMA',
                'Pôle_musique' => 'ROLE_MUSIQUE',
                'Stragiaire' => 'ROLE_STAGIAIRE',
                'Secretaire' => 'ROLE_SECRETAIRE',
                'Commercial' => 'ROLE_COMMERCIAL'
            ],
            'expanded' => true,
            'multiple' => true,
            'label' => 'Rôles' 
        ])
      
       ;    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
