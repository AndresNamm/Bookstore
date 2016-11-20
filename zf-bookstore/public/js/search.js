$(document).ready(
        function () {

           $("#searchButton").click(function () {
                var searchbox = $("#searchBox").val();
                var dataString = 'searchword=' + searchbox;
               


                if (searchbox == '') {
                    var dataString = 'searchword=' + 'q';
                }


                $(".mainArticle").load("/books/search/", dataString, function (responseTxt, statusTxt, xhr) {
                    if (statusTxt == "success")
                       { initialize(); }
                    if (statusTxt == "error")
                        alert("Error: " + xhr.status + ": " + xhr.statusText);
                }
                );
                return false;
            });
            
         
            
        });

function initialize(){
     $("#myTable").tablesorter({
    theme: 'blue',
    // initialize zebra striping of the table
    widgets: ["zebra"],
    // change the default striping class names
    // updated in v2.1 to use widgetOptions.zebra = ["even", "odd"]
    // widgetZebra: { css: [ "normal-row", "alt-row" ] } still works
    widgetOptions : {
      zebra : [ "normal-row", "alt-row" ]
    }
    
    
  });
}