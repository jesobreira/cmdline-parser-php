<?php

namespace CmdLine;

class Parser {
	function get($sKey, $mDefault = Null) {
		global $argv,$argc;
		for($i = 1; $i <= ($argc-1); $i++) {
			if($argv[$i]=="/".$sKey OR $argv[$i]=="-".$sKey OR $argv[$i]=="--".$sKey) {
				if($argc>=$i+1) {
					return $argv[$i+1];
				}
			}
		}
	}
	
	function keyexists($sKey) {
		global $argv,$argc;
		for($i = 1; $i <= ($argc-1); $i++) {
			if($argv[$i]=="/".$sKey OR $argv[$i]=="-".$sKey OR $argv[$i]=="--".$sKey) {
				return true;
			}
		}
		return false;
	}
	
	function valueexists($sValue) {
		global $argv,$argc;
		for($i = 1; $i <= ($argc-1); $i++) {
			if($argv[$i]==$sValue) return true;
		}
		return false;
	}
	
	function flagenabled($sKey) {
		global $argv,$argc;
		for($i = 1; $i <= ($argc-1); $i++) {
			if(preg_match("/\+([a-zA-Z]*)".$sKey."([a-zA-Z]*)/", $argv[$i])) {
				return true;
			}
		}
		return false;
	}
	
	function flagdisabled($sKey) {
		global $argv,$argc;
		for($i = 1; $i <= ($argc-1); $i++) {
			if(preg_match("/\-([a-zA-Z]*)".$sKey."([a-zA-Z]*)/", $argv[$i])) {
				return true;
			}
		}
		return false;
	}
	
	function flagexists($sKey) {
		global $argv,$argc;
		for($i = 1; $i <= ($argc-1); $i++) {
			if(preg_match("/(\+|\-)([a-zA-Z]*)".$sKey."([a-zA-Z]*)/", $argv[$i])) {
				return true;
			}
		}
		return false;
	}
	
	function getvalbyindex($iIndex, $mDefault = null) {
		global $argv,$argc;
		if(($argc-1)>=$iIndex) {
			return $argv[$iIndex];
		} else {
			return $mDefault;
		}
	}
}