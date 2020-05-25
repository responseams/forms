<?php

namespace Response\Forms\Concerns;

use Illuminate\Support\Collection;

trait AcceptsMeta
{

    /** @var Collection */
    public $meta;

    /**
     * Adds additional metadata to be sent with the Field.
     *
     * @param mixed $meta
     * @return void
     */
    public function withMeta($meta)
    {
        if (is_null($this->meta)) {
            $this->meta = new Collection();
        }

        $this->meta->merge($meta);

        return $this;
    }

    /**
     * Returns the meta Collection.
     *
     * @return Collection
     */
    protected function meta(): Collection
    {
        return $this->meta;
    }

}
