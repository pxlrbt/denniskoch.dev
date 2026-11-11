    </main>

    <footer class="footer">
        <div class="section wrapper footer__inner">
            <?php include __DIR__.'/../partials/social-icons.php'; ?>

            <nav class="footer__nav" aria-label="Footer">

                <a href="https://pixelarbeit.de">Hire Me</a>

                <a href="/imprint/">Legal Notice</a>

                <a href="/privacy/">Privacy Policy</a>

                <a href="https://github.com/pxlrbt/denniskoch.dev">Source</a>
            </nav>
        </div>

        <p class="wrapper" style="padding-block: .75rem; text-align: center; font-size: var(--text-sm);">
            Developed and hosted in Germany by <a href="https://pixelarbeit.de" style="text-decoration: underline;">pixelarbeit</a>
        </p>
    </footer>

    <script src="/assets/main.js?v=<?= filemtime(__DIR__.'/../../../public/assets/main.js') ?>" defer></script>
</body>

</html>
