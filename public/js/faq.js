function toggleQuestions(sectionId) {
    var questions = document.getElementById(sectionId);
    if (questions.style.display === "none") {
        questions.style.display = "block";
    } else {
        questions.style.display = "none";
    }
}

function showAnswer(answerId) {
    var answer = document.getElementById(answerId);
    if (answer.style.display === "none") {
        answer.style.display = "block";
    } else {
        answer.style.display = "none";
    }
}
