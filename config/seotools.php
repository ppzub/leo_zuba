<?php

return [
    'meta'      => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => false, // set false to total remove
            'description'  => 'В нас є все, щоб зробити ваше весілля найкращим! Музика і ведучий на весілля, шоу-балет, декор, фото та відеозйомка', // set false to total remove
            'separator'    => ' - ',
            'keywords'     => ['весілля', 'музика', 'ведучий', 'декор', 'фото', 'відео'],
            'canonical'    => false, // Set null for using Url::current(), set false to total remove
        ],

        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
        ],
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'kazka agency - все для вашого свята', // set false to total remove
            'description' => 'В нас є все, щоб зробити ваше весілля найкращим! Музика і ведучий на весілля, шоу-балет, декор, фото та відеозйомка', // set false to total remove
            'url'         => null, // Set null for using Url::current(), set false to total remove
            'type'        => 'website',
            'site_name'   => 'kazka agency',
            'images'      => ['asset("images/small")/default_small.png'],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
          //'card'        => '',
          //'site'        => '',
        ],
    ],
];
