<?php

namespace Pacman\lib\response;

class response
{
    private $content = '';
    private $statusCode = 200;
    
    public function __construct($content, $statusCode = 200)
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
    }
    
    public function send()
    {
        http_response_code($this->statusCode);
        echo $this->content;
    }
}
