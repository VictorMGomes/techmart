<?php

class IniLoader
{
    private $config;

    public function __construct($iniFilePath)
    {
        $this->loadConfig($iniFilePath);
    }

    private function loadConfig($iniFilePath)
    {
        if (!file_exists($iniFilePath)) die("INI file not found: $iniFilePath");

        $this->config = parse_ini_file($iniFilePath, true);

        if ($this->config === false) die("Failed to parse the INI file: $iniFilePath");
    }

    public function get($section, $key)
    {
        if (isset($this->config[$section][$key])) return $this->config[$section][$key];
        return null;
    }
}
