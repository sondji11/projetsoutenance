<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\DBAL\Types\StringType;
use Doctrine\ORM\Query\AST\Functions\LengthFunction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom',TextType::class,[
                'constraints'=>new Length([
                    'min'=>2,
                    'max'=>25
                ]),
                'attr'=>[
                    'placeholder'=>'merci de saisir votre prenom'
                ]

            ]
           
            )
            ->add('nom',TextType::class,[
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre Nom'
                ]
            ])
            ->add('telephone', NumberType::class,[

                'attr'=>[
                    'placeholder'=>'merci de saisir votre numero de telephone'
                ]

            ])
            ->add('adresse',TextType::class,[
                'attr'=>[
                    'placeholder'=>'merci de saisir votre adresse '
                ]

            ])
            ->add('email',EmailType::class,[
                'attr'=>[
                    'placeholder'=>'veuillez taper votre email'
                ]
            ])
            ->add('password',RepeatedType::class,[
                'type'=>PasswordType::class,
                'invalid_message'=>'le mot de passe et la confirmation doivent etre identique',
                'label'=>'votre mot de passe',
                
                'required'=>true,
                'first_options'=>['label'=>'mot de passe',

                'attr'=>[
                    'placeholder'=>'merci de saisir votre mot de passe '
                ],
            
            
            ],

                'second_options'=>['label'=>'confirmer votre mot de passe',
                'attr'=>[
                    'placeholder'=>'veuillez confirmer votre mot de passe'
                ]], 
                
            ])
            // ->add('confirmer_password',PasswordType::class,[
            //     'mapped'=>false,
            //     'label'=>'Confirmer votre password',
            //     'attr'=>[
            //         'placeholder'=>'veuillez confirmer votre mot de passe'
            //     ]
            // ])
            ->add('submit', SubmitType::class, [
                'label' => "s'inscrire"
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
