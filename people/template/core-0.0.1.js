$(function() {
    $("#divBaseFunc").css("display", "block");
    $("#divProFunc").css("display", "none");
    $("#divVIPFunc").css("display", "none");
    
    $("#divAddNewPeople").css("display", "none");
    
    $("#aBaseFunc").click(function(){
        $("#divBaseFunc").css("display", "block");
        $("#divProFunc").css("display", "none");
        $("#divVIPFunc").css("display", "none");
        $("#aBaseFunc").addClass("active");
        $("#aProFunc").removeClass("active");
        $("#aVIPFunc").removeClass("active");
    });
    
    $("#aProFunc").click(function(){
        $("#divBaseFunc").css("display", "none");
        $("#divProFunc").css("display", "block");
        $("#divVIPFunc").css("display", "none");
        $("#aBaseFunc").removeClass("active");
        $("#aProFunc").addClass("active");
        $("#aVIPFunc").removeClass("active");
    });
    
    $("#aVIPFunc").click(function(){
        $("#divBaseFunc").css("display", "none");
        $("#divProFunc").css("display", "none");
        $("#divVIPFunc").css("display", "block");
        $("#aBaseFunc").removeClass("active");
        $("#aProFunc").removeClass("active");
        $("#aVIPFunc").addClass("active");
    });
    
    function viewServerAnswer(data) {
        //$("#divAddNewPeople").append(data);
    }
    
    $("#aAddNewPeople").click(viewAddNewPeople);
    function viewAddNewPeople() {
        $("#divBaseFunc").css("display", "none");
        $("#divAddNewPeople").css("display", "block");
    }
    
    $("#sendData").click(submitNewPeople);
    function submitNewPeople() {
        var firstName = $("input[name=firstName]").val();
        var lastName = $("input[name=lastName]").val();
        var fatherName = $("input[name=fatherName]").val();
        var sex = $("input[name=sex]").val();
        var birthDay = $("input[name=birthDay]").val();
        
        var requestData = "action=addNewPeople&firstName=" + firstName + "&lastName=" + lastName + "&fatherName=" + fatherName + "&sex=" + sex + "&birthDay=" + birthDay;
        
        $.post("../", requestData, viewServerAnswer(data));
        
        //$("#divAddNewPeople").load("../?action=addNewPeople&fin=" + firstName + "&ln=" + lastName + "&fan=" + fatherName + "&sex=" + sex + "&birthDay=" + birthDay);
        
        return false;
    }
    
});