<?php namespace JATSParser\Body;

class Equation extends AbstractElement {

	private $content = null;
	private $attrib;

	public function innerHTML($node) {
		return implode(array_map([$node->ownerDocument,"saveHTML"], 
								 iterator_to_array($node->childNodes)));
	}

	public function __construct(\DOMElement $element) {
		parent::__construct($element);
		$this->xpath->query("display-formula", $element);
		$math = "<div>".str_replace("mml:","",$this->innerHTML($element))."</div>";
		$math = "<div>".str_replace("mml-eqn-","eqn-",$this->innerHTML($element))."</div>";
		$this->content = $math;
		$this->attrib = $this->extractFormattedText(".//id", $element);
	}

	public function getContent(): string {
		return $this->content;
	}

	public function getAttrib(): array {
		return $this->attrib;
	}
}
