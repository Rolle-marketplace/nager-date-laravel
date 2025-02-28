<?php

namespace RolleMarketplace\NagerDateLaravel\DTOs;

abstract class BaseDTO
{
    /**
     * Create a new DTO instance from an array
     *
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data)
    {
        return new static($data);
    }

    /**
     * Convert the DTO to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        $result = [];
        $properties = get_object_vars($this);

        foreach ($properties as $property => $value) {
            if ($value instanceof BaseDTO) {
                $result[$property] = $value->toArray();
            } elseif (is_array($value) && !empty($value) && $value[0] instanceof BaseDTO) {
                $result[$property] = array_map(function ($item) {
                    return $item->toArray();
                }, $value);
            } else {
                $result[$property] = $value;
            }
        }

        return $result;
    }
}