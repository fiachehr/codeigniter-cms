
<script src="<?=acms_js_url();?>jquery.min.js"></script>
<script src="<?=acms_js_url();?>bootstrap.min.js"></script>
<script src="<?=acms_js_url();?>fastclick.js"></script>
<script src="<?=acms_js_url();?>adminlte.min.js"></script>
<script src="<?=acms_js_url();?>jquery.sparkline.min.js"></script>
<script src="<?=acms_js_url();?>jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?=acms_js_url();?>jquery-jvectormap-world-mill-en.js"></script>
<script src="<?=acms_js_url();?>jquery.slimscroll.min.js"></script>
<script src="<?=acms_js_url();?>Chart.js"></script>
<script src="<?=acms_js_url();?>pages/dashboard2.js"></script>
<script src="<?=acms_js_url();?>demo.js"></script>
</body>
</html>

<?php
if($access == false){
?>
    <script>
         alertify.alert('عدم دسترسی','شما مجوز دسترسی به این بخش را ندارید').set('onok', function(closeEvent){ 
            window.location.href = postURL+"Acms/desktop";
         } ); 
    </script>
<?php 
}
?>
</body>
</html>