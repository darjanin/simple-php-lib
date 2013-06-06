<?php 
class Form {
	var $form, $method;

	// TODO: send more arguments in dictionary. method and action basic lvl
	public function __construct($method = 'post', $action = '', $legend = null, $stacked = true, $aligned = true) {

		$class = "pure-form";
		if ($stacked) {
			$class .= " pure-form-stacked";
		}
		if ($aligned) {
			$class .= " pure-form-aligned";	
		}

		$this->form = "<form method='$method' action='$action' class='$class'><fieldset>";
		if (isset($legend)) {
			$this->form .= "<legend>$legend</legend>";
		}
	}

	public function input($name, $label = null, $type = 'text') {
		$label = $this->label_text($name, $label);

		$tmp = "<div class='pure-control-group'>";
		$tmp .= "<label for='$name'>$label</label>";
		$tmp .= "<input type='$type' name='$name' id='$name' placeholder='$label'/>";
		$tmp .= "</div>";

		$this->add_to_form($tmp);
	}

	public function checkbox($name, $label = null, $type = 'text') {
		$label = $this->label_text($name, $label);

		$tmp = "<div class='pure-controls'>";
		$tmp .= "<label for='$name' class='pure-checkbox'>";
		$tmp .= "<input type='checkbox' name='$name' id='$name'/>$label</label>";
		$tmp .= "</div>";

		$this->add_to_form($tmp);
	}

	public function input_password($name, $label = null) {
		$this->input($name, $label, 'password');
	}

	public function button($label = 'Submit', $type = 'submit') {
		$tmp = "<div class='pure-controls'>";
		$tmp .= "<button type='$type' name=submit class='pure-button pure-button-primary' value='$label'>$label</button></div>";

		$this->add_to_form($tmp);
	}

	public function generate($submit_button = true) {
		if ($submit_button) {
			$this->button();
		}

		$this->form .= "</fieldset></form>";
		return $this->form;
	}

	private function add_to_form($string) {
		$this->form .= $string;
	}

	private function label_text($name, $label) {
		if (!isset($label)) {
			return ucwords(str_replace('_',' ',$name));
		}
		return $label;
	}

}
 ?>