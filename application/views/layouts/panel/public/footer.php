  <!-- /.content-wrapper -->
  <footer class="main-footer text-left">
    <strong>Copyright &copy; <?=date("Y");?> <a href="http://www.ago.ir">گسترش فناوری آگو</a></strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab"></div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">وضعیت</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <?php
          if($this->session->userdata("userStatus") == "a"){?>
            <div class="form-group">
              <a href="<?=base_url()?>Acms/modules"><i class="fa fa-gear"></i>&nbsp;&nbsp;مدیریت ماژولها</a>
            </div>
            <div class="form-group">
            <a href="<?=base_url()?>Acms/language"><i class="fa fa-language"></i>&nbsp;&nbsp;مدیریت زبانها</a>
            </div>
            <div class="form-group">
            <a href="<?=base_url()?>Homepage/homepageItemList"><i class="fa fa-language"></i>&nbsp;&nbsp;مدیریت صفحه اصلی</a>
            </div>
          <?php } ?>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>