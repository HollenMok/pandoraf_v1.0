<?php

/*
 * @desc session instance class/session 实例化类
 * @author HollenMok
 * @date 2015/08/15
 */
class pSession{
	
	public function __construct(){
		 //session start 
		  session_start();
		//session_destroy();
	}
}