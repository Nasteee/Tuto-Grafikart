<?php

namespace App\Form;

use App\Business\Property\PropertyCreationAction;
use App\Entity\Option;
use App\Entity\Property;
use App\Repository\OptionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyCreationType extends AbstractType
{
    /**
     * @var OptionRepository
     */
    private $optionRepository;

    public function __construct(OptionRepository $optionRepository)
    {
        $this->optionRepository = $optionRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $options = $this->optionRepository->findAll();

        $builder
            ->add('title')
            ->add('description')
            ->add('surface')
            ->add('rooms')
            ->add('bedrooms')
            ->add('floor')
            ->add('price')
            ->add('heat', ChoiceType::class, [
                'choices' => $this->getChoices()
            ])
            ->add('options', ChoiceType::class, [
                'choices' => $options,
                'choice_label' => 'name',
                'choice_value' => 'id',
                'multiple' => true
            ])
            ->add('imageFile', FileType::class, [
                'required' => false
            ])
            ->add('city')
            ->add('adress')
            ->add('postal_code')
            ->add('sold', CheckboxType::class, [
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertyCreationAction::class,
            'translation_domain' => 'forms'
        ]);
    }

    private function getChoices()
    {
        $choices = Property::HEAT;
        $output = [];
        foreach($choices as $key =>$value){
            $output[$value] = $key;
        }
        return $output;

    }
}
