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
 * GROUP BY builder.
 */
class Group extends Builder
{
    /**
     * @var string[]
     */
    protected $columns = [];

    /**
     * Set the columns.
     *
     * @param string[] $columns
     * @return $this
     */
    public function setColumns(array $columns)
    {
        $this->columns = $columns;
        $this->compiled = null;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function compile()
    {
        if (empty($this->columns)) {
            return '';
        }

        return 'GROUP BY ' . implode(', ', $this->columns);
    }

    /**
     * {@inheritdoc}
     */
    protected function decompile()
    {
        unset($this->columns);
        $this->columns = [];

        return $this;
    }
}