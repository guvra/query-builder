<?php
/**
 * PHP Query Builder.
 *
 * @copyright 2017 guvra
 * @license   MIT Licence
 */
namespace Guvra\Builder;

/**
 * Expression class.
 * Its value will never be quoted by the query builders.
 */
class Expression implements ExpressionInterface
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = (string) $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the expression value.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getValue();
    }
}
