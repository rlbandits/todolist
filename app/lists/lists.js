// lists list html
function readListsTemplate(data, keywords){

    var read_lists_html="";

    read_lists_html+='<div class="contentHeader">';

    // search lists form
    read_lists_html+="<form id='search-list-form' action='#' method='post'>";
    read_lists_html+="<div class='input-group pull-left w-30-pct'>";

    read_lists_html+="<input type='text' value=\"" + keywords + "\" name='keywords' class='form-control list-search-keywords' placeholder='Search list...' />";

    read_lists_html+="<span class='input-group-btn'>";
    read_lists_html+="<button type='submit' class='btn btn-default' type='button'>";
    read_lists_html+="<span class='glyphicon glyphicon-search'></span>";
    read_lists_html+="</button>";
    read_lists_html+="</span>";

    read_lists_html+="</div>";
    read_lists_html+="</form>";

    // when clicked, it will load the create list form
    read_lists_html+="<div id='create-list' class='btn btn-primary pull-right m-b-15px create-list-button'>";
    read_lists_html+="<span class='glyphicon glyphicon-plus'></span> Create Reminder";
    read_lists_html+="</div>";

    read_lists_html+='</div>';

    read_lists_html+="<div>";

    // loop through returned list of data
    $.each(data.records, function(key, val) {
        // start div
        read_lists_html+="<div class='reminderBox col-sm-4' data-id='" + val.id + "'>";

        read_lists_html+="<div class='reminderBoxContent'>";

        read_lists_html+="<div class='panel-heading'>";
        // 'action' buttons
        read_lists_html+="<div class='actionBtns' id='actionBtns"+val.id+"'>";

        // edit button
        read_lists_html+="<button class='btn btn-info update-list-button' data-id='" + val.id + "' data-toggle='tooltip' title='Edit'>";
        read_lists_html+="<span class='glyphicon glyphicon-pencil'></span>";
        read_lists_html+="</button>";

        // delete button
        read_lists_html+="<button class='btn btn-danger delete-list-button' data-id='" + val.id + "' data-toggle='tooltip' title='Delete'>";
        read_lists_html+="<span class='glyphicon glyphicon-trash'></span>";
        read_lists_html+="</button>";
        read_lists_html+="</div>";
        read_lists_html+="</div>";

        read_lists_html+="<div class='panel-body'>";
        read_lists_html+="<p>" + val.text + "</p>";
        read_lists_html+="</div>";
        read_lists_html+="<div class='panel-footer'>";
        read_lists_html+="<div class='dateTimeIndicator'>Created: " + val.dateTimeCreated + "</div>";
        read_lists_html+="<div class='dateTimeIndicator'>Remind on: " + val.dateTimeReminder + "</div>";
        read_lists_html+="</div>";

        read_lists_html+="</div>";
        // end div
        read_lists_html+="</div>";
    });

    read_lists_html+="</div>";

    // inject to 'page-content' of our app
    $("#page-content").html(read_lists_html);
}