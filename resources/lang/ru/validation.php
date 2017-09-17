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

    'accepted'             => 'Атрибут :attribute должен быть принят.',
    'active_url'           => 'Атрибут :attribute не является допустимым URL.',
    'after'                => 'Атрибут :attribute должен быть датой после :date.',
    'alpha'                => 'Атрибут :attribute может содержать только буквы.',
    'alpha_dash'           => 'Атрибут :attribute может содержать только буквы, числа и тире.',
    'alpha_num'            => 'Атрибут :attribute может содержать только буквы, числа.',
    'array'                => 'Атрибут :attribute должен являться массивом.',
    'before'               => 'Атрибут :attribute должен быть датой до :date.',
    'between'              => [
        'numeric' => 'Число :attribute должено быть от :min до :max.',
        'file'    => 'Файл :attribute должен быть от :min до :max килобайт.',
        'string'  => 'Строка :attribute должна содержать от :min до :max символов.',
        'array'   => 'Массив :attribute должен иметь от :min до :max элементов.',
    ],
    'boolean'              => 'Поле :attribute должно быть true или false.',
    'confirmed'            => 'Утверждение :attribute не верно.',
    'date'                 => 'Атрибут :attribute не является допустимой датой.',
    'date_format'          => 'Атрибут :attribute не соответствует формату :format.',
    'different'            => 'Атрибуты :attribute и :other должны быть различны.',
    'digits'               => 'Атрибут :attribute должен быть из :digits цифр.',
    'digits_between'       => 'Атрибут :attribute должен содержать от :min до :max цифр.',
    'distinct'             => 'Значение поля :attribute дублируется.',
    'email'                => 'Атрибут :attribute должен быть допустимым email адресом.',
    'exists'               => 'Выбранный атрибут :attribute допустим.',
    'filled'               => 'Поле :attribute является необходимым.',
    'image'                => 'Атрибут :attribute должен быть картинкой.',
    'in'                   => 'Выбранный атрибут :attribute допустим.',
    'in_array'             => 'Значение поля :attribute отсутствует в :other.',
    'integer'              => 'Атрибут :attribute должен быть числом.',
    'ip'                   => 'Атрибут :attribute должен быть допустимым IP адресом.',
    'json'                 => 'Атрибут :attribute должен быть допустимой JSON строкой.',
    'max'                  => [
        'numeric' => 'Число :attribute не должено быть больше :max.',
        'file'    => 'Файл :attribute не должен быть больше :max килобайт.',
        'string'  => 'Строка :attribute не должна содержать больше :max символов.',
        'array'   => 'Массив :attribute не должен иметь больше :max элементов.',
    ],
    'mimes'                => 'Атрибут :attribute должен быть файлом типа: :values.',
    'min'                  => [
        'numeric' => 'Число :attribute должно быть не меньше :min.',
        'file'    => 'Файл :attribute должен быть как минимум :min Килобайт.',
        'string'  => 'Строка :attribute должна содержать как минимум :min символов.',
        'array'   => 'Массив :attribute должен содержать как минимум :min элементов.',
    ],
    'not_in'               => 'Выбранный атрибут :attribute недопустим.',
    'numeric'              => 'Атрибут :attribute должен быть числом.',
    'present'              => 'Атрибут :attribute должен быть существующим.',
    'regex'                => 'Атрибут :attribute недопустимого формата.',
    'required'             => 'Атрибут :attribute является необходимым.',
    'required_if'          => 'Атрибут :attribute является необходимым когда :other является :value.',
    'required_unless'      => 'Атрибут :attribute является необходимым если :other находится в :values.',
    'required_with'        => 'Атрибут :attribute является необходимым когда :values существует.',
    'required_with_all'    => 'Атрибут :attribute является необходимым когда :values существует.',
    'required_without'     => 'Атрибут :attribute является необходимым когда :values не существует.',
    'required_without_all' => 'Атрибут :attribute является необходимым когда ни одно из :values не существует.',
    'same'                 => 'Атрибуты :attribute и :other должны совпадать.',
    'size'                 => [
        'numeric' => 'Число :attribute должно быть :size.',
        'file'    => 'Файл :attribute должен быть :size килобайт.',
        'string'  => 'Строка :attribute должна содержать :size символов.',
        'array'   => 'Массив :attribute должен содержать :size элементов.',
    ],
    'string'               => 'Атрибут :attribute должен быть строкой.',
    'timezone'             => 'Атрибут :attribute должен быть допустимым часовым поясом.',
    'unique'               => 'Атрибут :attribute был уже получен.',
    'url'                  => 'Атрибут :attribute недопустимого формата.',

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
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
