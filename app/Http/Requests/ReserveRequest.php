<?php

namespace App\Http\Requests;

use App\Rules\PeopleSum;
use Illuminate\Foundation\Http\FormRequest;

class ReserveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'room_id' => ['required'],
            'room_name' => ['required'],
            'arrival' => ['required'],
            'stay' => ['required'],
            'lastname' => ['required','max:20'],
            'firstname' => ['required','max:20'],
            'email' => ['required', 'email'],
            'address' => ['required',],
            'tel' => ['required', 'digits_between:9,11'],
            'people' => ['required', 'digits_between:1,2', new PeopleSum($this->people, $this->men, $this->women)],
            'men' => ['required', 'digits_between:1,2'],
            'women' => ['required', 'digits_between:1,2'],
            'checkin_time' => ['required',],
            'totalprice' => ['required', 'integer'],
        ];
    }
}
