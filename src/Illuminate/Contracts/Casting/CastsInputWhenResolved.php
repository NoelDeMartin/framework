<?php

namespace Illuminate\Contracts\Casting;

interface CastsInputWhenResolved
{
    /**
     * Casts input.
     *
     * @return void
     */
    public function castInput();
}
