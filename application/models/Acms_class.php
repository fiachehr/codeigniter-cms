<?php
class Acms_class extends MY_Model
{

	/*
|--------------------------------------------------------------------------
| .:Class Constractor:.
|--------------------------------------------------------------------------
*/

	function __construct()
	{
		parent::__construct();
	}

	/*
|--------------------------------------------------------------------------
| .:Login To Control Panel:.
|--------------------------------------------------------------------------
*/

	function login($username, $password)
	{

		$this->load->helper('security');
		$this->load->helper('str');
		$this->load->helper('pdate');

		$message = "نام کاربری یا کلمه عبور اشتباه است";
		$permission = array();
		$dateFlag = "TRUE";

		$this->table = "tbl_admin";
		$this->selectConditions = array(
			"join" => array(
				array("table" => "tbl_user_group", "joinCondition" => "tbl_user_group.id = tbl_admin.adminUserGroupID", "joinType" => "LEFT OUTER"),
				array("table" => "tbl_schedule", "joinCondition" => "tbl_schedule.scheduleSrcID = tbl_admin.adminUserGUID", "joinType" => "LEFT OUTER"),
				array("table" => "tbl_group_role", "joinCondition" => "tbl_user_group.id = tbl_group_role.roleGroupID", "joinType" => "LEFT OUTER")
			),
			"where" => "adminUserEmail = '" . $username . "' AND adminUserPassword = '" . passwordEncode($password) . "'",
		);

		$queryResult = $this->getData();

		if (count($queryResult) != 0) {

			if ($queryResult[0]['adminLastVisit'] == NULL && $queryResult[0]['adminUserStatus'] == "0") {

				$userData = array('userName' =>	$queryResult[0]['adminUserFName'] . " " . $queryResult[0]['adminUserLName'], 'userGUID' => $queryResult[0]['adminUserGUID'], 'userEmail' => $queryResult[0]['adminUserEmail'], 'userStatus' => $queryResult[0]['adminUserStatus']);
				$this->session->set_userdata($userData);
				redirect(base_url() . "Acms/changePassword", "refresh");
			} else {

				if ($queryResult[0]['adminUserStatus'] == "a") {

					$userData = array(
						'userGUID'		 =>	$queryResult[0]['adminUserGUID'],
						'userStatus'	 =>	$queryResult[0]['adminUserStatus'],
						'userEmail'		 =>	$queryResult[0]['adminUserEmail'],
						'userName'		 =>	$queryResult[0]['adminUserFName'] . " " . $queryResult[0]['adminUserLName'],
						'userAvatar'	 => $queryResult[0]['adminUserAvatar'],
						'userAccessData' => "1",
						'userGroupParent' => 0,
						'panelLanguage'	 => "ir"
					);

					$this->session->set_userdata($userData);
					$data = array("adminLastVisit" => date("Y-m-d H:i:s"));
					$this->db->where("adminUserGUID", $this->session->userdata('userGUID'));
					$this->db->update("tbl_admin", $data);
					$this->setCostumUserLog(" ورورد به کنترل پنل ");
					redirect(base_url() . "Acms/desktop", "refresh");
				} else {

					if ($queryResult[0]['adminUserStatus'] != "1") {
						$message = "شما مجوز ورود به کنترل پنل را ندارید";
					} else {

						if (date("Hi") < str_replace(":", "", $queryResult[0]['userGroupStartTime']) || date("Hi") > str_replace(":", "", $queryResult[0]['userGroupEndTime'])) {

							$message = "شما در این زمان مجاز به ورود نمی باشید";
						} else {

							$weekday = explode("-", $queryResult[0]['userGroupWeekday']);
							if (!in_array(substr(strtolower(date("D")), 0, 2), $weekday)) {

								$message = "شما در این روز از هفته مجاز به ورود نمی باشید";
							} else {

								if ($queryResult[0]['scheduleStart'] != "" && $queryResult[0]['scheduleEnd'] != "") {

									$start = compareDate(date("Y-m-d"), $queryResult[0]['scheduleStart']);
									$end = compareDate(date("Y-m-d"), $queryResult[0]['scheduleEnd']);

									if ((int)$start['day'] > 0 || (int)$end['day'] < 0) {

										$message = "مدت زمان مجاز استفاده شما از کنترل پنل به پایان رسیده است";
										$dateFlag = "FALSE";
									}
								}

								if ($dateFlag == "TRUE") {

									foreach ($queryResult as $rows) {

										$permission[$rows['moduleID']] = $rows['roleStatus'];
									}

									$userData = array(
										'userGUID'		 =>	$queryResult[0]['adminUserGUID'],
										'userStart'		 =>	$queryResult[0]['userGroupStartTime'],
										'userEnd'		 =>	$queryResult[0]['userGroupEndTime'],
										'userGroupID'	 => $queryResult[0]['adminUserGroupID'],
										'userGroupParent' => $queryResult[0]['parentID'],
										'userWeekday'	 =>	$queryResult[0]['userGroupWeekday'],
										'userStartDate'	 =>	$queryResult[0]['scheduleStart'],
										'userEndDate'	 =>	$queryResult[0]['scheduleEnd'],
										'userGUID'		 =>	$queryResult[0]['adminUserGUID'],
										'userEmail'		 =>	$queryResult[0]['adminUserEmail'],
										'userName'		 =>	$queryResult[0]['adminUserFName'] . " " . $queryResult[0]['adminUserLName'],
										'userAvatar'	 => $queryResult[0]['adminUserAvatar'],
										'userAccessData' => $queryResult[0]['userGroupDataAccess'],
										'userPermission' => $permission,
										'panelLanguage'	 => "ir"
									);
									$this->session->set_userdata($userData);

									$data = array("adminLastVisit" => date("Y-m-d H:i:s"));
									$this->table = "tbl_admin";
									$this->primeryKey = "adminUserGUID";
									$this->update($data, $this->session->userdata('userGUID'));
									$this->setCostumUserLog(" ورورد به کنترل پنل ");
									redirect(base_url() . "Acms/desktop", "refresh");
								}
							}
						}
					}
				}
			}
		}

		return $message;
	}

	/*
|--------------------------------------------------------------------------
| .:Get Module List:.
|--------------------------------------------------------------------------
*/

	function getModuleList($parent)
	{

		$this->table = "tbl_module";
		$this->selectConditions = array("where" => "moduleParentID = '" . $parent . "'");
		return $this->getData();
	}

	/*
|--------------------------------------------------------------------------
| .:Change Module Status:.
|--------------------------------------------------------------------------
*/

	function changeModuleStatus($id, $status, $parent)
	{

		if ($parent == "0") {

			$data['moduleStatus'] = $status;
			$this->db->where("moduleID", $id);
			$this->db->or_where("moduleParentID", $id);
			$this->db->update("tbl_module", $data);
		} else {

			$data['moduleStatus'] = $status;
			$this->table = "tbl_module";
			$this->primeryKey = "moduleID";
			$this->updatedAt = false;
			$this->update($data, $id);
		}
	}

	/*
|--------------------------------------------------------------------------
| .:Get Active Module:. 
|--------------------------------------------------------------------------
*/
	function getModules()
	{

		$this->table = "tbl_module";
		$this->selectConditions = array("where" => "moduleStatus = '1'", "order" => "moduleID DESC");
		return $this->getData();
	}

	/*
|--------------------------------------------------------------------------
| .:Get Active Module:. 
|--------------------------------------------------------------------------
*/
	function changeSuperAdminPassword($pass)
	{

		$updateData['adminUserPassword'] = $pass;
		$this->table = "tbl_admin";
		$this->primeryKey = "adminUserEmail";
		$this->update($updateData, "admin@ago.ir");
	}

	/*
|--------------------------------------------------------------------------
| Check User Module Permission
|--------------------------------------------------------------------------
*/

	function checkPermission($method = NULL)
	{

		$modules = array(
			"userGroupList" => "27", "insertUserGroup" => "27", "editUserGroup" => "27", "deleteUserGroup" => "27",
			"userList" => "73", "insertUser" => "73", "editUser" => "73", "changeAdminUserPassword" => "73", "deleteUser" => "73", "userLog" => "40",
			"siteUserList" => "69", "insertSiteUser" => "69", "editSiteUser" => "69", "changeUserPassword" => "69", "deleteSiteUser" => "69", "userContact" => "69",
			"pageAndCatList" => "71", "selectCatAct" => "71", "getCatData" => "71", "insertCategory" => "71", "getModuleCategory" => "71", "editCategory" => "71",
			"deleteCategory" => "71", "pageContent" => "71", "addLink" => "71", "addAttachment" => "71", "categoryIndex" => "71",
			"newsList" => "58", "insertNews" => "58", "editNews" => "58", "deleteNews" => "58", "deleteNewsAjax" => "58",
			"newsSMList" => "94", "insertNewsSM" => "94", "editNewsSM" => "94", "deleteNewsSM" => "94", "deleteNewsSMAjax" => "94",
			"productSMList" => "90", "insertProductSM" => "90", "editProductSM" => "90", "deleteProductSM" => "90", "deleteProductSMAjax" => "90",
			"productSMCList" => "96", "insertProductSMC" => "96", "editProductSMC" => "96", "deleteProductSMC" => "96", "deleteProductSMCAjax" => "96",
			"insertUserSM" => "92", "siteUserSMList" => "92", "changeUserSMPassword" => "92", "editUserSM" => "92", "deleteUserSM" => "92", "deleteUserSMAjax" => "92",
			"deleteHomepageItemAjax" => "98", "deleteHomepageItem" => "98", "insertHomepageItem" => "98", "homepageItemList" => "98", "editHomepageItem" => "98",
			"sliderList" => "99", "insertSlider" => "99", "editSlider" => "99", "deleteSlider" => "99", "deleteSliderAjax" => "99",
			"contactList" => "100", "insertContact" => "100", "editContact" => "100", "deleteContact" => "100", "deleteContactAjax" => "100",
			"productList" => "102", "insertProduct" => "102", "editProduct" => "102", "deleteProduct" => "102", "deleteProductAjax" => "102",
			"giftCardList" => "20", "insertGiftCard" => "20", "deleteGiftCard" => "20", "deleteGiftCardAjax" => "20", "factorDesc" => "20",
			"insertFactorFinancial" => "20", "factorFinancialList" => "20", "editFactorFinancial" => "20",
			"factorList" => "20", "viewFactor" => "20", "deleteFactor" => "20", "insertLottery" => "20", "lotteryList" => "20", "lotteryChanceList" => "20", "runLottery" => "20", "deleteLottery" => "20",
			"deliveryFee" => "20",
			"linkList" => "13", "insertLink" => "13", "editLink" => "13", "deleteLinkAjax" => "13", "deleteLink" => "13",
			"boardList" => "104", "insertBoard" => "104", "editBoard" => "104", "deleteBoardAjax" => "104", "deleteBoard" => "104"
		);

		$moduleID = NULL;

		if ($method != NULL) {
			$moduleID = $modules[$method];
		}

		$this->load->helper('pdate');

		if ($this->session->userdata("userName") == NULL) {

			redirect(base_url() . "Acms/index", "refresh");
		}

		if ($this->session->userdata("userStatus") != "a") {


			if (date("Hi") < str_replace(":", "", $this->session->userdata("userStart")) || date("Hi") > str_replace(":", "", $this->session->userdata("userEnd"))) {

				echo "<script>alert('شما در این زمان مجاز به استفاده از کنترل پنل نمی باشید')</script>";
				redirect(base_url() . "Acms/index", "refresh");
			}

			$weekday = explode("-", $this->session->userdata("userWeekday"));
			if (!in_array(substr(strtolower(date("D")), 0, 2), $weekday) && $this->session->userdata("userStatus") != "a") {

				$message = "<script>alert('شما در این روز از هفته مجاز به استفاده از کنترل پنل نمی باشید')</script>";
				redirect(base_url() . "Acms/index", "refresh");
			}

			if ($this->session->userdata("userStartDate") != "" && $this->session->userdata("userEndDate") != "") {

				$start = compareDate(date("Y-m-d"), $this->session->userdata("userStartDate"));
				$end = compareDate(date("Y-m-d"), $this->session->userdata("userEndDate"));

				if ((int)$start['day'] > 0 || (int)$end['day'] < 0) {

					echo "<script>alert('مدت زمان مجاز استفاده شما از کنترل پنل به پایان رسیده است')</script>";
					redirect(base_url() . "Acms/index", "refresh");
				}
			}

			if ($moduleID != NULL) {

				if (!isset($this->session->userdata("userPermission")[$moduleID]) || $this->session->userdata("userPermission")[$moduleID] == "0") {

					echo "<script>alert('شما مجوز دسترسی به این بخش را ندارید')</script>";
					redirect(base_url() . "Acms/desktop", "refresh");
				} else {

					return (string)$this->session->userdata("userPermission")[$moduleID];
				}
			}
		} else {
			return "a";
		}
	}

	/*
|--------------------------------------------------------------------------
| .:Get Language List:.
|--------------------------------------------------------------------------
*/

	function getLanguageList()
	{

		$this->table = "tbl_language";
		return $this->getData();
	}

	/*
|--------------------------------------------------------------------------
| .:Change Language Status:.
|--------------------------------------------------------------------------
*/

	function changeLanguageStatus($id, $status)
	{

		$data = array("languageStatus" => $status);
		$this->updatedAt = false;
		$this->table = "tbl_language";
		$this->primeryKey = "languageID";
		$this->update($data, $id);
	}

	/*
|--------------------------------------------------------------------------
| .:Control Panel Language:.
|--------------------------------------------------------------------------
*/

	function siteLanguage()
	{

		$this->table = "tbl_language";
		$this->selectConditions = array("where" => "languageStatus = '1' AND languageIcon != '" . $this->session->userdata('panelLanguage') . "'");
		return $this->getData();
	}

	/*
|--------------------------------------------------------------------------
| .:Control Panel Language:.
|--------------------------------------------------------------------------
*/

	function getUserGroupList()
	{

		$this->table = "tbl_user_group";
		return $this->getData();
	}

	/*
|--------------------------------------------------------------------------
|  .:User Group Data Action:.
|--------------------------------------------------------------------------
*/

	function userGroupActionData($values, $id = NULL, $lastTitle = NULL)
	{

		$data = array();
		$roles = array();
		$singleRole = array();
		$result = array();
		$table = "tbl_user_group";
		$values['userGroupWeekday'] = implode("-", $values['userGroupWeekday']);
		$values['userGroupStartTime'] = date("H:i", strtotime($values['userGroupStartTime']));
		$values['userGroupEndTime'] = date("H:i", strtotime($values['userGroupEndTime']));

		if ($id == NULL) {
			$singleRole['roleGroupID'] = $values['id'] = date("ymdhis");
		} else {
			$singleRole['roleGroupID'] = $values['id'] = $id;
		}

		$roleArray = explode("-", substr($values['moduleLabels'], 0, -1));

		for ($i = 0; $i <= count($roleArray) - 1; $i++) {
			$moduleRole = explode("-", $values[$roleArray[$i]]);
			$singleRole['moduleID'] = $moduleRole[0];
			$singleRole['roleStatus'] = $moduleRole[1];
			array_push($roles, $singleRole);
			unset($values[$roleArray[$i]]);
		}

		unset($values['moduleLabels']);
		unset($values['submit']);

		if ($id == NULL) {

			$this->db->trans_start();
			$this->table = "tbl_user_group";
			$this->insert($values, $values['title']);
			$this->table = "tbl_group_role";
			$this->createdAt = false;
			$this->insert($roles);
			$this->db->trans_complete();
			return true;
		} else {

			if ($values['parentID'] != $id) {

				$this->db->trans_start();
				$this->table = "tbl_user_group";
				$this->primeryKey = "id";
				$this->update($values, $id, $lastTitle);
				$this->db->flush_cache();
				$this->table = "tbl_group_role";
				$this->primeryKey = "roleGroupID";
				$this->delete($id);
				$this->createdAt = false;
				$this->insert($roles);
				$this->db->trans_complete();
				return true;
			}
		}
	}

	/*
|--------------------------------------------------------------------------
| Get User Group Information
|--------------------------------------------------------------------------
*/

	function getUserGroup($id)
	{

		$this->table = "tbl_user_group";
		$this->selectConditions = array("where" => "id = '" . $id . "'");
		return $this->getData();
	}

	/*
|--------------------------------------------------------------------------
| .:Module List For User Group Editation:.
|--------------------------------------------------------------------------
*/

	function moduleListForGroupRoles($id)
	{

		$this->table = "tbl_module";
		$this->selectConditions = array(
			"select" => "*,tbl_module.moduleID as mainModuleID",
			"join" => array(array("table" => "tbl_group_role", "joinCondition" => "tbl_group_role.moduleID = tbl_module.moduleID", "joinType" => "LEFT OUTER")),
			"where" => "roleGroupID = '" . $id . "' OR (moduleStatus = '1' AND moduleParentID = '0')"
		);
		return $this->getData();
	}

	/*
|--------------------------------------------------------------------------
| .:Get Admin User List:.
|--------------------------------------------------------------------------
*/

	function getAdminUserList($limit, $segments, $page, $url)
	{

		$query = "SELECT * FROM tbl_admin 
				  INNER JOIN tbl_user_group ON adminUserGroupID = tbl_user_group.id
				  WHERE adminUserStatus != 'a'
				  GROUP BY tbl_admin.adminUserGUID
			      ORDER BY tbl_admin.created_at DESC";
		return $this->paginate($limit, $segments, $page, $query, $url, "panel");
	}

	/*
|--------------------------------------------------------------------------
| .:Get User Group Title:.
|--------------------------------------------------------------------------
*/

	function getUserGroupTitle($id)
	{
		$this->table = "tbl_user_group";
		$this->selectConditions = array(
			"select" => "title,id",
			"where" => "id = '" . $id . "'",
			"resultType" => "1"
		);
		$result = $this->getData();
		return $arrayResult = array($result['id'], $result['title']);
	}

	/*
|--------------------------------------------------------------------------
|  .:Admin User Data Action:.
|--------------------------------------------------------------------------
*/

	function adminUserAction($values, $id = null, $lastTitle = null)
	{

		$this->load->helper("str");
		$schedule = false;
		if ($id == null) {
			$values['adminUserGUID'] = guid();
		} else {
			$values['adminUserGUID'] = $id;
		}
		unset($values['submit']);
		if ($values['scheduleStart'] != "") {
			$this->load->helper('pdate');
			$scheduleData['scheduleModuleID'] = 26;
			$scheduleData['scheduleSrcID'] = $values['adminUserGUID'];
			$scheduleData['scheduleStart'] = jalToGre($values['scheduleStart']);
			$scheduleData['scheduleEnd'] = jalToGre($values['scheduleEnd']);
			$schedule = true;
		}
		unset($values['scheduleEnd']);
		unset($values['scheduleStart']);

		if ($id == null) {
			$values['adminUserStatus'] = "0";
			$values['adminUserPassword'] = passwordEncode($values['adminUserEmail']);
			$values['adminLastVisit'] = null;
			$this->db->trans_start();
			$this->table = "tbl_admin";
			$this->insert($values, $values['adminUserFName'] . " " . $values['adminUserLName']);
			if ($schedule == true) {
				$this->table = "tbl_schedule";
				$this->createdAt = false;
				$this->insert($scheduleData);
			}
			$this->db->trans_complete();
			return true;
		} else {

			$this->db->trans_start();
			$this->table = "tbl_admin";
			$this->primeryKey = "adminUserGUID";
			$this->update($values, $id, $lastTitle);
			$this->db->flush_cache();
			$this->table = "tbl_schedule";
			$this->primeryKey = "scheduleSrcID";
			$this->delete($id);
			if ($schedule == true) {
				$this->table = "tbl_schedule";
				$this->createdAt = false;
				$this->insert($scheduleData);
			}
			$this->db->trans_complete();
			return true;
		}
	}

	/*
|--------------------------------------------------------------------------
| .:Get User Information:.
|--------------------------------------------------------------------------
*/

	function getUserInfo($id)
	{

		$this->table = "tbl_admin";
		$this->selectConditions = array(
			"join" => array(
				array("table" => "tbl_schedule", "joinCondition" => "tbl_schedule.scheduleSrcID = tbl_admin.adminUserGUID", "joinType" => "LEFT OUTER"),
				array("table" => "tbl_user_group", "joinCondition" => "tbl_user_group.id = tbl_admin.adminUserGroupID", "joinType" => "LEFT OUTER")
			),
			"where" => "adminUserGUID = '" . $id . "'",
			"resultType" => "1"
		);
		return $this->getData();
	}

	/*
|--------------------------------------------------------------------------
| .:Change First Login Password:.
|--------------------------------------------------------------------------
*/

	function changePass($password, $retry, $id = NULL, $name = NULL)
	{

		$this->load->helper('security');
		$this->load->helper('str');
		if ($id == NULL) {

			$data = array("adminUserPassword" => passwordEncode($password), "adminUserStatus" => "1", "adminLastVisit" => date("Y-m-d H:i:s"));
			$this->table = "tbl_admin";
			$this->primeryKey = "adminUserGUID";
			$this->update($data, $this->session->userdata('userGUID'));
			$this->setCostumUserLog(" اولین ورود و تغییر رمز" . $this->session->userdata('userName'));
		} else {

			$data = array("adminUserPassword" => passwordEncode($password));
			$this->table = "tbl_admin";
			$this->primeryKey = "adminUserGUID";
			$this->update($data, $id);
			$this->setCostumUserLog(" تغییر رمز ورود " . $name);
		}
	}


	/*
|--------------------------------------------------------------------------
| .:Check Access Permission:.
|--------------------------------------------------------------------------
*/

	function checkAccess($permission)
	{

		$userAccess = false;
		$access = array("a", "2", "3");
		if (in_array($permission, $access)) {
			$userAccess = true;
		}
		return $userAccess;
	}

	/*
|--------------------------------------------------------------------------
| .:Delete User Group:.
|--------------------------------------------------------------------------
*/

	function deleteUserGroup($id, $title)
	{

		$this->table = "tbl_user_group";
		$this->selectConditions = array("where" => "parentID = '" . $id . "'", "resultType" => "1");
		$result = $this->getData();
		if (count($result) == 0) {
			$this->table = "tbl_user_group";
			$this->primeryKey = "id";
			$this->delete($id, str_replace("-", " ", $title));
			return "اطلاعات مورد نظر حذف گردید";
		} else {
			return "این گروه دارای زیر گروه می باشد و شما نمی توانید آنرا حذف نمایید";
		}
	}

	/*
|--------------------------------------------------------------------------
| .:Delete User :.
|--------------------------------------------------------------------------
*/

	function deleteUser($id, $title)
	{

		$this->table = "tbl_admin";
		$this->primeryKey = "adminUserGUID";
		$this->delete($id, str_replace("-", " ", $title));
	}

	/*
|--------------------------------------------------------------------------
| .:User Log :.
|--------------------------------------------------------------------------
*/

	function getUserLog($limit, $segments, $page, $url)
	{

		if ($this->session->userdata("userStatus") == "a") {
			$query = "SELECT * FROM tbl_user_log LEFT OUTER JOIN tbl_admin ON tbl_user_log.logUserID = tbl_admin.adminUserGUID ORDER BY logDate DESC";
		} else {
			$this->load->helper("tree");
			$condition = "";

			$this->table = "tbl_user_group";
			$this->selectConditions = array("select" => "id,parentID");
			$userGroup = $this->getData();
			$children = array();
			getChildNodes(createIndexArray($userGroup), $this->session->userdata("userGroupParent"), $children);

			$countArray = count($children);

			if ($countArray == 0) {
				$query = "SELECT * FROM tbl_user_log LEFT OUTER JOIN tbl_admin ON tbl_user_log.logUserID = tbl_admin.adminUserGUID ORDER BY logDate DESC";
			} else {
				for ($i = 0; $i <= $countArray - 1; $i++) {
					if ($i == 0) {
						$condition .= " adminUserGroupID = '" . $children[$i] . "'";
					} else {
						$condition .= " OR adminUserGroupID = '" . $children[$i] . "'";
					}
				}
				$query = "SELECT * FROM tbl_user_log LEFT OUTER JOIN tbl_admin ON tbl_user_log.logUserID = tbl_admin.adminUserGUID WHERE " . $condition . " ORDER BY logDate DESC";
			}
		}
		return $this->paginate($limit, $segments, $page, $query, $url, "panel");
	}
}
