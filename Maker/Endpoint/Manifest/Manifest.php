<?php

namespace Zabachok\Symfobooster\Maker\Endpoint\Manifest;

class Manifest
{
    public string $domain;
    public string $endpoint;
    public string $method = 'GET';
    public Service $service;
    public Input $input;
}
