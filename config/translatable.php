<?php

return [
    /*
     * The model class name of the translation model.
     */
    'translation_model' => Spatie\Translatable\Translation::class,

    /*
     * The model class name of the translatable model.
     */
    'translatable_model' => Spatie\Translatable\Translatable::class,

    /*
     * This is the name of the table that will be created by the migration and
     * used by the Translation model shipped with this package.
     */
    'translations_table_name' => 'translations',

    /*
     * This is the database connection that will be used by the migration and
     * the Translation model shipped with this package. In case it's not set
     * Laravel's database.default will be used instead.
     */
    'translations_table_connection' => null,

    /*
     * This is the name of the foreign key to the model that owns the translation.
     * The foreign key should be prefixed with the table name.
     */
    'translatable_foreign_key' => 'translatable_id',

    /*
     * This is the name of the foreign key to the model that owns the translation.
     * The foreign key should be prefixed with the table name.
     */
    'translatable_type' => 'translatable_type',

    /*
     * This is the name of the foreign key to the model that owns the translation.
     * The foreign key should be prefixed with the table name.
     */
    'locale_key' => 'locale',

    /*
     * This is the name of the foreign key to the model that owns the translation.
     * The foreign key should be prefixed with the table name.
     */
    'value_key' => 'value',

    /*
     * This is the name of the foreign key to the model that owns the translation.
     * The foreign key should be prefixed with the table name.
     */
    'translatable_models' => [
        // 'App\Models\Post',
        // 'App\Models\Category',
    ],

    /*
     * This is the name of the foreign key to the model that owns the translation.
     * The foreign key should be prefixed with the table name.
     */
    'locales' => [
        'en',
        'vi',
    ],

    /*
     * This is the name of the foreign key to the model that owns the translation.
     * The foreign key should be prefixed with the table name.
     */
    'fallback_locale' => 'en',

    /*
     * This is the name of the foreign key to the model that owns the translation.
     * The foreign key should be prefixed with the table name.
     */
    'translatable_attributes' => [
        // 'App\Models\Post' => ['title', 'content'],
        // 'App\Models\Category' => ['name', 'description'],
    ],
]; 