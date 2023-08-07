<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    |
    */
    'table'           => env('ADDRESS_TABLE', 'addresses'),

    /*
    |--------------------------------------------------------------------------
    | Address model
    |--------------------------------------------------------------------------
    |
    | You can create your own methods by extending this \Bi\Address\Address
    | class and this with your full class name.
    |
    */
    'model'           => \Bi\Address\Address::class,

    /*
    |--------------------------------------------------------------------------
    | Required
    |--------------------------------------------------------------------------
    |
    | There are different needs in different applications for address params
    | Here you can define which of attributes are required for your
    | application as default.
    |
    */
    'required' => ['line1'],

    /*
    |--------------------------------------------------------------------------
    | Country
    |--------------------------------------------------------------------------
    |
    | Sometimes we need to create something to specific countries
    | If this is set, will be auto attached on create.
    | see: https://github.com/thephpleague/iso3166
    |
    */
    'default_country' => 'AL',

    /*
    |--------------------------------------------------------------------------
    | Format
    |--------------------------------------------------------------------------
    |
    | By default this package has implemented name attribute as mutator
    | You can modify by extending the base class and the method or
    | setup here the format you want to be returned
    |
    | See Address model for fillable attributes
    |
    */
    'name_format'     => '[door_number] [street], [city] [zip], [country_name] [country_code]',

];
