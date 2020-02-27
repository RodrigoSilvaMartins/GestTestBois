$(document).ready(function () {
    var a_url = window.location.href.split('/');
    document.getElementById(a_url[a_url.length -1]).classList.add("active");
});