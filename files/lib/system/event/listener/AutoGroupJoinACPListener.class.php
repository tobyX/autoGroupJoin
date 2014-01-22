<?php
namespace wcf\system\event\listener;
use wcf\system\event\IEventListener;
use wcf\system\WCF;
use wcf\system\exception\UserInputException;


/**
 * Provides ACP integration
 *
 * @author	Tobias Friebel <woltlab@tobyf.de>
 * @copyright	2014 Tobias Friebel
 * @license	Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International <http://creativecommons.org/licenses/by-nc-nd/4.0/deed.en>
 * @package	com.toby.wcf.autogroupjoin
 */
class AutoGroupJoinACPListener implements IEventListener
{
	public $autoGroupJoinDays = null;
	public $autoGroupJoinActivityPoints = null;

	private $isSave = false;

	/**
	 * @see EventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName)
	{
		switch ($eventName)
		{
			case 'readFormParameters':
				if (isset($_POST['autoGroupJoinDays']) && trim($_POST['autoGroupJoinDays']) != "") $this->autoGroupJoinDays = intval($_POST['autoGroupJoinDays']);
				if (isset($_POST['autoGroupJoinActivityPoints']) && trim($_POST['autoGroupJoinActivityPoints']) != "") $this->autoGroupJoinActivityPoints = intval($_POST['autoGroupJoinActivityPoints']);
			break;

			case 'validate':
				if (!is_null($this->autoGroupJoinDays))
				{
					if ($this->autoGroupJoinDays == 0)
						throw new UserInputException('autoGroupJoinDays', 'notValid');

					if ($this->autoGroupJoinDays < 0)
						throw new UserInputException('autoGroupJoinDays', 'tooLow');
				}

				if (!is_null($this->autoGroupJoinActivityPoints))
				{
					if ($this->autoGroupJoinActivityPoints == 0)
						throw new UserInputException('autoGroupJoinActivityPoints', 'notValid');

					if ($this->autoGroupJoinActivityPoints < 0)
						throw new UserInputException('autoGroupJoinActivityPoints', 'tooLow');
				}
			break;

			case 'save':
				$eventObj->additionalFields['autoGroupJoinDays'] = $this->autoGroupJoinDays;
				$eventObj->additionalFields['autoGroupJoinActivityPoints'] = $this->autoGroupJoinActivityPoints;
				$this->isSave = true;
			break;

			case 'assignVariables':
				if (isset($eventObj->group) && is_object($eventObj->group) && !$this->isSave)
				{
					WCF::getTPL()->assign(array(
						'autoGroupJoinDays' => $eventObj->group->autoGroupJoinDays,
						'autoGroupJoinActivityPoints' => $eventObj->group->autoGroupJoinActivityPoints,
					));
				}
				else
				{
					WCF::getTPL()->assign(array(
						'autoGroupJoinDays' => $this->autoGroupJoinDays,
						'autoGroupJoinActivityPoints' => $this->autoGroupJoinActivityPoints,
					));
				}
			break;
		}
	}
}
