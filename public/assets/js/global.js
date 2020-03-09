$(document).ready(function () {
    var a_url = window.location.href.split('/');
    document.getElementById(a_url[a_url.length - 1]).classList.add("active");


});

function displayNewQuestion() {
    $('#newQuestionModal').modal("show");
}


function displayEditQuestion(questionId) {
    var url = 'question/' + questionId + '/edit';
    $.ajax({
        type: 'get',
        url: url,
        datatype: 'html',
        success: function (data) {
            $('#editQuestionModal').html(data);
            $('#editQuestionModal').modal("show");
        }
    })
}

function hideEditQuestion() {
    $('#editQuestionModal').html();
    $('#editQuestionModal').modal("hide");
}
function hideNewQuestion() {
    $('#newQuestionModal').modal("hide");
}