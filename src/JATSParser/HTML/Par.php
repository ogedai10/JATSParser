<?php namespace JATSParser\HTML;

use JATSParser\Body\InlineEquation;
use JATSParser\HTML\InlineEquation as HTMLInlineEquation;
use JATSParser\Body\Par as JATSPar;
use JATSParser\Body\Text as JATSText;
use JATSParser\HTML\Text as HTMLText;

class Par extends \DOMElement {

	function __construct($nodeName = null) {
		$nodeName === null ? parent::__construct("p") : parent::__construct($nodeName);
	}

	public function setContent(JATSPar $jatsPar) {
		foreach ($jatsPar->getContent() as $jatsText) {
			if ($jatsText instanceof InlineEquation) {
				$InlineequationGroup = new HTMLInlineEquation();
				$this->appendChild($InlineequationGroup);
				$InlineequationGroup->setContent($jatsText);
			} else {
				HTMLText::extractText($jatsText, $this);
			}
		}
		
	}
}
