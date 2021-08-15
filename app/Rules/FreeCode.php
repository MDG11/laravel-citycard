<?php

namespace App\Rules;

use App\Models\Card;
use Illuminate\Contracts\Validation\Rule;

class FreeCode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $card = Card::where('card_code', '=', $value)->first();
        return ($card && $card->user_id == null); 
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The card is used by other user, contact us if you think it`s a mistake.';
    }
}
