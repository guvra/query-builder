<?php
/**
 * PHP Query Builder.
 *
 * @copyright 2018 guvra
 * @license   MIT Licence
 */
namespace Guvra\Builder\Clause\Select;

use Guvra\Builder\Builder;

/**
 * DISTINCT builder.
 */
class Distinct extends Builder
{
    /**
     * @var bool
     */
    protected $value = false;

    /**
     * Set the DISTINCT value.
     *
     * @param bool $value
     * @return $this
     */
    public function setValue(bool $value)
    {
        $this->value = $value;
        $this->compiled = null;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function compile()
    {
        return $this->value ? 'DISTINCT' : '';
    }

    /**
     * {@inheritdoc}
     */
    protected function decompile()
    {
        $this->value = false;

        return $this;
    }
}
