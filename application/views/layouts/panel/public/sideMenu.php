<?php if($this->session->userdata['userAvatar'] != ""){
        $img = base_url()."assets/uploads/admin_avatar/".$this->session->userdata['userAvatar'];
    }else{							  	
        $img = base_url()."assets/panel/images/no_avatar.png";
    }
?>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-right image">
          <img src="<?=$img;?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-right info">
          <p><?php echo $this->session->userdata['userName'];?> </p>
          <a href="#"><i class="fa fa-circle text-success"></i> آنلاین</a>
        </div>
      </div>
      <?php if($this->session->userdata("userStatus") == "a"){?>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
            <a href="#">
              <i class="fa fa-laptop"></i>
              <span>تنظیمات ادمین</span>
              <span class="pull-left-container">
                <i class="fa fa-angle-right pull-left"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url();?>Acms/modules"><i class="fa fa-gear"></i> مدیریت ماژولها</a></li>
              <li><a href="<?php echo base_url();?>Acms/language"><i class="fa fa-language"></i> مدیریت زبانها</a></li>
              <li><a href="<?php echo base_url();?>Homepage/homepageItemList"><i class="fa fa-language"></i> مدیریت صفحه اصلی</a></li>
            </ul>
          </li>
      </ul>
      <?php } ?>
      <form action="<?=base_url();?>Job/searchJob" method="post" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="keyword" class="form-control" placeholder="جستجو">
          <span class="input-group-btn">
                <button type="submit" name="submit" value="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <?=$adminMenu;?>
    </section>
  </aside>