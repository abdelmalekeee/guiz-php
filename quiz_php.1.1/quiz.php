<?php
session_start();

$questions = [
    1 => [
        'question' => 'Wie wordt vaak de "Queen Bey" genoemd?',
        'options' => ['Rihanna', 'Beyonce', 'Lady Gaga'],
        'answer' => 'Beyonce'
    ],
    2 => [
        'question' => 'Welke artiest is bekend van het album "Scorpion"?',
        'options' => ['Drake', 'Kanye West', 'The Weeknd'],
        'answer' => 'Drake'
    ],
    3 => [
        'question' => 'Wie zingt het lied "Shape of You"?',
        'options' => ['Justin Bieber', 'Ed Sheeran', 'Shawn Mendes'],
        'answer' => 'Ed Sheeran'
    ],
    4 => [
        'question' => 'Welke artiest bracht het album "21" uit?',
        'options' => ['Taylor Swift', 'Adele', 'Lorde'],
        'answer' => 'Adele'
    ],
    5 => [
        'question' => 'Welke rapper is bekend als "Slim Shady"?',
        'options' => ['Kendrick Lamar', 'Eminem', 'Jay-Z'],
        'answer' => 'Eminem'
    ]
];

$current_question = $_SESSION['current_question'] ?? 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_option = $_POST['option'] ?? '';
    $correct_answer = $questions[$current_question]['answer'];

    if ($selected_option === $correct_answer) {
        $_SESSION['score'] = ($_SESSION['score'] ?? 0) + 1;
    }

    if ($current_question < count($questions)) {
        $_SESSION['current_question']++;
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $total_questions = count($questions);
        $correct_answers = $_SESSION['score'] ?? 0;
        $incorrect_answers = $total_questions - $correct_answers;

        session_destroy();
        echo "<h1>Resultaat:</h1>";
        echo "<p>Je hebt $correct_answers van de $total_questions vragen goed.</p>";
        echo "<p>Je hebt $incorrect_answers van de $total_questions vragen fout.</p>";
        echo "<a href='" . $_SERVER['PHP_SELF'] . "'>Opnieuw proberen</a>";
        exit;
    }
}

$question_data = $questions[$current_question];
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artiesten Quiz</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Vraag <?= $current_question ?> van <?= count($questions) ?></h1>
    <p><?= htmlspecialchars($question_data['question']) ?></p>
    <form method="POST" action="">
        <?php foreach ($question_data['options'] as $option): ?>
            <label>
                <input type="radio" name="option" value="<?= htmlspecialchars($option) ?>" required>
                <?= htmlspecialchars($option) ?>
            </label><br>
        <?php endforeach; ?>
        <button type="submit">Volgende</button>
    </form>
</body>
</html>
