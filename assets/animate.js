$(document).ready(function(){
	$('.hidden-image:eq(0)').fadeOut(1);
	$('.hidden-image:eq(0)').fadeIn(400);
	$('.logo:eq(0)').animate({"marginLeft": '0px'},1500);
	$('.logo:eq(1)').animate({"marginLeft": '0px'},2000);
	$('.logo:eq(2)').animate({"marginLeft": '0px'},2500);
	$('#edit_foto_klik').click(function(){
        $('#ti-upload').fadeIn(2000);
        $('#ti-edit').fadeOut(1000);
        return false;
    });
    $('#ti-trash').click(function(){
        $('#ti-upload').fadeOut(1000);
        $('#ti-edit').fadeIn(2000);
        return true;
    });
});