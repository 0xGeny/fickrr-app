<?php

/*
 * This file is part of the Laravel Paystack package.
 *
 * (c) Prosper Otemuyiwa <prosperotemuyiwa@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /**
     * Public Key From Paystack Dashboard
     *
     */
    'publicKey' => config('paystack.publicKey'),

    /**
     * Secret Key From Paystack Dashboard
     *
     */
    'secretKey' => config('paystack.secretKey'),

    /**
     * Paystack Payment URL
     *
     */
    'paymentUrl' => config('paystack.paymentUrl'),

    /**
     * Optional email address of the merchant
     *
     */
    'merchantEmail' => config('paystack.merchantEmail'),

];
