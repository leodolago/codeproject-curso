<?php
/**
 * Created by PhpStorm.
 * User: leodolago
 * Date: 30/05/2016
 * Time: 10:02
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{

    protected $rules = [
        'owner_id' => 'required|integer',
        'client_id' => 'required|integer',
        'name' => 'required|max:125',
        'progress' => 'required',
        'status' => 'required',
        'due_date' => 'required'
    ];
    
}