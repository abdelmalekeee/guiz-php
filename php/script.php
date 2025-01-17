<?php
include 'database.php';

session_start();

if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}

if (isset($_POST['submit'])) {
    $selected_answer = $_POST['answer'];
    $correct_answer = $_POST['correct_answer'];

    if ($selected_answer == $correct_answer) {
        $_SESSION['score']++;
        $feedback = "Correct!";
        $highlight = "correct";
    } else {
        $feedback = "Incorrect! The correct answer was: " . $correct_answer;
        $highlight = "incorrect";
    }
}

$questions = [];
$query = "SELECT * FROM questions"; // Assuming a table named 'questions'
$result = $connect->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
}

if (count($questions) > 0) {
    $current_question = $questions[0]; // Display the first question
    // Display question and answers here
    echo "<h2>" . $current_question['question'] . "</h2>";
    echo "<form method='POST'>";
    foreach (json_decode($current_question['answers']) as $answer) {
        $class = (isset($highlight) && $answer == $correct_answer) ? 'correct' : '';
        echo "<input type='radio' name='answer' value='$answer' class='$class'> $answer<br>";
    }
    echo "<input type='hidden' name='correct_answer' value='" . $current_question['correct_answer'] . "'>";
    echo "<input type='submit' name='submit' value='Submit'>";
    echo "</form>";
    
    if (isset($feedback)) {
        echo "<div class='$highlight'>$feedback</div>";
    }
} else {
    echo "No questions available.";
}

if (isset($_POST['submit'])) {
    echo "Your score: " . $_SESSION['score'];
    session_destroy(); // Reset the session for a new quiz
}
?>
