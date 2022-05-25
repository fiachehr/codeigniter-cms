<?php
	$this->load->view('layouts/panel/forms/head.php');
	$this->load->view('layouts/panel/public/header.php');
	$this->load->view('layouts/panel/public/sideMenu.php');
	$this->load->view($mainContent);
	$this->load->view('layouts/panel/public/footer.php');
	$this->load->view('layouts/panel/forms/scripts.php');
?>