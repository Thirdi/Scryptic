// JavaScript Document
$(document).ready(function(){
 
  $("img[src$=.png]").pngfix();
  $("#picker-color").hide();

  $('#dialog').jqm({trigger:'.jqModal'});
  var beginvalue =$("input#hiddenamount").val();
 
  $("#slider-range-min").slider({
      range: "min",
      value: beginvalue,
      min: 1,
      max: 100,
      slide: function(event, ui) {
        $("#amount").val( ui.value );
        var fadevalue = ui.value/100;
        $("#color2").fadeTo(0, fadevalue);
      }
  });
  $("#amount").val($("#slider-range-min").slider("value"));
 
 
  $.mask.definitions['r']='[cCeEaAdDFfbB0-9]';
  $("#color").mask("#rrrrrr",{placeholder:""});  
 
  $("#color2").css("background-color",$("input#color").val());
  $("#color2").css("opacity", beginvalue/100);
  var colorpicker = $.farbtastic('#picker');
  colorpicker.setColor($("input#color").val());
  colorpicker.linkTo(colordata);
  $("input#color").keyup(setcolorwheel);

  function setcolorwheel() {
    //alert($(this).val());
    var colornum = $(this).val();
    colorpicker.setColor(colornum);
    $("#color2").css("background-color",colornum);
  }
  
  function colordata() {
    //alert("here you go "+this.color);
    var colorvar = this.color;
  
    if(colorvar.length==7) {
      $("input#color").val(this.color);
      $("#color2").css("background-color",this.color);
    }
  }
  
  $("input#select,#color2").click(
    function () {
      $("#picker-color").fadeIn("normal"); 
    }
  
  );
  
  $("#color-close").click( 
    function () {
      $("#picker-color").fadeOut("fast"); 
    }
  );

});