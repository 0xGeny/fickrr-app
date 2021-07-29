$(document).ready(function(){
    $('#attr_field_type').on('change', function() {
      if ( this.value == 'multi-select')
      {
        $("#attri_values").show();
      }
      else if ( this.value == 'single-select')
      {
        $("#attri_values").show();
      }
	  else
	  {
		$("#attri_values").hide();   
	  }
    });
});
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}