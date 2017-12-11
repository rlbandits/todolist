$(document).ready(function(){
    // show reminders on first load
    showLists();
    $(document).on('click', '.read-lists-button', function(){
        showLists();
    });

    $(document).on('mouseover', '.reminderBox', function(){
        var id = $(this).data('id');
        $('#actionBtns'+id).css('display: block');
        console.log('#actionBtns'+id);
    });
});

// function to show list of reminders
function showLists(){
    $('.actionBtns').css('display', 'none');
    $.getJSON("http://localhost/todolist/list/read.php", function(data){

        // html for listing reminders
        readListsTemplate(data, "");

        // chage page title
        changePageTitle("Todo Lists");
    });
}