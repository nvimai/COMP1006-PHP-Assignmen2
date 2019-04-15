// Credit to Kapil at https://stackoverflow.com/questions/35427641/how-to-dynamically-set-the-active-class-in-bootstrap-navbar/35428555
// Add the "active" to the class of nav-link element
$(document).ready(function () {
  var url = window.location;
  $('ul.navbar-nav a[href="'+ url +'"]').parent().addClass('active');
  $('ul.navbar-nav a').filter(function() {
    return this.href == url;
  }).parent().addClass('active');
});