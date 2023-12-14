$(document).ready(function() {
    // Disable submit button by default
    $('button[name="submitanswer"]').prop('disabled', true);
  
    // Function to check if all questions are answered
    function checkQuestions() {
      var allAnswered = true;
  
      // Check radio button groups for Citizen Charter questions
      $('input[name^="answers["]').each(function() {
        var groupName = $(this).attr('name');
        if ($('input[name="' + groupName + '"]:checked').length === 0) {
          allAnswered = false;
          return false; // exit the loop if any question is not answered
        }
      });
  
      // Check radio button groups for Survey Question
      $('input[name^="question_"]').each(function() {
        if ($('input[name="' + $(this).attr('name') + '"]:checked').length === 0) {
          allAnswered = false;
          return false; // exit the loop if any question is not answered
        }
      });
  
      return allAnswered;
    }
  
    // Enable/disable submit button based on answers
    $('input[name^="answers["], input[name^="question_"]').on('change', function() {
      if (checkQuestions()) {
        $('button[name="submitanswer"]').prop('disabled', false);
      } else {
        $('button[name="submitanswer"]').prop('disabled', true);
      }
    });
  });