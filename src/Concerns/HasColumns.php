<?php

namespace Response\Forms\Concerns;

trait HasColumns
{

    /** @var int */
    protected $columns;

    /**
     * Sets the number of columns to be used for the Layout.
     *
     * @param integer $columns
     * @return self
     */
    public function columns($columns): self
    {
        $this->columns = $columns;

        return $this;;
    }

    /**
     * Gets the number of columns to render in thie Layout.
     *
     * @return integer
     */
    public function getColumns(): int
    {
        if (is_null($this->columns)) {
            return 7;
        }

        return $this->columns;
    }

}
