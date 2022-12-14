$(document).ready(function () {
    addMoreBrowseArea();
});

function addMoreBrowseArea()
{
    var counter = $("#add_more_files").attr("counter");
    var rowCounter = parseInt(counter) + 1;
    if(rowCounter == 1)
    {
        $("#reset_field").show();
        $("#remove_field").hide(); 
    }
    else
    {
        $("#reset_field").show();
        $("#remove_field").show(); 
    }
    
    var mainDivContent = $("#loopDiv").html();
    $('#total_counter_attachment').val(rowCounter);
    var divContent = mainDivContent.replace(/#rowCounter/g, rowCounter);
    $("#add_more_files").attr("counter", rowCounter);
    $("#mainAttachmentDiv").append(divContent); 
}

function functionRemove(counter) 
{
    $("#mainBorwseDiv"+counter).remove();
}

function functionReset(counter) 
{
    $('#protocal_name'+counter).val('');
    $('#protocal_img'+counter).val('');
}

