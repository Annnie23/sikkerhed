<?php
/* Template Name: Quiz Page */
get_header();

// Hent quizen med titel 'Opvask'
$args = array(
    'post_type' => 'quiz',
    'posts_per_page' => 1, // Hent kun en quiz (kan justeres efter behov)
    'post_title' => 'Opvask' // Navnet på quizzen, som du leder efter
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();

        // Liste over alle spørgsmål
        $questions = [];

        for ($i = 1; $i <= 5; $i++) { // Juster antallet af spørgsmål her
            $group = get_field("question_{$i}_group");
            if ($group) {
                // Hent svar-gruppen
                $answers = $group['answers']; 

                $questions[] = [
                    'text' => $group['text'], // Hovedteksten for spørgsmålet
                    'image' => $group['image'], // Hent billede
                    'video' => $group['video'], // Hent video
                    'answers' => [
                        [
                            'text' => $answers['answer_1_text'],
                            'is_correct' => $answers['answer_1_correct'],
                        ],
                        [
                            'text' => $answers['answer_2_text'],
                            'is_correct' => $answers['answer_2_correct'],
                        ],
                        [
                            'text' => $answers['answer_3_text'],
                            'is_correct' => $answers['answer_3_correct'],
                        ],
                    ],
                ];
            }
        }
        ?>

        <div id="quiz-container">
            <h1><?php the_title(); ?></h1>
            <form id="quiz-form">
                <?php foreach ($questions as $index => $question) : ?>
                    <div class="question">
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
                                        <input type="radio" name="question_<?php echo $index; ?>" value="<?php echo $answerIndex; ?>" data-correct="<?php echo $answer['is_correct'] ? 'true' : 'false'; ?>">
                                        <?php echo esc_html($answer['text']); ?>
                                    </label>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
                <button type="submit">Afslut Quiz</button>
            </form>
            <div id="quiz-results"></div>
        </div>

        <script>
        document.getElementById('quiz-form').addEventListener('submit', function (e) {
            e.preventDefault();

            // Find alle spørgsmål og brugerens svar
            const questions = document.querySelectorAll('.question');
            let correctAnswers = 0;
            let totalQuestions = questions.length;
            let feedback = ''; // To store the feedback for wrong answers

            questions.forEach((question, index) => {
                const selectedAnswer = question.querySelector('input[type="radio"]:checked');
                if (selectedAnswer) {
                    if (selectedAnswer.dataset.correct === 'true') {
                        correctAnswers++;
                    } else {
                        // Tilføj feedback for forkert svar
                        feedback += `<p>Spørgsmål ${index + 1}: Forkert svar.</p>`;
                    }
                }
            });

            // Vis resultatet til brugeren
            const resultContainer = document.getElementById('quiz-results');
            resultContainer.innerHTML = 
                `<h2>Resultat</h2>
                <p>Du svarede korrekt på ${correctAnswers} ud af ${totalQuestions} spørgsmål.</p>
                ${feedback}`;
            resultContainer.style.display = 'block';

            // Send data via POST uden JSON
            const formData = new FormData();
            formData.append('action', 'save_quiz_result');
            formData.append('score', correctAnswers);
            formData.append('total', totalQuestions);

            fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => console.log(data.message))
            .catch(error => console.error('Fejl:', error));
        });
        </script>

    <?php endwhile;
endif;

get_footer();
?>
