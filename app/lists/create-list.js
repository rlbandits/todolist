$(document).ready(function(){
    $(document).on('click', '.create-list-button', function(){
        var create_list_html="";

        // 'read lists' button to show list of reminders
        create_list_html+="<div id='read-lists' class='btn btn-primary pull-right m-b-15px read-lists-button'>";
        create_list_html+="<span class='glyphicon glyphicon-list'></span> Back to lists";
        create_list_html+="</div>";

        // 'create list' html form
        create_list_html+="<form id='create-list-form' action='#' method='post' border='0'>";
        create_list_html+="<table class='table table-hover table-responsive table-bordered'>";

        // name field
        create_list_html+="<tr>";
        create_list_html+="<td>Text</td>";
        create_list_html+="<td><textarea name='textReminder' class='form-control' required ></textarea></td>";
        create_list_html+="</tr>";

        // price field
        create_list_html+="<tr>";
        create_list_html+="<td>Reminde Me</td>";
        create_list_html+="<td><input type='datetime-local' name='dateTimeReminder' class='form-control' required /></td>";
        create_list_html+="</tr>";

        // button to submit form
        create_list_html+="<tr>";
        create_list_html+="<td></td>";
        create_list_html+="<td>";
        create_list_html+="<button type='submit' class='btn btn-primary'>";
        create_list_html+="<span class='glyphicon glyphicon-plus'></span> Create Reminder";
        create_list_html+="</button>";
        create_list_html+="</td>";
        create_list_html+="</tr>";

        create_list_html+="</table>";
        create_list_html+="</form>";

        // inject html to 'page-content' of our app
        $("#page-content").html(create_list_html);

        // change page title
        changePageTitle("Create Reminder");
    });

    // will run if create reminder form was submitted
    $(document).on('submit', '#create-list-form', function(){
        // get form data
        var form_data=JSON.stringify($(this).serializeObject());

        // submit form data to api
        $.ajax({
            url: "http://localhost/todolist/list/create.php",
            type : "POST",
            contentType : 'application/json',
            data : form_data,
            success : function(result) {
                showLists();
            },
            error: function(xhr, resp, text) {
                // show error to console
                console.log(xhr, resp, text);
            }
        });

        return false;
    });
});