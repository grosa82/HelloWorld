function showErrorPicture(show){
	if (show == 1)
		$("#park").show();
	else
		$("#park").hide();
}
function showMessage(number, msg, success){
	clearMsg();
	$("#msg" + number).html(msg);
	if (success)
		$("#msg" + number).addClass("label-success");
	else
		$("#msg" + number).addClass("label-danger");
}
function removeCourse(id) {
	if (confirm('Are you sure you want to remove this course?')){
		$.post("removeCourse.php", "id=" + id, function(msg){
			showMessage(2, msg.content, msg.success);
			if (msg.success)
				loadCourses();
		});
	}
}
function loadCourses() {
	$("#courses").html("");
	$(".course").remove();
	showErrorPicture(0);
	var conflicts = "";
	$.getJSON( "loadCourses.php", function(data) {
	  $.each( data, function( key, val ) {
	    var course = "<tr><td>"+val.name;
	    if (val.conflicted)
	    {
	    	course = course + "<img src='warning.gif' title='Conflict detected' style='margin-left: 20px;' />";
	    	conflicts = conflicts + " " + val.code;
	    	showMessage(2, "Conflicts found between courses " + conflicts + ". Please remove the courses conflicting", false);
	    	showErrorPicture(1);
	    }
	    course = course + "</td><td>"+val.code+"</td><td>"+val.section+"</td><td>"+val.time_begin;
	    course = course + "</td><td>"+val.time_end+"</td><td>"+val.weekdayName;
	    course = course + "</td><td><img src='delete.png' title='Remove course' class='delete' onclick='removeCourse("+val.id+")' /></td></tr>";
	    
	    // add courses to the table
	    $("#courses").append(course);

	    // add courses to the schedule
	    for (var i = 0; i < val.weekday.length; i++)
	    {
	    	var conflict = "";
	    	var defaultColor = val.color;
	    	var title = val.name;
	    	if (val.conflicted){
	    		conflict = " conflict";
	    		defaultColor = "red";
	    		title = "Conflicting with another course";
	    	}
	    	var html = "<div class='course "+conflict+"' style='height: "+val.height+"px; top: "+val.topMargin+"px; background-color: "+defaultColor+"' title='"+title+"'>"+val.code+"</div>";
	    	$("#weekday_" + val.weekday[i]).append(html);
	    }
	  });
	});
}
function addCourse() {
	clearMsg();
	if ($("#myForm").valid())
	{
		var data = "name=" + $("#name").val() + "&code=" + $("#code").val() + "&section=" + $("#section").val() + "&hour_begin=" + $("#hour_begin").val();
		data = data + "&minute_begin=" + $("#minute_begin").val() + "&hour_end=" + $("#hour_end").val() + "&minute_end=" + $("#minute_end").val() + "&weekday=";

		$(".day:checked").each(function() {
			data = data + $(this).val();
		});

		$.post("addCourse.php", data, function(msg) {
			showMessage("", msg.content, msg.success);
			if (msg.success)
			{
				document.getElementById("myForm").reset();
				$("#name").focus();
				loadCourses();
			}
		});
	}
}
function clearMsg(){
	$("#msg").html("");
	$("#msg").removeClass("label-success");
	$("#msg").removeClass("label-danger");
	$("#msg2").html("");
	$("#msg2").removeClass("label-success");
	$("#msg2").removeClass("label-danger");
}
$(document).ready(function(){
	loadCourses();
	$("#name").focus();
	$("#myForm").validate({
	  rules: {
	    name: {
	      required: true
	    },
	    code: {
	      required: true
	    },
	    section: {
	      required: true
	    }
	  }});
});