<?php
/* Template Name: Sikland */
get_header(); // Indlæser headeren
?>


<!-- Hero Section -->
<div class="hero-section" style="background-image: url('<?php echo esc_url(get_field('hero_image')); ?>');">
        <div class="hero-text">
            <h1><?php echo esc_html(get_field('hero_text')); ?></h1>
        </div>
    </div>

    <div class="sik-section">

<!-- Kapitler -->
<div id="kapitel-1" class="chapter">
    <h2><?php echo esc_html(get_field('overskrift_kapitel_1')); ?></h2>
    <p><?php echo esc_html(get_field('tekst_kapitel_1_1')); ?></p>
    <br>
    <p><?php echo esc_html(get_field('tekst_kapitel_1_2')); ?></p>
    <br>
    <p><?php echo esc_html(get_field('tekst_kapitel_1_3')); ?></p>
</div>

<div id="kapitel-2" class="chapter">
    <h2><?php echo esc_html(get_field('overskrift_kapitel_2')); ?></h2>
    <p><?php echo esc_html(get_field('tekst_kapitel_2_1')); ?></p>
    <br>
    <p><?php echo esc_html(get_field('tekst_kapitel_2_2')); ?></p>
    <br>
    <p><?php echo esc_html(get_field('tekst_kapitel_2_3')); ?></p>
</div>

<div id="kapitel-3" class="chapter">
    <h2><?php echo esc_html(get_field('overskrift_kapitel_3')); ?></h2>
    <p><?php echo esc_html(get_field('tekst_kapitel_3_1')); ?></p>
    <br>
    <p><?php echo esc_html(get_field('tekst_kapitel_3_2')); ?></p>
    <br>
    <p><?php echo esc_html(get_field('tekst_kapitel_3_3')); ?></p>
</div>

<div id="kapitel-4" class="chapter">
    <h2><?php echo esc_html(get_field('overskrift_kapitel_4')); ?></h2>
    <p><?php echo esc_html(get_field('tekst_kapitel_4_1')); ?></p>
    <br>
    <p><?php echo esc_html(get_field('tekst_kapitel_4_2')); ?></p>
    <br>
    <p><?php echo esc_html(get_field('tekst_kapitel_4_3')); ?></p>
</div>

<div id="kapitel-5" class="chapter">
    <h2><?php echo esc_html(get_field('overskrift_kapitel_5')); ?></h2>
    <p><?php echo esc_html(get_field('tekst_kapitel_5_1')); ?></p>
    <br>
    <p><?php echo esc_html(get_field('tekst_kapitel_5_2')); ?></p>
    <br>
    <p><?php echo esc_html(get_field('tekst_kapitel_5_3')); ?></p>
</div>

<div id="kapitel-6" class="chapter">
    <h2><?php echo esc_html(get_field('overskrift_kapitel_6')); ?></h2>
    <p><?php echo esc_html(get_field('tekst_kapitel_6_1')); ?></p>
    <br>
    <p><?php echo esc_html(get_field('tekst_kapitel_6_2')); ?></p>
    <br>
    <p><?php echo esc_html(get_field('tekst_kapitel_6_3')); ?></p>
</div>

<div id="kapitel-7" class="chapter">
    <h2><?php echo esc_html(get_field('overskrift_kapitel_7')); ?></h2>
    <p><?php echo esc_html(get_field('tekst_kapitel_7_1')); ?></p>
    <br>
    <p><?php echo esc_html(get_field('tekst_kapitel_7_2')); ?></p>
    <br>
    <p><?php echo esc_html(get_field('tekst_kapitel_7_3')); ?></p>
</div>

<div id="kapitel-8" class="chapter">
    <h2><?php echo esc_html(get_field('overskrift_kapitel_8')); ?></h2>
    <p><?php echo esc_html(get_field('tekst_kapitel_8_1')); ?></p>
    <br>
    <p><?php echo esc_html(get_field('tekst_kapitel_8_2')); ?></p>
    <br>
    <p><?php echo esc_html(get_field('tekst_kapitel_8_3')); ?></p>
</div>





</div>


<?php
get_footer(); // Indlæser footeren
?>
