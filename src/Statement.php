<?php
/**
 * Foundry Query Builder.
 *
 * @copyright 2018 guvra
 * @license   MIT Licence
 */
namespace Foundry;

/**
 * Statement class.
 */
class Statement implements StatementInterface
{
    const FETCH_ASSOC = 2;
    const FETCH_NUM = 3;
    const FETCH_BOTH = 4;
    const FETCH_OBJECT = 5;
    const FETCH_CLASS = 8;

    /**
     * @var \PDOStatement
     */
    protected $pdoStatement;

    /**
     * @var int[]
     */
    protected $fetchModes = [
        self::FETCH_ASSOC,
        self::FETCH_NUM,
        self::FETCH_BOTH,
        self::FETCH_OBJECT,
        self::FETCH_CLASS,
    ];

    /**
     * @param \PDOStatement $pdoStatement
     */
    public function __construct(\PDOStatement $pdoStatement)
    {
        $this->pdoStatement = $pdoStatement;
        $this->setFetchMode(self::FETCH_ASSOC);
    }

    /**
     * {@inheritdoc}
     */
    public function fetchAll()
    {
        return $this->pdoStatement->fetchAll();
    }

    /**
     * {@inheritdoc}
     */
    public function fetchColumn(int $columnIndex = 0)
    {
        return $this->pdoStatement->fetchAll(\PDO::FETCH_COLUMN, $columnIndex);
    }

    /**
     * {@inheritdoc}
     */
    public function fetchRow()
    {
        return $this->pdoStatement->fetch();
    }

    /**
     * {@inheritdoc}
     */
    public function fetchOne(int $columnIndex = 0)
    {
        return $this->pdoStatement->fetchColumn($columnIndex);
    }

    /**
     * {@inheritdoc}
     */
    public function nextRow()
    {
        return $this->pdoStatement->nextRowset();
    }

    /**
     * {@inheritdoc}
     */
    public function getRowCount()
    {
        return $this->pdoStatement->rowCount();
    }

    /**
     * {@inheritdoc}
     */
    public function setFetchMode($fetchMode, $className = null)
    {
        $this->validateFetchMode($fetchMode);

        if ($fetchMode == self::FETCH_CLASS) {
            $this->pdoStatement->setFetchMode($fetchMode, $className ?: 'stdClass');
        } else {
            $this->pdoStatement->setFetchMode($fetchMode);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(array $bind = [])
    {
        return $this->pdoStatement->execute($bind);
    }

    /**
     * Get the PDO statement used internally.
     *
     * @return \PDOStatement
     */
    public function getPdoStatement()
    {
        return $this->pdoStatement;
    }

    /**
     * Validate the fetch mode.
     *
     * @param int $fetchMode
     * @throws \PDOException
     */
    protected function validateFetchMode(int $fetchMode)
    {
        if ($fetchMode && !in_array($fetchMode, $this->fetchModes)) {
            throw new \PDOException(sprintf('The fetch mode "%s" is not valid.', $fetchMode));
        }
    }
}
