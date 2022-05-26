<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PeopleSum implements Rule
{
    protected $people;
    protected $men;
    protected $women;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $people, int $men, int $women)
    {
        $this->people = $people;
        $this->men = $men;
        $this->women = $women;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->people == $this->men + $this->women; 
        //
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '宿泊人数と、男性人数および女性人数を合わせてください。';
    }
}
