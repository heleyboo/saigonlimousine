<?php

return [
    /*
     * The model that will be used to represent tags.
     */
    'model' => App\Models\Tag::class,

    /*
     * The table that will be used to store tags.
     */
    'table' => 'tags',

    /*
     * The table that will be used to store taggables.
     */
    'taggables_table' => 'taggables',

    /*
     * The foreign key that will be used to reference tags.
     */
    'foreign_key' => 'tag_id',

    /*
     * The foreign key that will be used to reference taggables.
     */
    'taggable_foreign_key' => 'taggable_id',

    /*
     * The column that will be used to store the taggable type.
     */
    'taggable_type_column' => 'taggable_type',

    /*
     * The column that will be used to store the taggable id.
     */
    'taggable_id_column' => 'taggable_id',
]; 