<?php

namespace RahulJayaraman\DoctrineGraphQL\Annotations;

/**
 * @Annotation
 * @Target({"METHOD"})
 */
class RegisterField {
    /** @Required */
    public $type;

    public $isList;
    public $args;
    public $name;

    public function __construct(array $values)
    {
        $this->type = $values['type'];
        $this->args = $this->buildArgs($values);
        $this->isList = isset($values['isList']) ? $values['isList'] : false;
        $this->name = isset($values['name']) ? $values['name'] : null;
    }

    private function buildArgs($values)
    {
        if (!isset($values['args'])) {
            return [];
        }

        return array_map(function ($arg) {
            return [
                'name' => $arg[0],
                'type' => $arg[1],
                'nullable' => isset($arg[2]) ? $arg[2] === 'nullable' : false
            ];
        }, $values['args']);
    }
}
