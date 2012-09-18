<?php
	/*
	* Log Class
	* Allows the use of log file in a web application
	*
	* PHP Version 5
	*
	* License GNU GPL ...............
	*
	* @category	development
	* @package 	
	* @author 	Romain Daquin <daquin.romain@gmail.com>
	* @website 	www.rdaquin.fr
	* @license ...
	* @version 0.1 Beta
	*/

	// $tab_format_date = [
	// 	"default"	=> DATE_RSS,
	// 	"en"		=> "g:i a, F j, Y",
	// 	"fr"		=> "G:i:s le j/n/Y"
	// ];

	

	class Log
	{
		private static $tab_format_date = array(
			"default"	=> "g:i a, F j, Y",
			"en"		=> "g:i a, F j, Y",
			"fr"		=> "G:i:s \l\e j/n/Y"
		);

		private $file;
		private $path;
		private $filename;
		private $date_format;

		function __construct($filename,$path,$date_format) {
			Log::setPath($path);
			Log::setFilename($filename);
			Log::setDateFormat($date_format);
			
			$file = Log::openfile();
		}

		function __destruct() {
        	Log::closefile();
    	}

		private function openfile() {
			if(strpos($this->filename, '.txt') == false)
				$this->file = fopen($this->path.$this->filename.".txt", 'a');
			else
				$this->file = fopen($this->path.$this->filename, 'a');
		}

		function writeLongFile($label,$desc) {
			fputs($this->file, Log::makeDate()." - [".$label."] - ".$desc."\n");
		}

		function writeShortFile($desc) {
			fputs($this->file, Log::makeDate()." - ".$desc."\n");
		}

		private function closefile() {
			fclose($this->file);
		}

		/* Getter & Setter */
		private function setFilename($filename) {
			$this->filename = $filename;
		}

		private function setPath($path) {
			$this->path = $path;
		}

		private function setDateFormat($format) {
			$flag = false;

			foreach (Log::$tab_format_date as $key => $value) {
				if(strcmp($key, $format) == 0)
					$flag = true;
			}

			if($flag == true)
				$this->date_format = Log::$tab_format_date[$format];
			else
				$this->date_format = Log::$tab_format_date['default'];
		}

		/* function for class */
		private function makeDate() {
			return date($this->date_format);
		}
	}
?>