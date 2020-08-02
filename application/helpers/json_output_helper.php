<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	//To send the response in json formate
	function json_output($statusHeader,$response)
	{
		$ci =& get_instance();
		$ci->output->set_content_type('application/json');
		$ci->output->set_status_header($statusHeader);
		$ci->output->set_output(json_encode($response));
	}
?>