<?php

namespace Pyz\Yves\CustomerPage\Form;

use Pyz\Yves\CustomerPage\CustomerPageFactory;
use SprykerShop\Yves\CustomerPage\Form\ProfileForm as SprykerProfileForm;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @method CustomerPageFactory getFactory()
 */
class ProfileForm extends SprykerProfileForm
{
    public const FIELD_ANTELOPE = 'fk_antelope';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $this->addAntelopeField($builder);
    }

    protected function addAntelopeField(FormBuilderInterface $builder)
    {
        $builder->add(self::FIELD_ANTELOPE, TextType::class, [
            'label' => 'customer.profile.antelope',
            'required' => true,
            'constraints' => [
                $this->createNotBlankConstraint()
            ]
        ]);

        $builder->get(self::FIELD_ANTELOPE)->addModelTransformer(
            $this->getFactory()->createAntelopeTransformer()
        );

        return $this;
    }


}
