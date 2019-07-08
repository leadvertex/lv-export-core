<?php
/**
 * Created for lv-export-core.
 * Datetime: 02.07.2018 16:53
 * @author Timur Kasumov aka XAKEPEHOK
 */

namespace Leadvertex\Plugin\Export\Core\FieldDefinitions;


use Leadvertex\Plugin\Export\Core\Components\MultiLang;

class IntegerDefinition extends FieldDefinition
{

    public function __construct(MultiLang $label, MultiLang $description, $default, bool $required)
    {
        $default = (int) $default;
        parent::__construct($label, $description, $default, $required);
    }

    /**
     * @return string
     */
    public function definition(): string
    {
        return 'integer';
    }

    /**
     * @param int $value
     * @return bool
     */
    public function validateValue($value): bool
    {
        if (!$this->isRequired() && is_null($value)) {
            return true;
        }

        return is_int($value);
    }
}