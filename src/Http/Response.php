<?php
namespace App\Http;

class Response
{
    private string $body;

    public function __construct() {
        $this->body = "";
    }

    public function get() {
        return $this->body;
    }

    public function append(string $text) {
        $this->body .= $text;
    }

    public function set(string $text) {
        $this->body = $text;
    }
}