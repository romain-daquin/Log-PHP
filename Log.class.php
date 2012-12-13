<?php
	/*
	* Log Class
	* Allows the use of log file in a web application
	*
	* PHP Version 5
	*
	* License GNU GPL
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
	*
	* @category	development
	* @package 	
	* @author 	Romain Daquin <daquin.romain@gmail.com>
	* @website 	www.rdaquin.fr
	* @license GNU GPL
	* @version 1.0
	*/

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