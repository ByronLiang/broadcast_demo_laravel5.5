<?php

namespace App\Services;

use GuzzleHttp\Client;

class DouBanDataService
{
    private $client;
    private $url = 'https://api.douban.com/v2/';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->url,
            'timeout' => '60',
        ]);
    }

    private function handleResponse($response)
    {
        if (substr($response->getStatusCode(), 0, 1) != 2) {
            $message = (string) $response->getBody();
            error_log($message);
            \Log::error($message);

            return false;
        }

        return true;
    }


    public function fetcheBookData($keyword, $start, $count)
    {
        $get_uri = 'book/search'.'?q='.urlencode($keyword).'&count='.$count.'&start='.$start;
        $response = $this->client->get($get_uri);
        if ($this->handleResponse($response)) {
            $douban_json = $response->getBody()->getContents();
            $douban_json = json_decode($douban_json, true);
            if (count($douban_json) > 0) {
                return $douban_json['books'];
            }
        } else {
            return [];
        }
    }

    public function fetchMovieData($start, $count)
    {
        $get_uri = 'movie/top250?start=' . $start . '&count=' . $count;
        $response = $this->client->get($get_uri);
        if ($this->handleResponse($response)) {
            $douban_json = $response->getBody()->getContents();
            $douban_json = json_decode($douban_json, true);
            if (count($douban_json) > 0) {
                return $douban_json['subjects'];
            }
        } else {
            return [];
        }
    }

}