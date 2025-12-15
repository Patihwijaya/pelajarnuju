<?php

if (!function_exists('getInstagramUsername')) {
    function getInstagramUsername($url)
    {
        if (empty($url)) {
            return null;
        }

        // Pastikan URL mengandung "instagram.com"
        if (stripos($url, 'instagram.com') === false) {
            return null;
        }

        // Hapus slash di akhir URL
        $url = rtrim($url, '/');

        // Ambil bagian terakhir setelah '/'
        $username = basename($url);

        // Hapus query string (misal ?utm_source=xxx)
        $username = strtok($username, '?');

        return trim($username);
    }
}
