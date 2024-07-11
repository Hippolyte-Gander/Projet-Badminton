<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'attr'=> [
                    'class'=> 'texte-formulaire'
                ]
            ])
            ->add('description', TextType::class, [
                'attr'=> [
                    'class'=> 'texte-formulaire'
                ]
            ])
            ->add('contenu', TextType::class, [
                'attr'=> [
                    'class'=> 'texte-formulaire'
                ]
            ])
            ->add('dateDebut', DateType::class,[
                'widget'=>'single_text',
                'attr'=> [
                    'class'=> 'date-formulaire'
                ]
            ])
            ->add('dateFin', DateType::class,[
                'widget'=>'single_text',
                'attr'=> [
                    'class'=> 'date-formulaire'
                ]
            ])
            ->add('visibilite', TextType::class, [
                'attr'=> [
                    'class'=> 'texte-formulaire'
                ]
            ])
            ->add('utilisateur', EntityType::class, [
                'class' => Utilisateur::class,
                'attr'=> [
                    'class'=> 'texte-formulaire'
                ]
            ])
            ->add('Valider', SubmitType::class, [
                'attr'=> [
                    'class'=> 'valider-btn-formulaire'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
