<?php

/*
 * This file is part of the Kimai time-tracking app.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Form\Extension;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

/**
 * Converts normal select boxes into javascript enhanced versions.
 */
class EnhancedChoiceTypeExtension extends AbstractTypeExtension
{
    public const TYPE_SELECTPICKER = 'selectpicker';

    /**
     * @var string|null
     */
    protected $type = null;

    /**
     * @param null|string $type
     */
    public function __construct(?string $type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getExtendedType()
    {
        return EntityType::class;
    }

    /**
     * @param FormView $view
     * @param FormInterface $form
     * @param array $options
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if ($this->type !== self::TYPE_SELECTPICKER) {
            return;
        }

        if (!isset($view->vars['attr'])) {
            $view->vars['attr'] = [];
        }

        $view->vars['attr'] = array_merge(
            $view->vars['attr'],
            ['class' => 'selectpicker', 'data-live-search' => true, 'data-width' => '100%']
        );
    }
}
