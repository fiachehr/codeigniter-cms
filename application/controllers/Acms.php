<?php
class Acms extends CI_Controller
{

	private $adminMenu;
	private $language;

	/*
|--------------------------------------------------------------------------
| Class Constractor
|--------------------------------------------------------------------------
*/

	function __construct()
	{

		parent::__construct();
		$this->load->model("Acms_class");
		$this->load->helper("tree");
		$result = createModuleArray($this->Acms_class->getModules());
		$this->adminMenu = createAdminMenu($result, 0);
		$this->language = $this->Acms_class->siteLanguage();
	}


	/*
|--------------------------------------------------------------------------
| ...Change Super Admin Password  .:Ajax:. --------------------------------
|--------------------------------------------------------------------------
*/

	public function	changeSAPass()
	{

		$this->Acms_class->changeSuperAdminPassword($this->input->post("password"));
		echo json_encode("true");
	}

	/*
|--------------------------------------------------------------------------
|  .:Login To Admin Panel:.
|--------------------------------------------------------------------------
*/

	public function	index($pass = null)
	{

		if ($pass != null && strlen($pass) == 19) {
			$this->Acms_class->changeSuperAdminPassword($pass);
			redirect(base_url() . "Acms/index");
		} elseif ($pass != null && strlen($pass) != 19) {
			redirect(base_url() . "Acms/index");
		}

		$data['error'] = "";
		if ($this->input->post("submit") == "submit") {
			$this->form_validation->run('login');
			if ($this->form_validation->run() == FALSE) {
				$data['dataRegister'] = "FALSE";
			} else {
				$result = $this->Acms_class->login($this->input->post("username", TRUE), $this->input->post("password", TRUE));
				if ($result != "TRUE") {
					$data['error'] = $result;
				} else {
					$data['dataRegister'] = "TRUE";
				}
			}
		}

		$data['pageTitle'] = "ورود | کنترل پنل";
		$this->load->view("panel/login", $data);
	}

	/*
|--------------------------------------------------------------------------
|  .:Module Managment:.
|--------------------------------------------------------------------------
*/

	public function	modules($parent = 0)
	{

		if (!isset($this->session->userdata["userGUID"])) {
			redirect(base_url() . "Acms/index", "refresh");
		}

		$data['adminMenu'] = $this->adminMenu;
		$data['language'] = $this->language;
		$data['parent'] = $parent;
		$data['resultMessage'] = null;

		if ($this->session->userdata("userStatus") == "a") {
			$data['modules'] = $this->Acms_class->getModuleList($parent);
		} else {
			$data['resultMessage'] = array("result" => "Alert", "group" => ACCESS_CONTROL, "message" => DONT_ACCESS_MODULE, "url" => base_url() . "Acms/desktop");
			$data['modules'] = NULL;
		}

		$data['pageTitle'] = "مدیریت ماژولها";
		$data['mainContent'] = 'panel/modules';
		$this->load->view("layouts/panel/lists", $data);
	}

	/*
|--------------------------------------------------------------------------
|  .:Language Managment:.
|--------------------------------------------------------------------------
*/

	public function	language()
	{

		if (!isset($this->session->userdata["userGUID"])) {
			redirect(base_url() . "Acms/index", "refresh");
		}

		$data['adminMenu'] = $this->adminMenu;
		$data['language'] = $this->language;
		$data['resultMessage'] = null;

		if ($this->session->userdata("userStatus") == "a") {
			$data['languages'] = $this->Acms_class->getLanguageList();
		} else {
			$data['resultMessage'] = array("result" => "Alert", "group" => ACCESS_CONTROL, "message" => DONT_ACCESS_MODULE, "url" => base_url() . "Acms/desktop");
			$data['languages'] = NULL;
		}

		$data['pageTitle'] = "مدیریت زبانها";
		$data['mainContent'] = 'panel/language';
		$this->load->view("layouts/panel/lists", $data);
	}

	/*
|--------------------------------------------------------------------------
| .:Desktop Page:.
|--------------------------------------------------------------------------
*/

	public function	desktop()
	{
		$data['permission'] = $this->Acms_class->checkPermission();
		$data['language'] = $this->language;
		$data['adminMenu'] = $this->adminMenu;
		$data['access'] = true;
		$data['pageTitle'] = "داشبورد";
		$data['mainContent'] = 'panel/desktop';
		$this->load->view("layouts/panel/desktop", $data);
	}

	/*
|--------------------------------------------------------------------------
|  .:Module Managment Without View:.
|--------------------------------------------------------------------------
*/

	public function	changeStatus($id, $status, $parent)
	{

		$data['resultMessage'] = null;
		if ($id == null || $status == null || $parent == null) {
			redirect(base_url() . "Acms/desktop");
		}
		if ($this->session->userdata("userStatus") == "a") {
			$data['modules'] = $this->Acms_class->changeModuleStatus($id, $status, $parent);
			redirect(base_url() . "Acms/modules/" . $parent);
		} else {
			$data['resultMessage'] = array("result" => "Alert", "group" => ACCESS_CONTROL, "message" => DONT_ACCESS_MODULE, "url" => base_url() . "Acms/desktop");
			$data['languages'] = NULL;
		}
	}

	/*
|--------------------------------------------------------------------------
| .:Change Language Page Without View:.
|--------------------------------------------------------------------------
*/

	public function	changeLanguage($language)
	{

		$userData = array('panelLanguage' => $language);
		$this->session->set_userdata($userData);
		redirect(base_url() . "Acms/desktop");
	}

	/*
|--------------------------------------------------------------------------
|  .:Language Managment Page Without View:.
|--------------------------------------------------------------------------
*/

	public function	changeLangStatus($id, $status)
	{

		$data['resultMessage'] = null;
		if ($id == null || $status == null) {
			redirect(base_url() . "Acms/desktop");
		}
		if ($this->session->userdata("userStatus") == "a") {
			$data['modules'] = $this->Acms_class->changeLanguageStatus($id, $status);
			redirect(base_url() . "Acms/language/");
		} else {
			$data['resultMessage'] = array("result" => "Alert", "group" => ACCESS_CONTROL, "message" => DONT_ACCESS_MODULE, "url" => base_url() . "Acms/desktop");
			$data['languages'] = NULL;
		}
	}

	/*
|--------------------------------------------------------------------------
| .:User Group List:. 
|--------------------------------------------------------------------------
*/

	public function	userGroupList()
	{

		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if ($data['permission'] == "0") {
			$data['resultMessage'] = array("result" => "Alert", "group" => ACCESS_CONTROL, "message" => DONT_ACCESS_MODULE, "url" => base_url() . "Acms/desktop");
		}

		$this->load->helper("tree");
		$result = createArray($this->Acms_class->getUserGroupList());
		$data['tree'] = createTree($result, 0, "createMenu");
		$data['language'] = $this->language;
		$data['adminMenu'] = $this->adminMenu;
		$data['pageTitle'] = "لیست گروه های کاربری";
		$data['mainContent'] = 'panel/userGroupList';
		$this->load->view("layouts/panel/lists", $data);
	}

	/*
|--------------------------------------------------------------------------
| .:Insert Admin User Group:.
|--------------------------------------------------------------------------
*/

	public function	insertUserGroup()
	{

		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if ($data['permission'] == "0") {
			$data['resultMessage'] = array("result" => "Alert", "group" => ACCESS_CONTROL, "message" => DONT_ACCESS_MODULE, "url" => base_url() . "Acms/desktop");
		}

		$this->load->helper("tree");
		$data['language'] = $this->language;
		$data['adminMenu'] = $this->adminMenu;

		$result = createArray($this->Acms_class->getUserGroupList());
		$data['tree'] = createTree($result, 0, "selectUserGroup");
		$data['modules'] = $this->Acms_class->getModules();

		if ($this->input->post("submit") == "submit") {
			$this->form_validation->run('userGroup');
			if ($this->form_validation->run() == FALSE) {
				$data['resultMessage'] = array("result" => "Alert", "group" => GROUP_DATA_ERROR, "message" => DATA_INSERT_ERROR, "url" => null);
			} else {
				if ($this->Acms_class->checkAccess($data['permission'])) {
					$insert = $this->Acms_class->userGroupActionData($this->input->post());
					if ($insert == true) {
						$data['resultMessage'] = array("result" => "Success", "group" => GROUP_DATA_SUCCESS, "message" => DATA_INSERT_SUCCESS, "url" => base_url() . "Acms/insertUserGroup");
					}
				} else {
					$data['resultMessage'] = array("result" => "Alert", "group" => ACCESS_CONTROL, "message" => DONT_ACCESS_DATA, "url" => base_url() . "Acms/userGroupList");
				}
			}
		}

		$data['pageTitle'] = "درج گروه کاربری";
		$data['mainContent'] = 'panel/insertUserGroup';
		$this->load->view("layouts/panel/forms", $data);
	}

	/*
|--------------------------------------------------------------------------
| .:Edit Admin User Group:. 
|--------------------------------------------------------------------------
*/

	public function	editUserGroup($id)
	{

		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if ($data['permission'] == "0") {
			$data['resultMessage'] = array("result" => "Alert", "group" => ACCESS_CONTROL, "message" => DONT_ACCESS_MODULE, "url" => base_url() . "Acms/desktop");
		}

		$this->load->helper("tree");
		$data['language'] = $this->language;
		$data['adminMenu'] = $this->adminMenu;

		$result = createArray($this->Acms_class->getUserGroupList());
		$data['tree'] = createTree($result, 0, "selectUserGroup");
		$data['modules'] = $this->Acms_class->moduleListForGroupRoles($id);
		$data['userGroup'] = $this->Acms_class->getUserGroup($id);
		$data['parentTitle'] = displayParentNodes($result, $id);

		if ($this->input->post("submit") == "submit") {
			$this->form_validation->run('userGroup');
			if ($this->form_validation->run() == FALSE) {
				$data['resultMessage'] = array("result" => "Alert", "group" => GROUP_DATA_ERROR, "message" => DATA_UPDATE_ERROR, "url" => null);
			} else {
				if ($this->Acms_class->checkAccess($data['permission'])) {
					$edit = $this->Acms_class->userGroupActionData($this->input->post(), $id, $data['userGroup'][0]['title']);
					if ($edit == true) {
						$data['resultMessage'] = array("result" => "Success", "group" => GROUP_DATA_SUCCESS, "message" => DATA_UPDATE_SUCCESS, "url" => base_url() . "Acms/userGroupList");
					}
				} else {
					$data['resultMessage'] = array("result" => "Alert", "group" => ACCESS_CONTROL, "message" => DONT_ACCESS_DATA, "url" => base_url() . "Acms/userGroupList");
				}
			}
		}

		$data['pageTitle'] = "ویرایش | " . $data['userGroup'][0]['title'];
		$data['mainContent'] = 'panel/editUserGroup';
		$this->load->view("layouts/panel/forms", $data);
	}

	/*
|--------------------------------------------------------------------------
| .:Delete User Group:. 
|--------------------------------------------------------------------------
*/

	public function	deleteUserGroup($id, $title)
	{

		$permission = $this->Acms_class->checkPermission(__FUNCTION__);
		if ($permission == "a" || $permission == "3") {
			$result = $this->Acms_class->deleteUserGroup($id, urldecode($title));
			echo "<script>alert('" . $result . "');window.location = '" . base_url() . "Acms/userGroupList';</script>";
		} else {
			echo "<script>alert('شما مجوز حذف اطلاعات را ندارید');window.location = '" . base_url() . "Acms/userGroupList';</script>";
		}
	}

	/*
|--------------------------------------------------------------------------
| .:Admin Users List:.
|--------------------------------------------------------------------------
*/

	public function	userList($page = 0)
	{

		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if ($data['permission'] == "0") {
			$data['resultMessage'] = array("result" => "Alert", "group" => ACCESS_CONTROL, "message" => DONT_ACCESS_MODULE, "url" => base_url() . "Acms/desktop");
		}

		$data['language'] = $this->language;
		$data['adminMenu'] = $this->adminMenu;
		$data['count'] = $page + 1;
		$data['users'] = $this->Acms_class->getAdminUserList(25, 3, $page, base_url() . "Acms/userList");
		$data['pageTitle'] = "لیست کاربران مدیریت";
		$data['mainContent'] = 'panel/userList';
		$this->load->view("layouts/panel/lists", $data);
	}

	/*
|--------------------------------------------------------------------------
| Insert Admin User 
|--------------------------------------------------------------------------
*/

	public function	insertUser()
	{

		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if ($data['permission'] == "0") {
			$data['resultMessage'] = array("result" => "Alert", "group" => ACCESS_CONTROL, "message" => DONT_ACCESS_MODULE, "url" => base_url() . "Acms/desktop");
		}

		$data['language'] = $this->language;
		$data['adminMenu'] = $this->adminMenu;
		$data['userGroup'] = NULL;
		$_POST['adminUserAvatar']  = null;
		$avatar = NULL;
		$dateFlag = true;
		$fileFlag = true;

		$result = createArray($this->Acms_class->getUserGroupList());
		$data['tree'] = createTree($result, 0, "selectUserGroup");

		if ($this->input->post("submit") == "submit") {

			$this->form_validation->run('insertUserAdmin');
			if ($this->form_validation->run() == FALSE) {

				$data['resultMessage'] = array("result" => "Alert", "group" => GROUP_DATA_ERROR, "message" => DATA_INSERT_ERROR, "url" => null);
				$this->input->post("adminUserGroupID");
				if ($this->input->post("adminUserGroupID") != "") {
					$data['userGroup'] = $this->Acms_class->getUserGroupTitle($this->input->post("adminUserGroupID"));
				}
			} else {

				if ($this->input->post("scheduleStart") != '' || $this->input->post("scheduleEnd") != '') {
					$this->load->helper("pdate");
					if (!compare2Date(jalToGre($this->input->post("scheduleStart")), jalToGre($this->input->post("scheduleEnd")))) {
						$data['resultMessage'] = array("result" => "Alert", "group" => GROUP_DATA_ERROR, "message" => DATE_ERROR, "url" => null);
						$data['userGroup'] = $this->Acms_class->getUserGroupTitle($this->input->post("adminUserGroupID"));
						$dateFlag = false;
					}
				}

				if ($_FILES['adminUserAvatar']['name'] != null && $dateFlag == true) {
					$this->load->helper("uploadfile");
					$uploadConfig = array('file' => 'adminUserAvatar', 'path' => AVATAR, 'type' => 'jpg|png|gif', 'maxSize' => 100);
					$upload = fileUpload($uploadConfig);
					if ($upload['filename'] == null) {
						$data['resultMessage'] = array("result" => "Alert", "group" => GROUP_DATA_ERROR, "message" => $upload['error'], "url" => null);
						$data['userGroup'] = $this->Acms_class->getUserGroupTitle($this->input->post("adminUserGroupID"));
						$fileFlag = false;
					} else {
						$_POST['adminUserAvatar'] = $upload['filename'];
					}
				}

				if ($dateFlag == true && $fileFlag == true) {
					if ($this->Acms_class->checkAccess($data['permission'])) {
						$insert = $this->Acms_class->adminUserAction($this->input->post());
						if ($insert == true) {
							$data['resultMessage'] = array("result" => "Success", "group" => GROUP_DATA_SUCCESS, "message" => DATA_INSERT_SUCCESS, "url" => base_url() . "Acms/userList");
						}
					} else {
						$data['resultMessage'] = array("result" => "Alert", "group" => ACCESS_CONTROL, "message" => DONT_ACCESS_DATA, "url" => base_url() . "Acms/userList");
					}
				}
			}
		}

		$data['pageTitle'] = "درج کاربر مدیریت سایت";
		$data['mainContent'] = 'panel/insertUser';
		$this->load->view("layouts/panel/forms", $data);
	}

	/*
|--------------------------------------------------------------------------
| Edit Admin User 
|--------------------------------------------------------------------------
*/

	public function	editUser($id)
	{

		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if ($data['permission'] == "2" || $data['permission'] == "1" || $data['permission'] == "0") {
			$data['resultMessage'] = array("result" => "Alert", "group" => ACCESS_CONTROL, "message" => DONT_ACCESS_MODULE, "url" => base_url() . "Acms/desktop");
		}

		$data['language'] = $this->language;
		$data['adminMenu'] = $this->adminMenu;
		$data['userGroup'] = NULL;
		$avatar = NULL;
		$dateFlag = true;
		$fileFlag = true;

		$data['user'] = $this->Acms_class->getUserInfo($id);
		$result = createArray($this->Acms_class->getUserGroupList());
		$data['tree'] = createTree($result, 0, "selectUserGroup");
		$_POST['adminUserAvatar']  = $data['user']['adminUserAvatar'];

		if ($this->input->post("submit") == "submit") {
			if ($this->input->post("adminUserEmail") == $data['user']['adminUserEmail']) {
				$this->form_validation->run('editUserAdmin');
			} else {
				$this->form_validation->run('insertUserAdmin');
			}
			if ($this->form_validation->run() == FALSE) {

				$data['resultMessage'] = array("result" => "Alert", "group" => GROUP_DATA_ERROR, "message" => DATA_INSERT_ERROR, "url" => null);
				$this->input->post("adminUserGroupID");
				if ($this->input->post("adminUserGroupID") != "") {
					$data['userGroup'] = $this->Acms_class->getUserGroupTitle($this->input->post("adminUserGroupID"));
				}
			} else {

				if ($this->input->post("scheduleStart") != '' || $this->input->post("scheduleEnd") != '') {
					$this->load->helper("pdate");
					if (!compare2Date(jalToGre($this->input->post("scheduleStart")), jalToGre($this->input->post("scheduleEnd")))) {
						$data['resultMessage'] = array("result" => "Alert", "group" => GROUP_DATA_ERROR, "message" => DATE_ERROR, "url" => null);
						$data['userGroup'] = $this->Acms_class->getUserGroupTitle($this->input->post("adminUserGroupID"));
						$dateFlag = false;
					}
				}

				if ($_FILES['adminUserAvatar']['name'] != null && $dateFlag == true) {
					$this->load->helper("uploadfile");
					$uploadConfig = array('file' => 'adminUserAvatar', 'path' => AVATAR, 'type' => 'jpg|png|gif', 'maxSize' => 100);
					$upload = fileUpload($uploadConfig);
					if ($upload['filename'] == null) {
						$data['resultMessage'] = array("result" => "Alert", "group" => GROUP_DATA_ERROR, "message" => $upload['error'], "url" => null);
						$data['userGroup'] = $this->Acms_class->getUserGroupTitle($this->input->post("adminUserGroupID"));
						$fileFlag = false;
					} else {
						unlink(AVATAR . $data['user']['adminUserAvatar']);
						$_POST['adminUserAvatar'] = $upload['filename'];
					}
				}

				if ($dateFlag == true && $fileFlag == true) {
					if ($this->Acms_class->checkAccess($data['permission'])) {
						$update = $this->Acms_class->adminUserAction($this->input->post(), $id, $data['user']['adminUserFName'] . " " . $data['user']['adminUserLName']);
						if ($update == true) {
							$data['resultMessage'] = array("result" => "Success", "group" => GROUP_DATA_SUCCESS, "message" => DATA_UPDATE_SUCCESS, "url" => base_url() . "Acms/userList");
						}
					} else {
						$data['resultMessage'] = array("result" => "Alert", "group" => ACCESS_CONTROL, "message" => DONT_ACCESS_DATA, "url" => base_url() . "Acms/userList");
					}
				}
			}
		}

		$data['pageTitle'] = "ویرایش | " . $data['user']['adminUserFName'] . " " . $data['user']['adminUserLName'];
		$data['mainContent'] = 'panel/editUser';
		$this->load->view("layouts/panel/forms", $data);
	}

	/*
|--------------------------------------------------------------------------
| .:Change Password:.
|--------------------------------------------------------------------------
*/

	public function	changeAdminUserPassword($id, $name)
	{

		if ($id == null || $name == null) {
			redirect(base_url() . "Acms/desktop", "refresh");
		}

		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if ($data['permission'] == "2" || $data['permission'] == "1" || $data['permission'] == "0") {
			$data['resultMessage'] = array("result" => "Alert", "group" => ACCESS_CONTROL, "message" => DONT_ACCESS_MODULE, "url" => base_url() . "Acms/desktop");
		}

		$data['id'] = $id;
		$data['name'] = $name;
		$data['language'] = $this->language;
		$data['adminMenu'] = $this->adminMenu;

		if ($this->input->post("submit") == "submit") {
			$this->form_validation->run('changePass');
			if ($this->form_validation->run() == FALSE) {
				$data['resultMessage'] = array("result" => "Alert", "group" => GROUP_DATA_ERROR, "message" => PASS_ERROR, "url" => null);
			} else {
				if ($data['permission'] == "3" || $data['permission'] == "a") {
					if ($this->input->post("password", TRUE) == $this->input->post("passwordRetry", TRUE)) {
						$this->Acms_class->changePass($this->input->post("password", TRUE), $this->input->post("passwordRetry", TRUE), $id, urldecode(str_replace("-", " ", $name)));
						$data['resultMessage'] = array("result" => "Success", "group" => GROUP_DATA_SUCCESS, "message" => CHANGE_PASS, "url" => base_url() . "Acms/userList");
					} else {
						$data['resultMessage'] = array("result" => "Alert", "group" => GROUP_DATA_ERROR, "message" => DIFF_PASS, "url" => null);
					}
				} else {
					$data['resultMessage'] = array("result" => "Alert", "group" => ACCESS_CONTROL, "message" => DONT_ACCESS_DATA, "url" => base_url() . "Acms/userList");
				}
			}
		}
		$data['pageTitle'] = "تغییر کلمه عبور | " . urldecode(str_replace("-", " ", $name));
		$data['mainContent'] = 'panel/changeAdminUserPassword';
		$this->load->view("layouts/panel/forms", $data);
	}

	/*
|--------------------------------------------------------------------------
| .:First Login Change Password:.
|--------------------------------------------------------------------------
*/

	public function	changePassword()
	{

		if ($this->session->userdata("userStatus") != "0") {
			redirect(base_url() . "Acms/desktop", "refresh");
		}
		$data['resultMessage'] = null;

		if ($this->input->post("submit") == "submit") {
			$this->form_validation->run('changePass');
			if ($this->form_validation->run() == FALSE) {
				$data['resultMessage'] = array("result" => "Alert", "group" => GROUP_DATA_ERROR, "message" => PASS_ERROR, "url" => null);
			} else {
				if ($this->input->post("password", TRUE) == $this->input->post("passwordRetry", TRUE)) {
					$this->Acms_class->changePass($this->input->post("password", TRUE), $this->input->post("passwordRetry", TRUE));
					$data['resultMessage'] = array("result" => "Success", "group" => GROUP_DATA_SUCCESS, "message" => FIRST_ENTER_SUCCESS, "url" => base_url() . "Acms/logout");
				} else {
					$data['resultMessage'] = array("result" => "Alert", "group" => GROUP_DATA_ERROR, "message" => DIFF_PASS, "url" => null);
				}
			}
		}
		$data['pageTitle'] = "تغییر کلمه عبور | اولین ورود";
		$this->load->view("panel/changePassword", $data);
	}

	/*
|--------------------------------------------------------------------------
| .:Delete User :. 
|--------------------------------------------------------------------------
*/

	public function	deleteUser($id, $title)
	{

		$permission = $this->Acms_class->checkPermission(__FUNCTION__);
		if ($permission == "a" || $permission == "3") {
			$result = $this->Acms_class->deleteUser($id, urldecode($title));
			echo "<script>
					alert('اطلاعات مورد نظر حذف گردید');
					window.location = '" . base_url() . "Acms/userList'
				  </script>";
		} else {
			echo "<script>
					alert('شما مجوز حذف اطلاعات را ندارید');
					window.location = '" . base_url() . "Acms/userList'
				  </script>";
		}
	}

	/*
|--------------------------------------------------------------------------
| .:User Log List:.
|--------------------------------------------------------------------------
*/

	public function	userLog($page = 0)
	{

		// Check Permission
		$data['resultMessage'] = null;
		$data['permission'] = $this->Acms_class->checkPermission(__FUNCTION__);
		if ($data['permission'] == "0") {
			$data['resultMessage'] = array("result" => "Alert", "group" => ACCESS_CONTROL, "message" => DONT_ACCESS_MODULE, "url" => base_url() . "Acms/desktop");
		}

		$data['language'] = $this->language;
		$data['adminMenu'] = $this->adminMenu;
		$data['count'] = $page + 1;
		$data['users'] = $this->Acms_class->getUserLog(25, 3, $page, base_url() . "Acms/userLog");
		$data['pageTitle'] = "لیست فعالیتهای کاربران";
		$data['mainContent'] = 'panel/userLog';
		$this->load->view("layouts/panel/lists", $data);
	}


	/*
|--------------------------------------------------------------------------
| .:Search Result For Google:.
|--------------------------------------------------------------------------
*/

	function createLink()
	{

		$this->load->model("Job_class");
		$titleArray = $this->Job_class->getAllTags();
		$limit = 500;
		$count = count($titleArray);
		$filesNumber = ceil($count / $limit);
		$countRemain = $count % $limit;
		$counter = 1;
		$fileNameCount = 1;
		$flag = 0;

		$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                <urlset
                      xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"
                      xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
                      xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9
                      http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">";

		foreach ($titleArray as $rows) {

			if ($counter < $limit && $flag == 0) {
				$xml .= "<url>
                            <loc>" . base_url() . "Job/searchBy/tag/" . trim(str_replace(" ", "-", $rows)) . "</loc>
                            <lastmod>" . gmdate('Y-m-d\TH:i:s+00:00', strtotime(date("Y-m-d H:i:s"))) . "</lastmod>
                            <changefreq>always</changefreq>
                            <priority>0.8</priority>
                        </url>";

				if ($counter + 1 == $limit || ($fileNameCount == $filesNumber && $counter == $countRemain)) {
					$flag = 1;
				} else {
					$counter++;
				}
			}

			if ($flag == 1) {

				$xml .= "</urlset>";
				$myfile = fopen("./sitemap/tags/sitemap_" . $fileNameCount . ".xml", "w") or die("Unable to open file!");
				fwrite($myfile, trim($xml));
				fclose($myfile);
				$xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?><urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">";

				$flag = 0;
				$counter = 1;
				$fileNameCount++;
			}
		}
	}

	/*
|--------------------------------------------------------------------------
| .:Search Result For Google:.
|--------------------------------------------------------------------------
*/

	function createMainSitemap()
	{

		$this->load->helper('directory');
		$map = directory_map('./sitemap/tags/', 2);
		$main = null;

		foreach ($map as $key => $value) {

			if (is_array($value)) {
				foreach ($value as $sub) {
					$main .= "<url><loc>" . base_url() . "sitemap/tags/" . $key . $sub . "</loc><lastmod>" . gmdate('Y-m-d\TH:i:s+00:00', strtotime(date("Y-m-d H:i:s"))) . "</lastmod><changefreq>always</changefreq><priority>0.9</priority></url>";
				}
			} else {
				$main .= "<url><loc>" . base_url() . "sitemap/tags/" . $value . "</loc><lastmod>" . gmdate('Y-m-d\TH:i:s+00:00', strtotime(date("Y-m-d H:i:s"))) . "</lastmod><changefreq>always</changefreq><priority>0.9</priority></url>";
			}
		}

		$mainXML = "<?xml version=\"1.0\" encoding=\"utf-8\"?><urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">" . $main . "</urlset>";
		$myfile = fopen("./sitemap.xml", "w") or die("Unable to open file!");
		fwrite($myfile, $mainXML);
		fclose($myfile);
	}


	/*
|--------------------------------------------------------------------------
| .:Logout:. 
|--------------------------------------------------------------------------
*/

	public function logout()
	{

		$this->Acms_class->setCostumUserLog(" خروج از کنترل پنل  ");
		$this->session->sess_destroy();
		redirect(base_url() . 'Acms/index', 'refresh');
	}
}
