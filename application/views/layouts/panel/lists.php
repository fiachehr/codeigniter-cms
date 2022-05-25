<?php
	$this->load->view('layouts/panel/lists/head.php');
	$this->load->view('layouts/panel/public/header.php');
	$this->load->view('layouts/panel/public/sideMenu.php');
	$this->load->view($mainContent);
	$this->load->view('layouts/panel/public/footer.php');
	$this->load->view('layouts/panel/lists/scripts.php');
?>