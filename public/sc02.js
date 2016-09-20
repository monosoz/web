var p_id;

function customize(id, name) {
  document.getElementById('custom-title').innerHTML = 'Customize - ' + name;
  $('#custom-id').val(id);
  document.getElementById("custom-img").src='/img/items/' + id +'.png';
}
$(document).ready(function(e) {
  
});