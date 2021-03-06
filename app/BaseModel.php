<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class BaseModel extends Model
{

    /**
     * ValidatorMessages.
     * 
     * Custom validator messages.
     * 
     * @return array Custom messages
     */
    public static function validatorMessages()
    {
        return [
            'required' => trans('app.validation.required'),
            'max'    => trans('app.validation.max'),
        ];
    }
    
    /**
     * Validate.
     * 
     * Validation with custom rules.
     * 
     * @param array $field Form field value
     * 
     * @return array
     */
    public static function validate($field)
    {
        $validator = Validator::make(self::validatorValue($field), self::validatorRules(), self::validatorMessages());
        return ['status' => (bool) !$validator->fails(),
                'msg' => $validator->messages()->all()];
    }
}