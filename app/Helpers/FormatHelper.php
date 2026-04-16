<?php

if (!function_exists('formatRupiah')) {
    function formatRupiah($amount): string
    {
        if ($amount >= 1000000) {
            $millions = $amount / 1000000;
            // Remove trailing zeros and decimal point if unnecessary
            $formatted = number_format($millions, 1, ',', '.');
            $formatted = rtrim($formatted, '0');
            $formatted = rtrim($formatted, ',');
            return 'Rp ' . $formatted . ' juta';
        }

        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}
