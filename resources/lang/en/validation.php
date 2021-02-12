<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'A :attribute el kell fogadni.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'A(z) :attribute megerősítése nem egyezik.',
    'date' => 'A(z) :attribute nem egy valós dátum.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'Az :attribute valós email kell hogy legyen.',
    'ends_with' => 'The :attribute must end with one of the following: :values',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'A(z) :attribute szám kell hogy legyen.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'A(z) :attribute csak :values kiterjesztésű lehet.',
    'mimetypes' => 'A :attribute mező csak :values lehet!',
    'min' => [
        'numeric' => 'A(z) :attribute legalább :min karakternek kell lennie.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'A(z) :attribute legalább :min karakterből kell hogy álljon.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'Helytelen jelszó.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'A :attribute érvénytelen.',
    'required' => ':attribute mező kötelező.',
    'required_if' => 'Az :attribute mező kötelező amikor a :other :value.', //custom
    //'required_if' => 'Az :attribute mező kötelező amikor csapatvezetőként szeretnél regisztrálni.', //custom
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'A :attribute és :other meg kell hogy egyezzen.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'A :attribute valós karakterekből kell hogy álljon.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'Az :attribute már foglalt.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'team' => [
            'required_if' => 'Egyesület mező kötelező amikor Csapatvezető a Típus',
        ],
        'teams_id' => [
            'required_if' => 'Egyesület mező kötelező amikor Csapatvezetőként szeretnél regisztrálni.',
        ],
        'form.privacy_policy' => [
            'min' => 'Az Adatkezelési Tájékoztatót kötelező elfogadni.'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'email' => 'Email cím',
        'password' => 'Jelszó',
        'current_password' => 'Régi jelszó',
        'password' => 'Új jelszó',
        'password_confirmation' => 'Új jelszó mégegyszer',
        'meets_id' => 'Verseny',
        'app' => 'Alkalmazás',
        'type' => 'Típus',
        'name' => 'Név',
        'vnev' => 'Vezetéknév',
        'knev' => 'Keresztnév',
        'mother' => 'Anyja neve',
        'terms' => 'Felhasználási feltételek elfogadása',
        'competitors_id' => 'Versenyző',
        'teams_id' => 'Egyesület',
        'team' => 'Egyesület',
        'zip' => 'Irányítószám',
        'address' => 'Cím',
        'tax_id' => 'Adóazonosító',
        'sa' => 'SA',
        'file' => 'Fájl',
        'data_sheet' => 'Adatlap',
        'profile_photo' => 'Profilkép',
        'sport_sheet' => 'Sportorvosi igazolás',
        'form' => [
            'vnev' => 'Vezetéknév',
            'knev' => 'Keresztnév',
            'email' => 'Email cím',
            'competitors_id' => 'Versenyző',
            'comp_type' => 'Sportág típusa',
            'mother' => 'Anyja neve',
            'birth' => 'Születési dátum',
            'birth_place' => 'Születési hely',
            'address' => 'Cím',
            'sex' => 'Neme',
            'zip' => 'Irányítószám',
            'city' => 'Város',
            'mobile' => 'Mobiltelefon szám',
            'team_reg_code' => 'Egyesületi regisztrációs szám',
            'federal_reg_code' => 'Szövetségi regisztrációs szám',
            'privacy_policy' => 'Adatkezelési tájékoztató',
            'tax_id' => 'Adóazonosító',
            'coach' => 'Csapatvezető',
            'teams_id' => 'Egyesület',
            'team' => 'Egyesület',
            'file' => 'Fájl',
            'can_race' => 'Sportorvosi eredménye',
            'sport_time' => 'Sportorvosi időpontja',
            'sport_valid' => 'Sportorvosi érvényesség'
        ]
    ],

];
