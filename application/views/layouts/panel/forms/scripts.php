<input type="hidden" value=<?=base_url();?> id="base_url" />
<script src="<?=acms_js_url();?>jquery.min.js"></script>
<script src="<?=acms_js_url();?>bootstrap.min.js"></script>
<script src="<?=acms_js_url();?>select2.full.min.js"></script>
<script src="<?=acms_js_url();?>jquery.inputmask.js"></script>
<script src="<?=acms_js_url();?>jquery.inputmask.date.extensions.js"></script>
<script src="<?=acms_js_url();?>jquery.inputmask.extensions.js"></script>
<script src="<?=acms_js_url();?>moment.min.js"></script>
<script src="<?=acms_js_url();?>daterangepicker.js"></script>
<script src="<?=acms_js_url();?>bootstrap-datepicker.min.js"></script>
<script src="<?=acms_js_url();?>bootstrap-colorpicker.min.js"></script>
<script src="<?=acms_js_url();?>bootstrap-timepicker.min.js"></script>
<script src="<?=acms_js_url();?>jquery.slimscroll.min.js"></script>
<script src="<?=acms_js_url();?>icheck.min.js"></script>
<script src="<?=acms_js_url();?>fastclick.js"></script>
<script src="<?=acms_js_url();?>adminlte.min.js"></script>
<script src="<?=acms_js_url();?>demo.js"></script>
<script src="<?=acms_js_url();?>persian-date-0.1.8.min.js"></script>
<script src="<?=acms_js_url();?>persian-datepicker-0.4.5.min.js"></script>
<!-- Manualy script -->
<script src="<?=acms_js_url();?>modules/admin.js"></script>
<script src="<?=acms_js_url();?>modules/category.js" type="text/javascript"></script>
<script src="<?=acms_js_url();?>alertify.min.js"></script>
<script src="<?=acms_js_url();?>plugin-tag.js"></script>



<?php if(isset($jqueryUI)){?>
?>
<script src="<?php echo base_url(); ?>assets/panel/scripts/jquery-ui.js" type="text/javascript"></script>
<script>
	$(function() {			
		$( "#sortable" ).sortable({
			placeholder: "ui-state-highlight"
		});
		$( "#sortable" ).disableSelection();
	});
</script>
<?php } ?>

<?php


if($resultMessage != null){
    if($resultMessage['result'] == "Success"){
        echo "<style>.alertify .ajs-header{background-color:#D1E231}</style>";
    }elseif($resultMessage['result'] == "Alert"){
        echo "<style>.alertify .ajs-header{background-color:#FFC0CB}</style>";
    }elseif($resultMessage['result'] == "Access"){
        echo "<style>.alertify .ajs-header{background-color:#FBCEB1}</style>";
    }
?>
    <script>
         alertify.alert('<?=$resultMessage['group'];?>','<?=$resultMessage['message'];?>').set('onok', function(closeEvent){ 
             <?php
             if($resultMessage['url'] != null ){
             ?>
              window.location.href = '<?=$resultMessage['url'];?>';
             <?php
             }
             ?>        
         }); 
    </script>
<?php 
}
?>

<?php if(isset($ckeditor)){?>
<!--CKEDITOR-->                                             
<script type="text/javascript" src="<?php echo base_url(); ?>assets/panel/scripts/ckeditor/script/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/panel/scripts/ckeditor/script/ckfinder/ckfinder.js"></script>
<script>
      CKEDITOR.replace( 'content', { customConfig: 'custom/config.js'});
      CKFinder.setupCKEditor(null, '<?php echo $ckeditor; ?>assets/panel/scripts/ckeditor/script/ckfinder/');
      CKEDITOR.replace( 'content-1', { customConfig: 'custom/config.js'});
      CKFinder.setupCKEditor(null, '<?php echo $ckeditor; ?>assets/panel/scripts/ckeditor/script/ckfinder/');
      
</script> 
<!--CKEDITOR-->
<?php } ?> 
</body>
</html>