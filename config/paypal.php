<?php
return array(
    // set your paypal credential
    'client_id' => 'AfSSDdQrYGgAn1u2eUTM9RHb6oYUe60Jgf9rVqia6h-om8-LcuqYDN76JjvP6Wc_Z16UWMmsET-Zztix',
    'secret' => 'EHoDluyXHV-CO-keGAVzE-OxAy6halemq72UC22ixL6Nkdyw7FA-e460FPvoZC-3mWRFbfmlx7R6pv2U',

    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);