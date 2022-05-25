<header class="main-header">
   <!-- Logo -->
   <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">پنل</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>کنترل پنل مدیریت</b></span>
   </a>
   <!-- Header Navbar: style can be found in header.less -->
   <nav class="navbar navbar-static-top">
      <div class="btn-group">
         <button type="button" class="btn btn-default btn-flat dropdown-toggle language-btn" data-toggle="dropdown">
            <?php echo "<img src=\"" . base_url() . "assets/panel/images/flags/" . $this->session->userdata('panelLanguage') . ".png\">"; ?>
            <span class="sr-only">انتخاب زبان</span>
         </button>
         <?php if (isset($language) ) { ?>
            <ul class="dropdown-menu language-list" role="menu">
               <?php
               foreach ($language as $languageRow) {
                  echo "<li>										
                            <a href=\"" . base_url() . "Acms/changeLanguage/" . $languageRow['languageIcon'] . "\">																										
                                <img src=\"" . base_url() . "assets/panel/images/flags/" . $languageRow['languageIcon'] . ".png\" alt=\"" . $languageRow['languageTitle'] . "\">&nbsp;&nbsp;												
                                " . $languageRow['languageTitle'] . "
                            </a>
                        </li>";
               }
               ?>
            </ul>
         <?php } ?>
      </div>
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
         <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
         <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <?php if ($this->session->userdata['userAvatar'] != "") {
                     $img = base_url() . "assets/uploads/admin_avatar/" . $this->session->userdata['userAvatar'];
                  } else {
                     $img = base_url() . "assets/panel/images/no_avatar.png";
                  }
                  ?>
                  <img src="<?= $img ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $this->session->userdata['userName']; ?> </span></span>
               </a>
               <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                     <img src="<?= $img ?>" class="img-circle" alt="User Image">
                     <p>
                        <?php echo $this->session->userdata['userName']; ?>
                     </p>
                  </li>

            </li>
            <!-- Menu Footer-->
            <li class="user-footer">

               <div class="pull-left">
                  <a href="<?= base_url(); ?>Acms/logout" class="btn btn-default btn-flat">خروج</a>
               </div>
            </li>
         </ul>
         </li>
         <!-- Control Sidebar Toggle Button -->
         <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
         </li>
         </ul>
      </div>
   </nav>
</header>