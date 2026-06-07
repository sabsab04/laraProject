document.addEventListener('DOMContentLoaded', function() {
    
    // Peschiamo i tasti e la sezione dalla pagina
    const linkHome = document.querySelector('.link-home');
    const linkChiSiamo = document.querySelector('.link-chi-siamo');
    const sectionChiSiamo = document.getElementById('chi-siamo');

    // Eseguiamo lo script SOLO se siamo sulla Home (dove esiste la sezione chi-siamo)
    if (sectionChiSiamo && linkHome && linkChiSiamo) {
        
        function controllaScorrimento() {
            // Calcoliamo a che distanza si trova la sezione "Chi siamo" dalla cima dello schermo
            const distanzaDallaCima = sectionChiSiamo.getBoundingClientRect().top;
            
            // Se la sezione si è avvicinata alla cima (meno di 300px)
            if (distanzaDallaCima < 300) {
                linkHome.classList.remove('active');
                linkChiSiamo.classList.add('active');
            } else {
                // Altrimenti siamo tornati in alto, riaccendiamo la Home
                linkChiSiamo.classList.remove('active');
                linkHome.classList.add('active');
            }
        }

        // Controlla subito al caricamento (nel caso tu arrivi dalla pagina "Dove siamo")
        controllaScorrimento();

        // Controlla ogni volta che muovi la rotellina del mouse
        window.addEventListener('scroll', controllaScorrimento);
    }
});