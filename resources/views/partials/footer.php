    <footer class="footer">
        <div class="section wrapper footer__inner">
            <?php include __DIR__.'/../partials/social-icons.php'; ?>

            <nav class="footer__nav" aria-label="Footer">

                <a href="/imprint">Legal Notice</a>

                <a href="/privacy">Privacy Policy</a>

                <a href="https://github.com/pxlrbt/denniskoch.dev">Source</a>
            </nav>
        </div>
    </footer>

    <script>
        document.querySelectorAll('[data-tooltip]').forEach(el => {
            const tooltip = el.getAttribute('data-tooltip');
            el.style.setProperty('anchor-name', '--'+tooltip);
            el.querySelector('[popover]').style.setProperty('position-anchor', '--'+tooltip);
        });
    </script>
</body>

</html>
