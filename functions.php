<?php
// Aktiver tema-funktioner
function sikkerhedunderskydning_setup() {
    // Understøt title-tag
    add_theme_support('title-tag');

    // Registrer menuer
    register_nav_menus(array(
        'primary' => __('Menu 1', 'sikkerhedunderskydning'),
    ));
}
add_action('after_setup_theme', 'sikkerhedunderskydning_setup');
?>


<?php
// Aktiver tema-stilark og scripts

function sikkerhedunderskydning_scripts() {
    // Tilføj tema-stilark
    wp_enqueue_style('sikkerhedunderskydning-style', get_stylesheet_uri());


}
add_action('wp_enqueue_scripts', 'sikkerhedunderskydning_scripts');

function enqueue_quiz_script_for_single() {
    if (is_single() && get_post_type() == 'quiz') {
        // Indlæs dit quiz script
        wp_enqueue_script('quiz-script', get_template_directory_uri() . '/js/quiz.js', array('jquery'), null, true);

        // Lokaliser AJAX URL til JavaScript
        wp_localize_script('quiz-script', 'quizAjax', array(
            'ajax_url' => admin_url('admin-ajax.php')
        ));
    }
}
add_action('wp_enqueue_scripts', 'enqueue_quiz_script_for_single');

?>

<?php
// Fjern gutenbergs blok-temaer

function sikkerhedunderskydning_remove_gutenberg() {
    remove_post_type_support("page", "editor");
    remove_post_type_support("post", "editor");
    remove_post_type_support("quizzer", "editor");
}
add_action("init", "sikkerhedunderskydning_remove_gutenberg");
?>

<?php
function create_quiz_post_type() {
    register_post_type('quiz',
        array(
            'labels' => array(
                'name' => __('Quizzer'),
                'singular_name' => __('Quiz'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'custom-fields'), // Tilføj støtte for editor og custom-fields
            'show_in_rest' => true, // Gør det tilgængeligt i Gutenberg editoren
            'rewrite' => array('slug' => 'quizzer'), // Tilpas URL-strukturen
        )
    );
}
add_action('init', 'create_quiz_post_type');
?>

<?php
// Gem brugerens quiz-resultater
function save_quiz_result() {
    // Tjek for gyldige data fra POST
    if (!isset($_POST['score']) || !isset($_POST['total'])) {
        wp_send_json_error(['message' => 'Ugyldige data.'], 400);
    }

    // Gem resultatet i databasen
    $quiz_result = [
        'score' => intval($_POST['score']),
        'total' => intval($_POST['total']),
        'timestamp' => current_time('mysql'),
    ];

    // Gem for gæstebrugere
    $guest_results = get_option('guest_quiz_results', []);
    $guest_results[] = $quiz_result;
    update_option('guest_quiz_results', $guest_results);

    wp_send_json_success(['message' => 'Resultatet er gemt!']);
}
add_action('wp_ajax_save_quiz_result', 'save_quiz_result');
add_action('wp_ajax_nopriv_save_quiz_result', 'save_quiz_result');


// Tilføj en menu-side til quiz-statistik
function add_quiz_statistics_page() {
    add_menu_page(
        'Quiz Statistik',
        'Quiz Statistik',
        'manage_options',
        'quiz-statistics',
        'render_quiz_statistics_page',
        'dashicons-chart-bar',
        20
    );
}
add_action('admin_menu', 'add_quiz_statistics_page');

// Admin-side indhold
function render_quiz_statistics_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    $user_results = [];
    $guest_results = get_option('guest_quiz_results', []);  // Hent gæsternes resultater

    // Hent data fra registrerede brugere (hvis du havde brugere)
    $users = get_users();
    foreach ($users as $user) {
        $results = get_user_meta($user->ID, 'quiz_result', false);
        $user_results = array_merge($user_results, $results);
    }

    // Kombiner brugeres og gæsters resultater
    $all_results = array_merge($user_results, $guest_results);

    // Beregn statistik
    $total_attempts = count($all_results);
    $total_score = array_sum(array_column($all_results, 'score'));
    $average_score = $total_attempts > 0 ? $total_score / $total_attempts : 0;

    echo '<div class="wrap">';
    echo '<h1>Quiz Statistik</h1>';
    echo '<p>Total antal besvarelser: ' . esc_html($total_attempts) . '</p>';
    echo '<p>Gennemsnitlig score: ' . esc_html(round($average_score, 2)) . '</p>';
    echo '<h2>Detaljerede resultater:</h2>';
    echo '<table class="widefat">';
    echo '<thead><tr><th>Bruger</th><th>Score</th><th>Total</th><th>Tidspunkt</th></tr></thead><tbody>';

    foreach ($all_results as $result) {
        echo '<tr>';
        echo '<td>' . (isset($result['user']) ? esc_html($result['user']) : 'Gæst') . '</td>';
        echo '<td>' . esc_html($result['score']) . '</td>';
        echo '<td>' . esc_html($result['total']) . '</td>';
        echo '<td>' . esc_html($result['timestamp']) . '</td>';
        echo '</tr>';
    }

    echo '</tbody></table>';
    echo '</div>';
}

