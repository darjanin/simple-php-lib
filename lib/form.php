<?php 
class Form {
	var $form, $method;

	// TODO: send more arguments in dictionary. method and action basic lvl
	public function __construct($method = 'post', $action = '', $legend = null, $stacked='true') {
		$class = $stacked ? "pure-form pure-form-stacked" : "pure-form";
		$this->form = "<form method='$method' action='$action' class='$class'><fieldset>";
		if (isset($legend)) {
			$this->form .= "<legend>$legend</legend>";
		}
	}

	public function input($name, $label = null, $type = 'text') {
		if (!isset($label)) {
			$label = $name;
		}
		$this->form .= "<label for='$name'>$label</label>";
		$this->form .=  "<input type='$type' id='$name' placeholder='$label'/>";
	}

	public function generate() {
		$this->form .= "</fieldset></form>";
		return $this->form;
	}

}
 ?>