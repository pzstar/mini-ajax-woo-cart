(function () {
    var root = document.querySelector('.majc-sale');
    if (!root) {
        return;
    }

    var button = root.querySelector('.majc-sale-button');
    var panel = root.querySelector('.majc-sale-panel');
    var overlay = root.querySelector('.majc-sale-overlay');

    function setOpen(open) {
        if (open) {
            panel.hidden = false;
            overlay.hidden = false;
            // Next frame, so the slide-in transition runs.
            window.requestAnimationFrame(function () {
                root.classList.add('is-open');
            });
            root.querySelector('.majc-sale-close').focus();
        } else {
            root.classList.remove('is-open');
            window.setTimeout(function () {
                if (!root.classList.contains('is-open')) {
                    panel.hidden = true;
                    overlay.hidden = true;
                }
            }, 300);
            button.focus();
        }
        button.setAttribute('aria-expanded', open ? 'true' : 'false');
    }

    button.addEventListener('click', function () {
        setOpen(!root.classList.contains('is-open'));
    });

    overlay.addEventListener('click', function () {
        setOpen(false);
    });

    root.querySelector('.majc-sale-close').addEventListener('click', function () {
        setOpen(false);
    });

    document.addEventListener('keydown', function (e) {
        if ('Escape' === e.key && root.classList.contains('is-open')) {
            setOpen(false);
        }
    });
})();
