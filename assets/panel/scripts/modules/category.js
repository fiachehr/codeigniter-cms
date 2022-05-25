$(document).ready(function () {

	var postURL = $("#base_url").val();	

	function treeView(){	
		var plus = "<i class='fa fa-plus-square-o'></i>"; 
		$('.tree-menu li:has(ul)').prepend(plus).css(
		{
			'margin-right':'-27px',
			'cursor':'pointer'
		});
		$('.tree-menu li').click(function(event){
			
			event.stopPropagation();
			var ulclass=$(this).find('ul:first').attr('class');
			$(this).children('.tree-open').slideUp(300).attr('class','tree-close');
			$(this).find('i:first').attr('class','fa fa-plus-square-o');
			 if(ulclass=="tree-close"){
				$(this).find('ul:first').slideDown(500).attr('class','tree-open');
				$(this).find('i:first').attr('class','fa fa-minus-square-o');
		}
		});		
	}

    $("li[data-action=selectUserGroup]").click(function () {
		var title = $(this).attr("data-title");
		var id = $(this).attr("data-id");
		$("#tag-suggest").css("display","block");
		$("#tag-suggest").html('<span class="tag" data-action="deleteUserGroup">'+title+'</span>');	
		$("#parentID").val(id);               	
		$("#parentTitleValue").val(title);     
	});

	$(document).on("click", "span[data-action=deleteUserGroup]", function () {
		$("#tag-suggest").html('');
	 	$("#tag-suggest").css('display','none');								
	    $("#parentID").val('');   
	});
	
	$("li[data-action=createMenu]").click(function () {
		var title = $(this).attr("data-title");
		var id = $(this).attr("data-id");
		$(".panel-menu").html('<a href="'+postURL+'Acms/insertUserGroup/"><i class="fa fa-plus-square "></i><span class="link-title">درج گروه کاربری</span> </a> | <a class="text-success" href="'+postURL+'Acms/editUserGroup/'+id+'"><i class="fa fa-pencil-square"></i><span class="link-title">ویرایش '+title+'</span> </a> |  <a class="text-primary" href="'+postURL+'Acms/deleteUserGroup/'+id+'/'+title.replace(" ","-")+'"><i class="fa fa-trash"></i><span class="link-title">حذف '+title+'</span> </a>');	     
	});

	$("li[data-action=createLocationMenu]").click(function () {
		var title = $(this).attr("data-title");
		var id = $(this).attr("data-id");
		$(".panel-menu").html('<a href="'+postURL+'Job/insertLocation/"><i class="fa fa-plus-square "></i><span class="link-title">درج  شهر و محله</span> </a> | <a class="text-success" href="'+postURL+'Job/editLocation/'+id+'"><i class="fa fa-pencil-square"></i><span class="link-title">ویرایش '+title+'</span> </a> |  <a class="text-primary" href="'+postURL+'Job/deleteLoc/'+id+'/'+title.replace(" ","-")+'"><i class="fa fa-trash"></i><span class="link-title">حذف '+title+'</span> </a>');	     
	});

	var plus = "<i class='fa fa-plus-square-o'></i>"; 
	$('.tree-menu li:has(ul)').prepend(plus).css(
		{
			'margin-right':'-27px',
			'cursor':'pointer'
		});
	$('.tree-menu li').click(function(event){
			event.stopPropagation();
			var ulclass=$(this).find('ul:first').attr('class');
			$(this).children('.tree-open').slideUp(300).attr('class','tree-close');
			$(this).find('i:first').attr('class','fa fa-plus-square-o');
			 if(ulclass=="tree-close"){
				$(this).find('ul:first').slideDown(500).attr('class','tree-open');
				$(this).find('i:first').attr('class','fa fa-minus-square-o');
			}
	});


	$("#catModule").change(function(){	
		var id = $("#catModule").val();	
		window.location.replace(postURL + "Category/pageAndCatList/"+id );
	});

	$("li[data-action=createCatMenu]").click(function () {
		var title = $(this).attr("data-title");
		var id = $(this).attr("data-id");
		var moduleID = $("#moduleID").val();

		$.ajax({
			url: postURL+'Category/getCatData',
			type:'GET',
			dataType: 'json',
			data: {'id' : id},
			success: function(result){
				var contentEditActive = '';
				var contentEditDeactive = '';
				if(result.type === "c" && result.module === "25"){
					contentEditActive = '<a class="text-success" href="'+postURL+'Category/pageContent/'+id+'/'+title.replace(" ","-")+'"><i class="fa fa-file-text"></i><span class="link-title">ویرایش محتوی '+title+'</span></a>';
					contentEditDeactive =  '<i class="fa fa-file-text "></i><span class="link-title">ویرایش محتوی '+title+'</span>';
				}else if(result.type === "l" && result.module === "25"){
					contentEditActive = '<a class="text-success" href="'+postURL+'Category/addLink/'+id+'/'+title.replace(" ","-")+'"><i class="fa fa-link"></i><span class="link-title"> افزودن لینک '+title+'</span></a>';
					contentEditDeactive =  '<i class="fa fa-link"></i><span class="link-title">افزودن لینک '+title+'</span>';
				}else if(result.type === "a" && result.module === "25"){
					contentEditActive = '<a class="text-success" href="'+postURL+'Category/addAttachment/'+id+'/'+title.replace(" ","-")+'"><i class="fa fa-paperclip "></i><span class="link-title"> افزودن فایل '+title+'</span></a>';
					contentEditDeactive =  '<i class="fa fa-paperclip "></i><span class="link-title">افزودن فایل '+title+'</span>';
				}else if(result.type === "f" && result.module === "25"){
					contentEditActive = '<a class="text-success" href="'+postURL+'Category/addForm/'+id+'/'+title.replace(" ","-")+'"><i class="fa fa-wpforms "></i><span class="link-title"> ویرایش فرم '+title+'</span></a>';
					contentEditDeactive =  '<i class="fa fa-wpforms"></i><span class="link-title">ویرایش فرم '+title+'</span>';
				}
				var sortingActive = '<a href="'+postURL+'Category/categoryIndex/'+id+'/'+title.replace(" ","-")+'"><i class="fa fa-sort-numeric-desc"></i><span class="link-title"> الویت بندی زیر دسته های '+title+'</span></a>'
				var sortingDeactive = '<i class="fa fa-sort-numeric-desc"></i><span class="link-title"> الویت بندی زیر دسته های '+title+'</span>'
				var insertActive = '<a href="'+postURL+'Category/insertCategory/'+moduleID+'"><i class="fa fa-plus-square "></i><span class="link-title"> درج دسته بندی یا صفحه</span> </a>';
				var insertDeactive = '<i class="fa fa-plus-square "></i><span class="link-title"> درج دسته بندی یا صفحه</span> ';
				var deleteActive = '<a class="text-primary" href="'+postURL+'Category/deleteCategory/'+id+'/'+title.replace(" ","-")+'"><i class="fa fa-trash"></i><span class="link-title">حذف '+title+'</span> </a>'
				var deleteDeactive = '<i class="fa fa-trash"></i><span class="link-title">حذف '+title+'</span>';
				var editActive = '<a class="text-success" href="'+postURL+'Category/editCategory/'+id+'/'+title.replace(" ","-")+'"><i class="fa fa-pencil-square"></i><span class="link-title">ویرایش '+title+'</span> </a>';
				var editDeactive = '<i class="fa fa-pencil-square"></i><span class="link-title">ویرایش '+title+'</span> </a>';

				if(result.permission === "a" || result.permission === "3"){
					$(".panel-menu").html(insertActive+editActive+deleteActive+sortingActive+contentEditActive);
				}else if(result.permission === "2"){
					$(".panel-menu").html(insertActive+editDeactive+deleteDeactive+sortingDeactive+contentEditDeactive);				
				}else if(result.permission === "1"){
					$(".panel-menu").html(insertDeactive+editDeactive+deleteDeactive+sortingDeactive+contentEditDeactive);
				}	
			} 
		  });	     
	});

	$("li[data-action=parentCategory]").click(function () {
		var title = $(this).attr("data-title");
		var id = $(this).attr("data-id");
		$("#tag-suggest").css("display","block");
		$("#tag-suggest").html('<span class="tag" data-action="deleteUserGroup">'+title+'</span>');	
		$("#parentID").val(id);  
		$("#parentTitle").val(title);             	   
	});

	$("li[data-action=selectMultiCat]").click(function(){
		var catID = $(this).data('id');
		var catTitle = $(this).data('title');
		var catList = $("#catList").val();
		var arrayCatList = catList.split(";;");		
		if(arrayCatList.indexOf(catID.toString()) != -1){
			alert('این دسته بندی قبلا ثبت شده است');
		}else{
			if($("#tag-suggest span").html() == "<p>فیلد دسته بندی مطلب پر نشده است.</p>"){
				$("#tag-suggest").html('');
			}
			$("#tag-suggest").append('<span class="tag" data-action="deleteCategory" data-id="'+catID+'" id="cat-'+catID+'">'+catTitle+'</span>');
			$("#catList").val(catList+catID+';;')
		}
	});

	$(document).on("click", "span[data-action=deleteCategory]", function () {
		var catID = $(this).data('id');
		var catList = $("#catList").val();
		$("#cat-"+catID).remove();	
		newCatIDs = catList.replace(catID+";;",'');
		$("#catList").val(newCatIDs);		
	});


	$("li[data-action=getlocationDeliveryFee]").click(function(){
		var id = $(this).data("id")
		$.ajax({
			url: postURL+'Shop/locationDeliveryFee',
			type:'GET',
			dataType: 'json',
			data: {'id' : id},
			success: function(output_string){
					$("#locationFee").val(output_string);
					$("#locationID").val(id);
			} 
		});
	});
	
	$("#setDeliveryFee").click(function(){
		var numberReg = /^[0-9]+$/;	
		var deliveryFee = $("#locationFee").val();
		var id = $("#locationID").val();
		if(!numberReg.test(deliveryFee) && deliveryFee != "") {
			alertify.alert('عدم ثبت اطلاعات','هزینه ارسال به درستی وارد نشده است ').set('onok', function(){ 
				location.reload();                              
			});
		}else{
			$.ajax({
				url: postURL+'Shop/setDeliveryFee',
				type:'GET',
				dataType: 'json',
				data: {'id' : id,'delFee' : deliveryFee},
				success: function(output_string){
					alertify.alert('عدم ثبت اطلاعات','هزینه ارسال به روزرسانی شد').set('onok', function(){ 
						location.reload();                              
					});
				} 
			});
		}
	});

});






// function selectPage(id){

// 	var postURL = $("#url").val();
		
// 	$.ajax({
// 			url: postURL+'category/selectCategory',
// 			type:'GET',
// 			dataType: 'json',
// 			data: {'catID' : id},
		

// 			success: function(output_string){	
// 				$("#tag-suggest").html('<span class="tag" onclick="deletePage()">'+output_string['title']+'</span>');								
//                	$("#parentID").val(id);
//                	$("#categoryURL").val(output_string['url']);
// 			} 
// 		});	

// }

// function deletePage(){
// 	$("#tag-suggest").html('');								
//     $("#parentID").val('');
//     $("#categoryLevel").val('1');
//     $("#categoryURL").val('');
// }





// function changeIndex(){
	
// 	items = Array();	
	
// 	for(var i=0 ; i <= $("#sortable li").length ; i++ ){
								
// 		items.push($("#sortable li:nth-child("+i+")").attr("id"));				
		
// 	}	
		
// 	$("#indexList").val(items); 	
	
// }



// function actionGalleryMenu(catID){
	
// 	var postURL = $("#url").val();
// 	var permission = $("#permission").val();			
// 	output = '<span class=" font-blue"><i class="fa fa-edit font-blue"></i><a class=" font-blue" href="'+postURL+'gallery/galleryPhotoList/'+catID+'/'+$("#cat"+catID).attr("data-title")+'">لیست تصاویر '+$("#cat"+catID).attr("data-title")+'</a></span>';						
// 	$("#catMenu").html(output);
	
// }

