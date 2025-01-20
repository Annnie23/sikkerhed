<div id="scrollToTop">
<img src="http://sikkerhedunderskydning.local/wp-content/uploads/2025/01/arrow-1.png" alt="Til toppen">
</div>


<div class="footer">
    <div class="footer-links">
        <a href="/index.php">Forside</a>
        <a href="/sikland">SIKLAND</a>
        <a href="/skydebaner">Skydebaner</a>
        <a href="/quiz">Tag testen</a>
    </div>

    <div class="footer-text">
        &copy; <?php echo date("Y"); ?> Skydevåbeninspektoratet - Dansk Artilleri Regiment. Alle rettigheder forbeholdes.
    </div>
</div>

<script>
    // Viser eller skjuler knappen baseret på scroll-position
    window.addEventListener('scroll', () => {
        const scrollToTop = document.getElementById('scrollToTop');
        if (window.scrollY > 200) {
            scrollToTop.style.display = 'block';
        } else {
            scrollToTop.style.display = 'none';
        }
    });

    // Scroller til toppen af siden, når man klikker på knappen
    document.getElementById('scrollToTop').addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth' // Gør scroll-animeringen glidende
        });
    });
</script>


<?php wp_footer(); ?>
</body>
</html>