<?php

/* 
 * Copyright (C) 2017 Twobacs
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

class ziApp{
    private $path;
    public $pdo;
    public $index;
    public $content;
    private $application;
    private $function;

    public function __construct($appPath){
        //SET THE LOCATION OF THE WEBISTE
        $this->path=$appPath;
        //OBTAIN THE PROPERTIES OF THE WEBSITE IN USE
        include_once $this->path.'/configuration/main.config.php';
        $tempApplication=  filter_input(INPUT_GET, 'application');
        $this->application=(isset($tempApplication)) ? ucfirst($tempApplication) : ucfirst($defaultApplication);
        $tempFunction=  filter_input(INPUT_GET, 'application');
        $this->function=(isset($tempFunction)) ? ucfirst($tempFunction) : ucfirst($defaultFunction);
        $this->loadApplication();
    }
    
    private function loadApplication(){
        include_once $this->path.'/applications/'.$this->application.'/controler_'.$this->application.'.php';
        $Ctemp='C'.$this->application;
        $Mtemp='M'.$this->application;
        $appInUse = new $Ctemp($this->application,$this->pdo);
        $temp=$this->function;
        $this->content=$appInUse->$temp();
    }
    
    public function showSite(){
        include_once $this->path.$this->index;
    }
}