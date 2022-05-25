<input type="hidden" value=<?=base_url();?> id="base_url" />
<script src="<?=acms_js_url();?>jquery.min.js"></script>
<script src="<?=acms_js_url();?>bootstrap.min.js"></script>
<script src="<?=acms_js_url();?>modules/main.js"></script>
<script src="<?=acms_js_url();?>jquery.slimscroll.min.js"></script>
<script src="<?=acms_js_url();?>fastclick.js"></script>
<script src="<?=acms_js_url();?>adminlte.min.js"></script>
<script src="<?=acms_js_url();?>demo.js"></script>
<script src="<?=acms_js_url();?>alertify.min.js"></script>
<script src="<?=acms_js_url();?>modules/category.js" type="text/javascript"></script>

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
</body>
</html>