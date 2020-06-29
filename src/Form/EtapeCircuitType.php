<?php

namespace App\Form;

use App\Entity\EtapeCircuit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Ville;
use App\Entity\Circuit;

class EtapeCircuitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('duree_etape')
            ->add('ordre_etape')
            ->add('code_ville',EntityType::class,
            ['class'=>Ville::class,
            'choice_label'=>'des_ville',
            'label'=>'Ville'
            ])
            ->add('code_circuit',EntityType::class,
            ['class'=>Circuit::class,
            'choice_label'=>'des_circuit',
            'label'=>'Circuit'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EtapeCircuit::class,
        ]);
    }
}
