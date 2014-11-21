<?php

namespace Wlalele\Bundle\CatalogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Wlalele\Bundle\CatalogBundle\Entity\Article;
use Wlalele\Bundle\CatalogBundle\Entity\ArticleRepository;

class ShowProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('article', 'entity', [
                'class' => get_class(new Article()),
                'query_builder' => function (ArticleRepository $repository) use ($options) {
                        return $repository->createQueryBuilder('a')
                            ->innerJoin('a.product', 'p')
                            ->where('p.id = :id')
                            ->setParameter('id', $options['data']->getProduct()->getId());
                    }
            ])
            ->add('quantity', 'integer', ['mapped' => false])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Wlalele\Bundle\CatalogBundle\Entity\ChoiceArticle'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'show_product';
    }
}
