// Anime Details Preview
$(document).ready(function(){ 

     $('a.tooltipEl, img.tooltipEl').tooltip({
      classes:{
       "ui-tooltip":"highlight"
      },
      position:{ my:'left center', at:'right+0 center'},
      content:function(result){
       $.post('/theme/6anime/pages/ajax.details.php', {
        animeid:$(this).attr('animeid')
       }, function(data){
        result(data);
       });
      }
     });
      
    });  


// Ajax Search Function

          // Send Search Text to the server
          $("#searching").on('keyup',function(){
            let searchText = $(this).val();
            if (searchText != "") {
              $.ajax({
                type: "get",
                url: "/ajax/search",
                data: {
                  query: searchText,
                },
                success: function (response) {
                  $("#search-suggest").html(response);
                },
              });
            } else {
              $("#search-suggest").html("");
            }
          });
          // Set searched text in input field on click of search button
        //   $(document).on("click", "a", function () {
        //     $("#searching").val($(this).text());
        //     $("#search-suggest").html("");
        //   });
