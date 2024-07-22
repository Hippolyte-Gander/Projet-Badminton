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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label'=>'Titre événement',
                'attr'=> [
                    'class'=> 'texte-formulaire'
                ]
            ])
            ->add('description', TextType::class, [
                'label'=>'Description événement',
                'attr'=> [
                    'class'=> 'texte-formulaire'
                ]
            ])
            ->add('contenu', TextareaType::class, [
                'label'=>"Contenu de l'événement",
                'attr'=> [
                    'class'=> 'texte-formulaire'
                ]
            ])
            ->add('dateDebut', DateTimeType::class,[
                'label'=>'Date de début',
                'widget'=>'single_text',
                'attr'=> [
                    'class'=> 'texte-formulaire'
                ]
            ])
            ->add('dateFin', DateTimeType::class,[
                'label'=>'Date de fin',
                'widget'=>'single_text',
                'attr'=> [
                    'class'=> 'texte-formulaire'
                ]
            ])
            ->add('visibilite', ChoiceType::class, [
                'label'=>'Visible par',
                'choices' => [
                    'Tous' => 'tous',
                    'Membres' => 'membres',
                    'Comité' => 'admins',
                ],
                'attr'=> [
                    'class'=> 'texte-formulaire'
                ]
            ])
            ->add('utilisateur', EntityType::class, [
                'label'=>'Créé par',
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
