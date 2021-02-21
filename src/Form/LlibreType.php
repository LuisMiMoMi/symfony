<?php
namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use App\Entity\Editorial;

class LlibreType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('Isbn', TextType::class)
        ->add('Titol', TextType::class)
        ->add('Autor', TextType::class)
        ->add('Pagines', IntegerType::class)
        ->add('Editorial', EntityType::class, array('class' => Editorial::class, 'choice_label' => 'nom'))
        ->add('save', SubmitType::class, array('label' => 'Enviar'));
    }
}
?>