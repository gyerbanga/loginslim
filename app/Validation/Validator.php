<?php

namespace App\Validation;
use Respect\Validation\Validator as Respect;
use Slim\Http\Request;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator
{
    protected $errors;

    /**
     * @param Request $request
     * @param array $rules
     * @return $this
     * 1. boucle après toutes les règles
     * 2. vérifier si l'une des règles échouera
     * 3. en cas d'échec, l'une des règles imprime un message
     */
    public function validate(Request $request, array $rules)
    {
        foreach ($rules as $field => $rule) {

            try {
                $rule->setName(ucfirst($field))->assert($request->getParam($field));
            } catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            }
        }


        $_SESSION['errors'] = $this->errors;

        return $this;
    }

    public function failed()
    {
        return !empty($this->errors);
    }
}