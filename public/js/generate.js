//Zona 1
$("#1").change(function(){
	$(".State1").prop("checked", $(this).prop("checked"));
});

$(".State1").change(function(){
	if($(this).prop("checked") == false){
		$("#1").prop("checked",false);
	}
	if($(".State1:checked").length == $(".checkbox").length){
		$("#1").prop("checked",true);
	}
});

//Zona 2
$("#2").change(function(){
	$(".State2").prop("checked", $(this).prop("checked"));
});

$(".State2").change(function(){
	if($(this).prop("checked") == false){
		$("#2").prop("checked",false);
	}
	if($(".State2:checked").length == $(".checkbox").length){
		$("#2").prop("checked",true);
	}
});

//Zona 3
$("#3").change(function(){
	$(".State3").prop("checked", $(this).prop("checked"));
});

$(".State3").change(function(){
	if($(this).prop("checked") == false){
		$("#3").prop("checked",false);
	}
	if($(".State3:checked").length == $(".checkbox").length){
		$("#3").prop("checked",true);
	}
});

//Zona 4
$("#4").change(function(){
	$(".State4").prop("checked", $(this).prop("checked"));
});

$(".State4").change(function(){
	if($(this).prop("checked") == false){
		$("#4").prop("checked",false);
	}
	if($(".State4:checked").length == $(".checkbox").length){
		$("#4").prop("checked",true);
	}
});