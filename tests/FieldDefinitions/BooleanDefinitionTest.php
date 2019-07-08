<?php

namespace Leadvertex\Plugin\Export\Core\FieldDefinitions;


use Exception;
use Leadvertex\Plugin\Export\Core\Components\MultiLang;
use PHPUnit\Framework\TestCase;

class BooleanDefinitionTest extends TestCase
{

    /** @var BooleanDefinition */
    private $checkboxDefinition;

    /** @var MultiLang */
    private $label;

    /** @var MultiLang */
    private $description;

    /** @var string */
    private $default;

    /** @var bool */
    private $required;

    /**
     * @throws Exception
     */
    public function setUp()
    {
        parent::setUp();
        $this->label = new MultiLang([
            'en' => 'Use field',
            'ru' => 'Использовать поле',
        ]);

        $this->description = new MultiLang([
            'en' => 'Description',
            'ru' => 'Описание',
        ]);

        $this->default = 'Test value for default param';
        $this->required = true;

        $this->checkboxDefinition = new BooleanDefinition(
            $this->label,
            $this->description,
            $this->default,
            $this->required
        );
    }

    public function testDefinition()
    {
        $this->assertEquals('boolean', $this->checkboxDefinition->definition());
    }

    /**
     * @dataProvider dataProviderForValidate
     * @param bool $required
     * @param $value
     * @param bool $expected
     * @throws Exception
     */
    public function testValidateValue(bool $required, $value, bool $expected)
    {
        $definition = new BooleanDefinition(
            $this->label,
            $this->description,
            $this->default,
            $required
        );

        $this->assertEquals($expected, $definition->validateValue($value));
    }

    /**
     * @return array
     * @throws Exception
     */
    public function dataProviderForValidate()
    {
        return [
            [
                'required' => true,
                'value' => false,
                'expected' => false,
            ],
            [
                'required' => true,
                'value' => true,
                'expected' => true,
            ],

            [
                'required' => false,
                'value' => false,
                'expected' => true,
            ],
            [
                'required' => false,
                'value' => null,
                'expected' => false,
            ],
            [
                'required' => false,
                'value' => random_int(1, 100),
                'expected' => false,
            ],
            [
                'required' => false,
                'value' => [],
                'expected' => false,
            ],
            [
                'required' => false,
                'value' => 'string',
                'expected' => false,
            ],
        ];
    }

    public function testGetDefaultValue()
    {
        $this->assertEquals($this->default, $this->checkboxDefinition->getDefaultValue());
    }

    public function testIsRequired()
    {
        $this->assertEquals($this->required, $this->checkboxDefinition->isRequired());
    }
}
