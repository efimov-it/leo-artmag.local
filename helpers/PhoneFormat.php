<?php

namespace app\helpers;

class PhoneFormat
{
    public static function formatPhoneNumber($phoneNumber, $region = 'ru')
    {
        $phoneNumber = preg_replace('/\D+/', '', $phoneNumber);

        if (strlen($phoneNumber) !== 11) {
            return $phoneNumber;
        }

        if ($region === 'ru') {
            $formattedNumber = preg_replace('/(\d)(\d{3})(\d{3})(\d{2})(\d{2})/', '$1 $2 $3-$4-$5', $phoneNumber);
        }
        else {
            return $phoneNumber;
        }

        return $formattedNumber;
    }
}

