<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>
    
    /* Inclusione del font per il footer, anche se idealmente dovrebbe essere globale */
    @import url('https://fonts.googleapis.com/css2?family=IM+Fell+Double+Pica&display=swap');

    
    .medieval-font-footer {
        font-family: 'IM Fell Double Pica', serif; 
        font-weight: 400;
        color: #ddd; /* Testo grigio chiaro per contrasto */
    }
    
    .footer-custom {
        background-color: #212529; /* Sfondo scuro (bg-dark di Bootstrap) */
        padding: 20px 0;
        border-top: 3px solid #ffc107; /* Bordino giallo/arancione di Bootstrap (warning) */
        color: white;
    }

    .footer-link {
        color: #ffc107 !important; /* Testo giallo/arancione per i link */
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .footer-link:hover {
        color: #fff !important; /* Bianco al passaggio del mouse */
    }
    
    .social-icon {
        font-size: 1.5rem;
        margin: 0 10px;
    }
</style>

<footer class="footer-custom">
    <div class="container">
        <div class="row text-center text-md-start align-items-center">
            
            {{-- Indirizzo Immaginario (Sinistra) --}}
            <div class="col-md-4 mb-3 mb-md-0">
                <p class="medieval-font-footer mb-0">
                    <i class="bi bi-geo-alt-fill text-warning me-2"></i> 
                    Via delle Storie Infinite, 12 - 00100 Roma (RM)
                </p>
            </div>
            
            {{-- Link Navigazione (Centro) --}}
            <div class="col-md-4 mb-3 mb-md-0 text-center">
                <a href="#" class="footer-link medieval-font-footer mx-2">Chi siamo</a> | 
                <a href="#" class="footer-link medieval-font-footer mx-2">Privacy</a> | 
                <a href="#" class="footer-link medieval-font-footer mx-2">Contatti</a>
            </div>
            
            {{-- Icone Social (Destra) --}}
            <div class="col-md-4 text-center text-md-end">
                <a href="#" class="footer-link social-icon" aria-label="Facebook">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="#" class="footer-link social-icon" aria-label="Twitter">
                    <i class="bi bi-twitter"></i>
                </a>
                <a href="#" class="footer-link social-icon" aria-label="Instagram">
                    <i class="bi bi-instagram"></i>
                </a>
            </div>
            
        </div>
        <hr class="border-secondary mt-3 mb-2">
        <div class="text-center">
            <small class="text-secondary medieval-font-footer">© {{ date('Y') }} La Tana del Libro. Tutti i diritti riservati.</small>
        </div>
    </div>
</footer>