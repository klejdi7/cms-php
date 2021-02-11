$( "#up_prices" ).click(function() {
  $( "#update_prices" ).toggle( "slow", function() {
  });
});

$( "#up_info" ).click(function() {
  $( "#update_info" ).toggle( "slow", function() {
  });
});

$('#type').on('change', function(){
  var type = $(this).children("option:selected").val();
  if(type == "Veshje"){
    $( "#shoes_size" ).slideUp( "slow", function() {
    });
  $( "#clothes_size" ).slideDown( "slow", function() {
  });
}
 else if(type == "Kepuce"){
   $( "#clothes_size" ).slideUp( "slow", function() {
   });
$( "#shoes_size" ).slideDown( "slow", function() {
});
}
});
