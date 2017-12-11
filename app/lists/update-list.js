$(document).ready(function(){

    // show html form when 'update reminder' button was clicked
    $(document).on('click', '.update-list-button', function(){
        // get reminder id
        var id = $(this).attr('data-id');

        // read one record based on given reminder id
        $.getJSON("http://localhost/todolist/list/read_one.php?id=" + id, function(data){
            // values will be used to fill out our form
            var text = data.text;
            var dateTimeReminder = data.dateTimeReminder;

            // store 'update reminder' html to this variable
            var update_list_html="";

            // 'read lists' button to show list of reminders
            update_list_html+="<div id='read-lists' class='btn btn-primary pull-right m-b-15px read-lists-button'>";
            update_list_html+="<span class='glyphicon glyphicon-list'></span> Back to lists";
            update_list_html+="</div>";

            // build 'update list' html form
            // we used the 'required' html5 property to prevent empty fields
            update_list_html+="<form id='update-list-form' action='#' method='post' border='0'>";
            update_list_html+="<table class='table table-hover table-responsive table-bordered'>";

            // text field
            update_list_html+="<tr>";
            update_list_html+="<td>Reminder</td>";
            update_list_html+="<td><input value=\"" + text + "\" type='text' name='textReminder' class='form-control' required /></td>";
            update_list_html+="</tr>";

            // dateTimeReminder field
            update_list_html+="<tr>";
            update_list_html+="<td>Alarm</td>";
            update_list_html+="<td><input value=\"" + dateTimeReminder + "\" type='datetime-local' name='dateTimeReminder' class='form-control' required /></td>";
            update_list_html+="</tr>";

            // hidden 'reminder id' to identify which record to delete
            update_list_html+="<td><input value=\"" + id + "\" name='id' type='hidden' /></td>";

            // button to submit form
            update_list_html+="<td>";
            update_list_html+="<button type='submit' class='btn btn-info'>";
            update_list_html+="<span class='glyphicon glyphicon-edit'></span> Update Reminder";
            update_list_html+="</button>";
            update_list_html+="</td>";

            update_list_html+="</tr>";

            update_list_html+="</table>";
            update_list_html+="</form>";

            // inject to 'page-content' of our app
            $("#page-content").html(update_list_html);

            // chage page title
            changePageTitle("Update Reminder");

        });
    });

    $(document).on('submit', '#update-list-form', function(){
        console.log('update test');
        /// get form data
        var form_data=JSON.stringify($(this).serializeObject());

        // submit form data to api
        $.ajax({
            url: "http://localhost/todolist/list/update.php",
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