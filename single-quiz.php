<?php
/* Template Name: Quiz Page */
get_header();

// Hent quizen med titel 'Skydesikkerhed'
$args = array(
    'post_type' => 'quiz',
    'posts_per_page' => 1, // Hent kun en quiz (kan justeres efter behov)
    'post_title' => 'Skydesikkerhed' // Navnet på quizzen, som du leder efter
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();

        // Liste over alle spørgsmål
        $questions = [];

        for ($i = 1; $i <= 20; $i++) { // Juster antallet af spørgsmål her
            $group = get_field("question_{$i}_group");
            if ($group) {
                // Hent svar-gruppen
                $answers = isset($group['answers']) ? $group['answers'] : [];
        
                $questions[] = [
                    'text' => isset($group['text']) ? $group['text'] : '', // Hovedteksten for spørgsmålet
                    'image' => isset($group['image']) ? $group['image'] : '', // Hent billede
                    'video' => isset($group['video']) ? $group['video'] : '', // Hent video
                    'answers' => [
                        [
                            'text' => isset($answers['answer_1_text']) ? $answers['answer_1_text'] : '',
                            'is_correct' => isset($answers['answer_1_correct']) ? $answers['answer_1_correct'] : false,
                        ],
                        [
                            'text' => isset($answers['answer_2_text']) ? $answers['answer_2_text'] : '',
                            'is_correct' => isset($answers['answer_2_correct']) ? $answers['answer_2_correct'] : false,
                        ],
                        [
                            'text' => isset($answers['answer_3_text']) ? $answers['answer_3_text'] : '',
                            'is_correct' => isset($answers['answer_3_correct']) ? $answers['answer_3_correct'] : false,
                        ],
                        [
                            'text' => isset($answers['answer_4_text']) ? $answers['answer_4_text'] : '',
                            'is_correct' => isset($answers['answer_4_correct']) ? $answers['answer_4_correct'] : false,
                        ],
                    ],
                ];
            }
        }
        ?>
        
        <?php
        $hero_image = get_field('hero_image', get_the_ID());
        $hero_text = get_field('hero_text', get_the_ID());
        ?>

<div class="content">
<!-- Hero Section -->
<div class="hero-section" style="background-image: url('<?php echo esc_url($hero_image); ?>');">
    <div class="hero-text">
        <h1><?php echo esc_html($hero_text); ?></h1>
    </div>
</div>

</div>
</div>

<div id="quiz-container">
    <!-- Startside -->
    <div id="quiz-start">
        <div class="start-content">
            <h2 class="start-subtitle">Velkommen til sikkerhed under skydning</h2>
            <p class="start-description">Denne quiz vil teste din viden om sikkerhed før, under og efter skydning</p>
            <button id="start-button" class="start-button">Start Quiz</button>
        </div>
    </div>

    <!-- Quiz spørgsmål -->
    <div id="quiz-questions" style="display: none;">
        <form id="quiz-form">
            <?php foreach ($questions as $index => $question) : ?>
                <div class="question" data-question-index="<?php echo $index; ?>" style="display: <?php echo $index === 0 ? 'block' : 'none'; ?>;">
                    <h2><?php echo esc_html($question['text']); ?></h2>
                    <?php if ($question['image']) : ?>
                        <img src="<?php echo esc_url($question['image']); ?>" alt="Spørgsmål billede">
                    <?php endif; ?>
                    <?php if ($question['video']) : ?>
                        <video controls>
                            <source src="<?php echo esc_url($question['video']); ?>" type="video/mp4">
                            Din browser understøtter ikke video-tagget.
                        </video>
                    <?php endif; ?>
                    <ul>
                        <?php foreach ($question['answers'] as $answerIndex => $answer) : ?>
                            <li>
                                <label>
                                    <input type="checkbox" name="question_<?php echo $index; ?>[]" value="<?php echo $answerIndex; ?>" data-correct="<?php echo $answer['is_correct'] ? 'true' : 'false'; ?>">
                                    <?php echo esc_html($answer['text']); ?>
                                </label>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
            <div class="navigation">
                <button type="button" id="prev-button" style="display: none;">Forrige</button>
                <button type="button" id="next-button">Næste</button>
                <button type="submit" id="finish-button" style="display: none;">Afslut Quiz</button>
                <button id="restart-quiz" class="restart-button" style="display:none;">Start forfra</button>

            </div>
        </form>
        <div id="quiz-results" style="display: none;"></div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const startPage = document.getElementById('quiz-start');
    const quizQuestions = document.getElementById('quiz-questions');
    const startButton = document.getElementById('start-button');

    startButton.addEventListener('click', function () {
        startPage.style.display = 'none'; // Skjul startsiden
        quizQuestions.style.display = 'block'; // Vis quizzen

    });

    const questions = document.querySelectorAll('.question');
    const nextButton = document.getElementById('next-button');
    const prevButton = document.getElementById('prev-button');
    const finishButton = document.getElementById('finish-button');
    const resultsContainer = document.getElementById('quiz-results');
    let currentQuestion = 0;

    function showQuestion(index) {
        questions.forEach((q, i) => {
            q.style.display = i === index ? 'block' : 'none';
        });
        prevButton.style.display = index > 0 ? 'inline-block' : 'none';
        nextButton.style.display = index < questions.length - 1 ? 'inline-block' : 'none';
        finishButton.style.display = index === questions.length - 1 ? 'inline-block' : 'none';
    }

    nextButton.addEventListener('click', function () {
        if (currentQuestion < questions.length - 1) {
            currentQuestion++;
            showQuestion(currentQuestion);
        }
    });

    prevButton.addEventListener('click', function () {
        if (currentQuestion > 0) {
            currentQuestion--;
            showQuestion(currentQuestion);
        }
    });

    document.getElementById('quiz-form').addEventListener('submit', function (e) {
    e.preventDefault();

    let correctAnswers = 0;
    let totalQuestions = questions.length;

    questions.forEach((question, index) => {
        const selectedAnswers = question.querySelectorAll('input[type="checkbox"]:checked');
        let isCorrect = true;

        if (selectedAnswers.length === 0) {
            isCorrect = false;
        } else {
            selectedAnswers.forEach((answer) => {
                if (answer.dataset.correct !== 'true') {
                    isCorrect = false;
                }
            });
        }

        if (isCorrect) {
            correctAnswers++;
        }
    });

    resultsContainer.innerHTML = `
        <h2>Resultat</h2>
        <p>Du svarede korrekt på ${correctAnswers} ud af ${totalQuestions} spørgsmål.</p>
    `;
    resultsContainer.style.display = 'block';

    // Skjul afslut-knappen og vis start forfra-knappen
    finishButton.style.display = 'none';
    document.getElementById("restart-quiz").style.display = 'inline-block';

});
document.getElementById("restart-quiz").addEventListener("click", function () {
    // Naviger brugeren tilbage til forsiden af quizzen
    window.location.href = "http://sikkerhedunderskydning.local/quiz/"; // Erstat med den relevante URL
});

});


</script>


    <?php endwhile;
endif;
?>


</div>
<?php
get_footer(); // Indlæser footeren
?>

        
