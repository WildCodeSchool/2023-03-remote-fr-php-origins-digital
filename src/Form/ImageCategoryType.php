<?php

namespace App\Form;

use App\Entity\ImageCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fileBackground', VichFileType::class, [
                'required' => false,
                'label' => 'Background image',
                'allow_delete' => true,
                'download_uri' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('fileCharacter', VichFileType::class, [
                'required' => false,
                'label' => 'Character image',
                'allow_delete' => true,
                'download_uri' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('fileName', VichFileType::class, [
                'required' => false,
                'label' => 'Name image',
                'allow_delete' => true,
                'download_uri' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('category', null, [
                'label' => 'Category lié aux images*',
                'attr' => ['class' => 'form-control']
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ImageCategory::class,
        ]);
    }
}
