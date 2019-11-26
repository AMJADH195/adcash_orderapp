
/**
------ COMMON JS FUNCTIONS FOR ORDER MANAGEMENT APP ------
**/




/**
 * function for reading order records
 */
function readRecords() {
    $.get("ajax/readRecords.php", {}, function (data, status) {     
        $(".records_content").html(data);                           
    });
}



/**
 * function for delete order
 */
function DeleteOrder(id) {
    var conf = confirm("Are you sure, do you really want to delete User?"); 
    if (conf == true) {                                             
        $.post("ajax/deleteOrder.php", {                             
                id: id                                              
            },
            function (data, status) {
                readRecords();                                      
            }
        );
    }
}



/**
 * READ recods on page load
 */
$(document).ready(function () {
    readRecords();  
    $("#search_text").keyup(function(){
        var txt=$(this).val();
        $.ajax({
           url:"ajax/search.php",
           method:"POST",
           data:{search:txt},
           success:function(data)
           {
            $(".records_content").html(data);
           }
          });

  });                                                    
});