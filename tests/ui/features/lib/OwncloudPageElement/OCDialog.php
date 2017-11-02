<?php

/**
 * ownCloud
 *
 * @author Artur Neumann <artur@jankaritech.com>
 * @copyright 2017 Artur Neumann artur@jankaritech.com
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License,
 * as published by the Free Software Foundation;
 * either version 3 of the License, or any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>
 *
 */

namespace Page\OwncloudPageElement;

use Behat\Mink\Element\NodeElement;
use Page\OwncloudPage;
use Behat\Mink\Session;
use SensioLabs\Behat\PageObjectExtension\PageObject\Exception\ElementNotFoundException;

/**
 * The oc-dialog
 *
 */
class OCDialog extends OwncloudPage {

	/**
	 * @var NodeElement of this element
	 */
	protected $dialogElement;
	protected $titleClassXpath = ".//*[@class='oc-dialog-title']";
	protected $contentClassXpath = ".//*[@class='oc-dialog-content']";
	/**
	 * the accept button, regardless of the label
	 * 
	 * @var string
	 */
	protected $primaryButtonXpath = "//button[@class='primary']";

	/**
	 * sets the NodeElement for the current file row
	 * a little bit like __construct() but as we access this "sub-page-object"
	 * from an other Page Object by $this->getPage("OwncloudPageElement\\OCDialog")
	 * there is no real __construct() that can take arguments
	 *
	 * @param \Behat\Mink\Element\NodeElement $dialogElement
	 * @return void
	 */
	public function setElement(NodeElement $dialogElement) {
		$this->dialogElement = $dialogElement;
	}

	/**
	 * 
	 * @throws ElementNotFoundException
	 * @return string
	 */
	public function getTitle() {
		$title = $this->dialogElement->find("xpath", $this->titleClassXpath);
		if (is_null($title)) {
			throw new ElementNotFoundException(
				__METHOD__ .
				" xpath $this->titleClassXpath " .
				"could not find title"
			);
		}
		return $title->getText();
	}

	/**
	 * 
	 * @throws ElementNotFoundException
	 * @return string
	 */
	public function getMessage() {
		$contentElement = $this->dialogElement->find("xpath", $this->contentClassXpath);
		if (is_null($contentElement)) {
			throw new ElementNotFoundException(
				__METHOD__ .
				" xpath $this->contentClassXpath " .
				"could not find content element"
			);
		}
		return $contentElement->getText();
	}

	/**
	 * clicks the accept (primary) button
	 * 
	 * @param Session $session
	 * @throws ElementNotFoundException
	 * @return void
	 */
	public function accept(Session $session) {
		$primaryButton = $this->dialogElement->find(
			"xpath", $this->primaryButtonXpath
		);
		if (is_null($primaryButton)) {
			throw new ElementNotFoundException(
				__METHOD__ .
				" xpath $this->primaryButtonXpath " .
				"could not find primary button"
			);
		}
		$primaryButton->click();
		$this->waitForOutstandingAjaxCalls($session);
	}
}
	