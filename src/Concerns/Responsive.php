<?php

namespace Response\Forms\Concerns;

trait Responsive
{

    public $responsiveClasses = [];

    public function fullWidth()
    {
        $this->responsiveClasses[] = "w-full";
    }

    /**
     * Sets the default span width.
     *
     * @param string|int $value
     * @return mixed
     */
    public function span($value)
    {
        $this->addColSpanClass($value);

        return $this;
    }

    /**
     * Sets the span width on small screens using the sm breakpoint.
     *
     * @param string|int $value
     * @return mixed
     */
    public function smSpan($value)
    {
        $this->addColSpanClass($value, "sm");

        return $this;
    }

    /**
     * Sets the span width on medium screens using the md breakpoint.
     *
     * @param string}int $value
     * @return mixed
     */
    public function mdSpan($value)
    {
        $this->addColSpanClass($value, "md");

        return $this;
    }

    /**
     * Sets the span width on large screens using the lg breakpoint.
     *
     * @param string|int $value
     * @return mixed
     */
    public function lgSpan($value)
    {
        $this->addColSpanClass($value, "lg");

        return $this;
    }

    /**
     * Sets the span width on extra large screens using the xl breakpoint.
     *
     * @param string}int $value
     * @return mixed
     */
    public function xlSpan($value)
    {
        $this->addColSpanClass($value, "xl");

        return $this;
    }

    /**
     * Returns the responsive classes.
     *
     * @return array
     */
    public function getResponsiveClasses()
    {
        return $this->responsiveClasses;
    }

    /**
     * Adds a `col-span-XXX` class for the specified screen breakpoint.
     *
     * @param string|int $span
     * @param string $screen
     * @return void
     */
    private function addColSpanClass($span, $screen = null)
    {
        if ($screen !== null) {
            $screen += ':';
        }

        $this->responsiveClasses[] = sprintf("%scol-span-%s", $screen, $span);
    }

}
