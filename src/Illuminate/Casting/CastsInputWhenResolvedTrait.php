<?php

namespace Illuminate\Casting;

use Illuminate\Support\Carbon;

/**
 * Provides default implementation of CastsInputWHenValidated contract.
 */
trait CastsInputWhenResolvedTrait
{
    /**
     * Input that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Casts input.
     *
     * @return void
     */
    public function castInput()
    {

        $castedInput = [];

        foreach ($this->casts as $key => $type) {
            if ($this->has($key)) {
                $castedInput[$key] = $this->castInputValue($type, $this->input($key));
            }
        }

        $this->merge($castedInput);

    }

    protected function castInputValue($type, $value)
    {

        if (is_null($value)) {
            return $value;
        }

        switch ($type) {
            case 'int':
            case 'integer':
                return intval($value);
            case 'real':
            case 'float':
            case 'double':
                return floatval($value);
            case 'string':
                return (string) $value;
            case 'bool':
            case 'boolean':
                return filter_var($value, FILTER_VALIDATE_BOOLEAN);
            case 'date':

                if (is_numeric($value)) {
                    return Carbon::createFromTimestamp($value);
                } else {
                    return Carbon::parse($value);
                }

            default:
                return $value;
        }

    }
}
