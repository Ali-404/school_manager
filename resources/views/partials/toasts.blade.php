<div id="toast-container"
    style="position:fixed;top:20px;right:20px;z-index:1060;display:flex;flex-direction:column;gap:10px;pointer-events:none">
</div>

<style>
    .app-toast {
        pointer-events: auto;
        min-width: 220px;
        max-width: 360px;
        padding: 12px 14px;
        border-radius: 8px;
        color: #fff;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        opacity: 0;
        transform: translateY(-8px);
        transition: all .28s ease
    }

    .app-toast.show {
        opacity: 1;
        transform: translateY(0)
    }

    .app-toast.success {
        background: #198754
    }

    .app-toast.error {
        background: #dc3545
    }

    .app-toast.info {
        background: #0d6efd
    }

    .app-toast.warning {
        background: #ffc107;
        color: #000
    }
</style>

<script>
    (function () {
        function showToast(msg, type = 'info', timeout = 4000) {
            if (!msg) return;
            var c = document.getElementById('toast-container');
            var el = document.createElement('div');
            el.className = 'app-toast ' + type;
            el.textContent = msg;
            c.appendChild(el);
            // enter
            requestAnimationFrame(function () { el.classList.add('show') });
            // remove after timeout
            setTimeout(function () { el.classList.remove('show'); setTimeout(function () { el.remove() }, 300) }, timeout);
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Laravel session flashes
            @if(session('success'))
                showToast(@json(session('success')), 'success');
            @endif
            @if(session('error'))
                showToast(@json(session('error')), 'error');
            @endif
            @if(session('warning'))
                showToast(@json(session('warning')), 'warning');
            @endif
            @if(session('info'))
                showToast(@json(session('info')), 'info');
            @endif

            @if($errors->any())
                @foreach($errors->all() as $e)
                    showToast(@json($e), 'error', 6000);
                @endforeach
            @endif
        });

        window.appShowToast = showToast; // expose
    })();
</script>