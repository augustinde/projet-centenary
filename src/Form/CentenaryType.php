<?php

namespace App\Form;

use App\Entity\Centenary;
use App\Entity\Intermunicipality;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CentenaryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
				'label' => 'Prénom'
			])
            ->add('lastname', TextType::class, [
				'label' => 'Nom'
			])
			->add('imageFile', VichImageType::class, [
				'label' => 'Photo du centenaire (facultatif)',
				'required' => false
			])
            ->add('declaring', ChoiceType::class, [
				'label' => 'Votre lien par rapport à la personne que vous déclarez ?',
				'choices' => [
					'moi-même' => 'moi-même',
					'parent' => 'parent',
					'soeur/frère' => 'soeur/frere',
					'ami' => 'ami',
					'médecin' => 'médecin',
					'autre' => 'autre'
				]
			])
            ->add('alive', CheckboxType::class, [
				'label' => 'La personne est-elle en vie ?'
			])
            ->add('dateOfBirth', BirthdayType::class, [
				'widget' => 'single_text',
				'label' => 'Date de naissance'
			])
            ->add('intermunicipality', EntityType::class, [
				'class' => Intermunicipality::class,
				'label' => 'Communauté de commune',
				'choice_label' => 'name',
				'placeholder' => 'Selectionner une communauté d\'agglomération',
				'autocomplete' => true
			])
			->add('biography', TextareaType::class, [
				'label' => 'Courte biographie'
			])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Centenary::class,
        ]);
    }
}
