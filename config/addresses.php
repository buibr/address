<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    |
    | This option defines the database table name used to store address records.
    | Set this value before running your first migration. Do not change it after
    | migrations have been run, as it may break existing data or references.
    | You can override the default table name by setting the ADDRESS_TABLE
    | environment variable, or it will default to 'addresses'.
    */
    'table' => env('BI_ADDRESSES_TABLE', 'addresses'),

    /*
    |--------------------------------------------------------------------------
    | Address Model
    |--------------------------------------------------------------------------
    |
    | To customize address behavior, extend the \Bi\Address\Address class
    | with your own implementation and specify its full class name here.
    |
    */
    'model' => \Bi\Address\Address::class,

    /*
    |--------------------------------------------------------------------------
    | Required Address Fields
    |--------------------------------------------------------------------------
    |
    | Different applications may require different address fields.
    | Specify here which attributes should be required by default
    | for your application.
    |
    */
    'required' => ['line1'],

    /*
    |--------------------------------------------------------------------------
    | Default Country
    |--------------------------------------------------------------------------
    |
    | If you want all new addresses to automatically have a country set, specify
    | the default country code here (ISO 3166-1 alpha-2).
    | For a list of codes, see: https://github.com/thephpleague/iso3166
    |
    */
    'default_country' => env('BI_ADDRESSES_DEFAULT_COUNTRY', 'AL'),

    /*
    |--------------------------------------------------------------------------
    | Address Display Format
    |--------------------------------------------------------------------------
    |
    | This option defines how the address will be formatted when accessed via
    | the "name" attribute on the Address model. You can customize the format
    | string using any fillable attribute as a placeholder, wrapped in square
    | brackets (e.g. [city], [zip], [country_name]).
    |
    | To change the formatting logic, you may also extend the base Address
    | class and override the relevant method.
    |
    */
    'name_format' => env('BI_ADDRESSES_NAME_FORMAT', '[door_number] [street], [city] [zip], [country_name] [country_code]'),

];
