$(document).ready(function () {
    var a_url = window.location.href.split('/');
    document.getElementById(a_url[a_url.length -1]).classList.add("active");


});
function displayNewQuestion(){
    $('#questionModal').modal("show");
}
function editQuestion(questionId){
    $('#modal-title').html("Modifier question");

    var url = 'question/'+questionId+'/edit';

    $.ajax({
        type: 'get',
        url: url,
        datatype: 'html',
        success: function (data) {
            $('#dataModal').html(data);
            $('#dataModal').modal("show");
        }
    });

}
