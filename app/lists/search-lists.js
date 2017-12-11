$(document).ready(function(){

    // when a 'search lists' button was clicked
    $(document).on('submit', '#search-list-form', function(){
        // get search keywords
        var keywords = $(this).find(":input[name='keywords']").val();

        // get data from the api based on search keywords
        $.getJSON("http://localhost/todolist/list/search.php?s=" + keywords, function(data){

            // template in lists.js
            readListsTemplate(data, keywords);

            // chage page title
            changePageTitle("Search Reminder: " + keywords);

            $('.list-search-keywords').val('');
            $('.list-search-keywords').text('');

        });

        // prevent whole page reload
        return false;
    });

});