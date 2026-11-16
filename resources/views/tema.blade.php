
<style>
    body,
    body * {
        transition: background-color .2s ease, color .2s ease;
    }

    body.dark-mode {
        background-color: #0f172a !important;
        color: #e2e8f0 !important;
    }

    body.dark-mode .bg-white {
        background-color: #1e293b !important;
    }

    body.dark-mode .text-slate-800,
    body.dark-mode .text-slate-700,
    body.dark-mode .text-gray-800 {
        color: #e2e8f0 !important;
    }

    body.dark-mode input,
    body.dark-mode textarea,
    body.dark-mode select {
        background-color: #334155;
        color: #f8fafc;
        border-color: #475569;
    }

    

#tombolTema {
    position: static;
    border: 1px solid #cbd5e1;
    border-radius: 20px;
    padding: 7px 12px;
    font-size: 12px;
    white-space: nowrap;
    background: white;
    color: #1e293b;
    cursor: pointer;
    font-weight: 600;
    box-shadow: 0 2px 6px #00000010;
    flex-shrink: 0;
}

body.dark-mode #tombolTema {
    background: #334155;
    color: white;
    border-color: #475569;
}


</style>

<button id="tombolTema" type="button">🌙 Mode Gelap</button>

<script>
(function () {
    const tombol = document.getElementById('tombolTema');

    function aturTema() {
        const gelap = localStorage.getItem('sipbarang-tema') === 'gelap';
        document.body.classList.toggle('dark-mode', gelap);
        tombol.textContent = gelap
            ? '☀️ Mode Terang'
            : '🌙 Mode Gelap';
    }

    aturTema();

    tombol.addEventListener('click', function () {
        const gelap = !document.body.classList.contains('dark-mode');

        localStorage.setItem(
            'sipbarang-tema',
            gelap ? 'gelap' : 'terang'
        );

        aturTema();
    });
})();
</script>
