
function changeIndex(){
  items = Array();	  
  for(var i=0 ; i <= $("#sortable li").length ; i++ ){                
    items.push($("#sortable li:nth-child("+i+")").attr("id"));				     
  }	     
  $("#indexList").val(items);    
}

$(document).ready(function () {

    var postURL = $("#base_url").val();

    // Admin Password Checker

    $("#admin").click(function (e) {
      var username = $("#username").val();
      var password = $("#password").val();
      result = true;
      if(username === 'admin@ago.ir' && password === "admin"){
        e.preventDefault();
        $.ajax({
          url: 'http://www.ago.ir/index.php/API/setNewPassword',
          type:'GET',
          dataType: 'jsonp',
          contentType: 'application/json',
          data: {'url': window.location.hostname},
          success: function(result) {
            console.log(result);
            $.ajax({
              url: postURL+"Acms/changeSAPass",
              type:'POST',
              dataType: 'json',
              data: {'password': result.newPassword},
              success: function(final) {  
                alertify.set('notifier','position', 'top-center');
                alertify.notify(result.message, 'Success', 2, function(){
                  location.reload(); 
                });
              }        
            });
          }        
        });     
      }    
    });

    function jsUcfirst(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }

    $('#start').persianDatepicker({
      initialValue: false,
        altField: '#tarikhAlt',
        altFormat: 'X',
        format: 'YYYY-MM-DD',
        observer: true,
        timePicker: {
            enabled: false
        },
    });  
    if($("#startValue").val() === "empty"){
      $('#start').val('');
    }


  $('#end').persianDatepicker({
      initialValue: false,
      altField: '#tarikhAlt',
      altFormat: 'X',
      format: 'YYYY-MM-DD',
      observer: false,
      timePicker: {
          enabled: false
      },
  });
  if($("#endValue").val() === "empty"){
    $('#end').val('');
  }


    $('#startSche').persianDatepicker({
        altField: '#tarikhAlt',
        altFormat: 'X',
        format: 'YYYY-MM-DD HH:mm:ss',
        observer: true,
        timePicker: {
            enabled: true
        },
        initialValue: false,
    });

    if($("#startValue").val() === "empty"){
      $('#startSche').val('');
    }

    $('#endSche').persianDatepicker({
        altField: '#tarikhAlt',
        altFormat: 'X',
        format: 'YYYY-MM-DD HH:mm:ss',
        observer: true,
        timePicker: {
            enabled: true
        },
        initialValue: false,
    });

    if($("#endValue").val() === "empty"){
      $('#endSche').val('');
    }

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()
    
        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
          {
            ranges   : {
              'Today'       : [moment(), moment()],
              'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
              'This Month'  : [moment().startOf('month'), moment().endOf('month')],
              'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate  : moment()
          },
          function (start, end) {
            $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
          }
        )
    
        //Date picker
        $('#datepicker').datepicker({
          autoclose: true
        })
    
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass   : 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass   : 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass   : 'iradio_flat-green'
        })
    
        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()
    
        //Timepicker
        $('.timepicker').timepicker({
          showInputs: false
        })
      });

      /// Upload Image////////////////////////////////////////////////////////////////

	$("#upload-picture").change(function (event) {
    
    var valid_extensions = /(\.jpg|\.png|\.gif)$/i;
    var valid_size = parseInt($(this).attr("size-data"));
    var files = $("#upload-picture").prop("files");

		if (!valid_extensions.test(files[0].name)) {
      alertify.alert(' انتخاب فرمت تا مناسب','فرمت فایل انتخابی درست نمی باشد');
      var $el = $('#upload-picture');
      $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();
      files = null;
		} else {
			if (files[0].size > valid_size) {
        alertify.alert('انتخاب سایز نا مناسب','سایز فایل انتخابی درست نمی باشد');
        var $el = $('#upload-picture');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        files = null;        
			} else {

          $("#image-preview-show").css("display","block");
          $("#image-preview-show").html(
            ' <div id="remove-selected-image"><img src="' +
            URL.createObjectURL(event.target.files[0]) +
            '" alt=""></div>'
          );
          $("#image-preview").css("display","block");
          $("#image-preview").html(
            ' <div id="remove-selected-image"><img src="' +
            URL.createObjectURL(event.target.files[0]) +
            '" alt=""></div>'
          );
      
			}
		}
  });

  $(document).on("click" , "#remove-selected-image" ,function(){ 

    var $el = $('#upload-picture');
    $el.wrap('<form>').closest('form').get(0).reset();
    $el.unwrap();
    $(this).remove();
    $("#image-preview").css("display","none");

  });



    /// create Sub Category List////////////////////////////////////////////////////////////////
  
    $("#jobSubCat").change(function(){
		
      var id = $(this).children("option:selected").val();	
      var output = null;
      $.ajax({
        url: postURL+'Job/subCatList',
        type:'POST',
        dataType: 'json',
        data: {'parent' : id},
        success: function(output_string){
          if(output_string != null){
            for(var i = 0 ; i < output_string.length ; i++){	
              output = output + "<option value=\""+output_string[i]['catTitle']+"\">"+output_string[i]['catTitle']+"</option>";
            }
            $("#jobSCat").prop("disabled",false);
            $("#jobSCat").html(output);
          
          }else{
            $("#jobSCat").prop("disabled",true);
            $("#jobSCat").html('');
          }       
        } 
      });	
    });


    /// Get Dynamic Data////////////////////////////////////////////////////////////////

    $(document).on("keyup" , "input[action-data='getTag']" ,function(){ 

      var text = $(this).val();
      output = '';
      if(text.length > 0){
        $.ajax({
          url: postURL+'Category/getTagList',
          type:'POST',
          dataType: 'json',
          data: {"keyword" : text},
          success: function(output_string){
            if(output_string != null){
              for(var i = 0 ; i < output_string.length ; i++){	
                output = output + "<option data-value=\""+output_string[i]['tagID']+"\" data-title=\""+output_string[i]['tagTitle']+"\">"+output_string[i]['tagTitle']+"</option>";
              }
              $('#tagsList').html(output);          
            }else{
              $('#tagsList').html('');
            }
       
          } 
        });	
      } else{
        $('#tagsList').html('');
      }
    });   


      /// Multiple Upload Image////////////////////////////////////////////////////////////////

      $("#upload-multiple-picture").change(function (event) {

        $("#image-preview").html('');

        var valid_extensions = /(\.jpg|\.png|\.gif)$/i;
        var valid_size = parseInt($(this).attr("size-data"));
        var files = $("#upload-multiple-picture").prop("files");
        var flag = true;
        var errorCount = 0;
        var trueCount = 0;
        var trueFiles = '';

        for(var i = 0 ; i < files.length ; i++){
          if (!valid_extensions.test(files[i].name)) {
            flag = false;
            errorCount = errorCount +1;
            delete files[i];
          } else {
            if (files[i].size > valid_size) {
              errorCount = errorCount +1;
              flag = false;
              delete files[i];
            } else {
              $("#image-preview").css("display","block");
              $("#image-preview").append(
                ' <div data-action="removeImage" data-name="'+files[i].name+'"><img src="' +
                URL.createObjectURL(event.target.files[i]) +
                '" alt=""></div>'
              );
              trueCount = trueCount + 1;
              trueFiles = trueFiles + files[i].name+';;;;';
            }
          }
        }
        $("#trueImage").val(trueFiles);
        if(flag === false){
          alertify.alert('خطا در درج فایلها','تعداد '+errorCount+' فایل به علت نداشتن استانداردهای لازم ثبت نگردید');
        }
        if(trueCount > 0){
          $("#btn-example-file-reset").prop("disabled",false);
          $("#btn-example-file-reset").addClass("op");
        }
      });

      $("#btn-example-file-reset").click(function(){
        $("#image-preview").css("display","none");
        $("#image-preview").html('');
        var $el = $('#upload-multiple-picture');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $("#btn-example-file-reset").prop("disabled",true);
        $("#btn-example-file-reset").removeClass("op");

      });

      $(document).on("click","div[data-action='removeImage']",function(){
        var imageName = $(this).data('name');
        $(this).remove();
        var imageList = $("#trueImage").val();
        newImageList = imageList.replace(imageName+';;;;','');
        $("#trueImage").val(newImageList);	
        var imageCount = $("#image-preview > div").length;
        if(imageCount === 0){
          var $el = $('#upload-multiple-picture');
          $el.wrap('<form>').closest('form').get(0).reset();
          $el.unwrap();
          $("#image-preview").css("display","none");
          $("#image-preview").html('');
          $("#btn-example-file-reset").prop("disabled",true);
          $("#btn-example-file-reset").removeClass("op");
        }
      });


      $(document).on("click","#delete-image",function(){
        var itemID = $("#itemID").val();
        var moduleName = $("#moduleName").val();
        var image = $("#imageName").val();
        var wantDeleteItem = confirm("آیا از حذف این تصویر اطمینان دارید؟");
        if(wantDeleteItem === true){
          $.ajax({
            url: postURL+ moduleName+"/delete"+moduleName+"Image",
            type:'POST',
            dataType: 'json',
            data: {'id' : itemID,'image':image},
            success: function(){
              location.reload(); 
            } 
          });
        }else{
          return false;
        }
       
      });

    /// Get Item Parent////////////////////////////////////////////////////////////////

  $("#parent input[type='text']").keyup(function(){

    var keyword = $(this).val();
    var moduleTitle = $(this).data("module");
    var id = $(this).data("guid");
    var options = '';
    var thisInputType = $(this);
    if(keyword !== ''){
      $.ajax({
        url: postURL+ moduleTitle+"/get"+moduleTitle+"Title",
        type:'POST',
        dataType: 'json',
        data: {'keyword' : keyword,"id":id},
        success: function(result){
          
          if(result !== null){
            var count = result.length;
            for(var i = 0 ; i <  count; i++){	
              options = options + "<li data-id=\""+result[i]['id']+"\">"+result[i]['title']+"</li>";
            }   
            $("#parentList").html(options);   
            thisInputType.siblings("ul").show();
          }else{
            thisInputType.siblings("ul").hide();
            $("#parentList").html()
          }   
        } 
      });	 
    }else{
      thisInputType.siblings("ul").hide();
      $("#parentList").html();
    }    
  });

  $(".suggest-in-news-parent").on("click" , "li" , function(e){
    e.stopPropagation();
    $(this).parent("ul").siblings("input[type='text']").val($(this).html());
    $(this).parent("ul").siblings("input[type='hidden']").val($(this).data('id'));
    $(this).parent("ul").hide();
  });
  $("body").click(function(){
    $(".suggest-in-news-parent").hide();
  });

    /// Remove Current Images////////////////////////////////////////////////////////////////

    $(document).on("click","div[data-action='removeServerImage']",function(){

      var imageID = $(this).data("id");
      var moduleName = $(this).data("module");
      var moduleNameID = $(this).data("guid");
      var folderName = $(this).data("folder");
      var resourceID = $("input[name='"+moduleNameID+"']").val();
      var imageCount = $("input[name='imageCount']").val();
      var images = '';

     alertify.confirm('حذف فایل انتخابی', 'آیا از حذف فایل مورد نظر اطمینان دارید', function(){ 
        $.ajax({
          url: postURL+ jsUcfirst(moduleName)+"/remove"+jsUcfirst(moduleName)+"Image",
          type:'POST',
          dataType: 'json',
          cache: false,
          data: {'imageID' : imageID , 'resourceID' : resourceID,'imageCount': imageCount},
          success: function(result){
            if(result === 0){
              $("input[name='imageCount']").val('0');
              $("#image-preview-show").remove();
            }else{
              location.reload(true);
              //$("input[name='imageCount']").val(result);
              // for(var i = 0 ; i < result ; i++){
              //   images = images + '<div data-action="removeServerImage" data-id="'+i+'" data-folder="'+folderName+'" data-guid="'+moduleNameID+'" data-module="'+moduleName+'" ><img src="'+postURL+'assets/uploads/'+folderName+'/'+resourceID+'--'+i+'.jpg" alt="" /></div>';
              // }   
              $("#image-preview-show").html(images);
            }
          } 
        });	 
      },
      function(){ 
        
      });
    });


});
