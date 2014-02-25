<?php

namespace wcf\system\cronjob;

use wcf\data\user\UserEditor;
use wcf\data\user\UserList;
use wcf\data\user\UserAction;
use wcf\data\cronjob\Cronjob;
use wcf\data\user\group\UserGroupList;


/**
 * Provides ACP integration
 *
 * @author	Tobias Friebel <woltlab@tobyf.de>, inspired by Christopher Walz
 * @copyright	2014 Tobias Friebel
 * @license	Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International <http://creativecommons.org/licenses/by-nc-nd/4.0/deed.en>
 * @package	com.toby.wcf.autogroupjoin
 */
class AutoGroupJoinCronjob extends AbstractCronjob
{
	/**
	 *
	 * @see \wcf\system\ICronjob::execute()
	 */
	public function execute(Cronjob $cronjob)
	{
		parent :: execute($cronjob);

		$objectList = new UserGroupList();
		$objectList->getConditionBuilder()->add('autoGroupJoinDays IS NOT NULL AND autoGroupJoinDays <> 0 OR autoGroupJoinActivityPoints IS NOT NULL AND autoGroupJoinActivityPoints <> 0');
		$objectList->readObjects();

		if (count($objectList))
		{
			foreach ($objectList->getObjects() as $group)
				$this->addUsersToGroup($group);
		}
	}

	/**
	 * add missing users to given group
	 *
	 * @param UserGroup $group
	 */
	public function addUsersToGroup($group)
	{
		$objectList = new UserList();
		$objectList->getConditionBuilder()->add("NOT EXISTS (
								SELECT groupID
								FROM wcf" . WCF_N . "_user_to_group
								WHERE user_table.userID = userID AND groupID = ?
							)", array ($group->groupID)
		);

		if ($group->autoGroupJoinDays)
		{
			$objectList->getConditionBuilder()->add("registrationDate <= ?",
							array(TIME_NOW - ($group->autoGroupJoinDays * 86400)));
		}

		if ($group->autoGroupJoinActivityPoints)
		{
			$objectList->getConditionBuilder()->add("activityPoints >= ?",
							array($group->autoGroupJoinActivityPoints));
		}

		$objectList->readObjects();

		if (count($objectList))
		{
			$users = array();
			foreach ($objectList->getObjects() as $user)
			{
				$users[] = new UserEditor($user);
			}

			$action = new UserAction($users,
					'addToGroups',
					array (
						'groups' => array (
							$group->groupID
						),
						'addDefaultGroups' => false,
						'deleteOldGroups' => false
					));
			$action->executeAction();
		}
	}
}