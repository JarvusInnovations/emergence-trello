<?php

namespace Jarvus\Trello;


class API
{
    public static $key;
    public static $token;
    public static $baseUrl = 'https://api.trello.com/1';

    public static function getKey()
    {
        return static::$key;
    }

    public static function getToken()
    {
        return static::$token;
    }

    public static function request($path, array $options = [])
    {
        // init get params
        if (empty($options['get'])) {
            $options['get'] = [];
        }

        // init post params
        if (empty($options['post'])) {
            $options['post'] = [];
        }

        // init headers
        if (empty($options['headers'])) {
            $options['headers'] = [];
        }

        if (empty($options['skipAuth'])) {
            $options['get']['key'] = empty($options['key']) ? static::getKey() : $options['key'];
            $options['get']['token'] = empty($options['token']) ? static::getToken() : $options['token'];
        }

        $options['headers'][] = 'User-Agent: emergence';

        // init url
        $url = static::$baseUrl . '/' . trim($path, '/');

        if (!empty($options['get'])) {
            $url .= '?' . http_build_query(array_map(function($value) {
                if (is_bool($value)) {
                    return $value ? 'true' : 'false';
                }

                return $value;
            }, $options['get']));
        }

        // configure curl
        $ch = curl_init($url);

        // configure output
        if (!empty($options['outputPath'])) {
            $fp = fopen($options['outputPath'], 'w');
            curl_setopt($ch, CURLOPT_FILE, $fp);
        } else {
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        }

        // configure method and body
        if (!empty($options['post'])) {
            if (empty($options['method']) || $options['method'] == 'POST') {
                curl_setopt($ch, CURLOPT_POST, true);
            } else {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $options['method']);
            }

            curl_setopt($ch, CURLOPT_POSTFIELDS, $options['post']);
        }

        // configure headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, $options['headers']);

        // execute request
        $result = curl_exec($ch);
        curl_close($ch);

        if (isset($fp)) {
            fclose($fp);
        } elseif (!isset($options['decodeJson']) || $options['decodeJson']) {
            $result = json_decode($result, true);
        }

        return $result;
    }
}