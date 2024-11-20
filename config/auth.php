<?php

return [
   /*
   |--------------------------------------------------------------------------
   | Authentication Defaults
   |--------------------------------------------------------------------------
   */
   'defaults' => [
       'guard' => 'web',
       'passwords' => 'user',
   ],

   /*
   |--------------------------------------------------------------------------
   | Authentication Guards
   |--------------------------------------------------------------------------
   */
  'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'pengunjung',
    ],
    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',
    ],
],

   /*
   |--------------------------------------------------------------------------
   | User Providers
   |--------------------------------------------------------------------------
   */
  'providers' => [
    'pengunjung' => [
        'driver' => 'eloquent',
        'model' => App\Models\Pengunjung::class,
    ],
    'admins' => [
        'driver' => 'eloquent',
        'model' => App\Models\Admin::class,
    ],
],

   /*
   |--------------------------------------------------------------------------
   | Resetting Passwords
   |--------------------------------------------------------------------------
   */
   'passwords' => [
       'pengunjung' => [
           'provider' => 'pengunjung',
           'table' => 'password_reset_tokens',
           'expire' => 60, // Token expire dalam 60 menit
           'throttle' => 60, // Tunggu 60 detik sebelum request reset password lagi
       ],
   ],

   /*
   |--------------------------------------------------------------------------
   | Password Confirmation Timeout
   |--------------------------------------------------------------------------
   */
   'password_timeout' => 10800,

];