<!-- resources/views/components/footer.blade.php -->
<footer class="py-5" style="background-color: #121212; color: #E5E5E5;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <h5 style="color: #8F00FF;">EventMgr</h5>
                <p style="color: #E5E5E5; opacity: 0.8;">Your one-stop solution for event management.</p>
                <div class="mt-3">
                    <a href="#" class="text-decoration-none me-3" style="color: #00F6FF;">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="text-decoration-none me-3" style="color: #00F6FF;">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                    <a href="#" class="text-decoration-none me-3" style="color: #00F6FF;">
                        <i class="bi bi-instagram"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <h5 style="color: #8F00FF;">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('home') }}" class="text-decoration-none"
                            style="color: #E5E5E5; transition: color 0.3s;" onmouseover="this.style.color='#00F6FF'"
                            onmouseout="this.style.color='#E5E5E5'">
                            Home
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('about') }}" class="text-decoration-none"
                            style="color: #E5E5E5; transition: color 0.3s;" onmouseover="this.style.color='#00F6FF'"
                            onmouseout="this.style.color='#E5E5E5'">
                            About Us
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('pricing') }}" class="text-decoration-none"
                            style="color: #E5E5E5; transition: color 0.3s;" onmouseover="this.style.color='#00F6FF'"
                            onmouseout="this.style.color='#E5E5E5'">
                            Pricing
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-decoration-none" style="color: #E5E5E5; transition: color 0.3s;"
                            onmouseover="this.style.color='#00F6FF'" onmouseout="this.style.color='#E5E5E5'">
                            Contact
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5 style="color: #8F00FF;">Contact</h5>
                <address style="color: #E5E5E5; opacity: 0.8;">
                    123 Event Street<br>
                    Event City, EC 12345<br>
                    <abbr title="Phone" style="color: #8F00FF;">P:</abbr> (123) 456-7890<br>
                    <abbr title="Email" style="color: #8F00FF;">E:</abbr> info@eventmgr.com
                </address>
                <div class="mt-3">
                    <button class="btn btn-sm" style="background-color: #8F00FF; color: white;"
                        onmouseover="this.style.backgroundColor='#00F6FF'; this.style.color='#121212'"
                        onmouseout="this.style.backgroundColor='#8F00FF'; this.style.color='white'">
                        Subscribe to Newsletter
                    </button>
                </div>
            </div>
        </div>
        <hr style="border-color: rgba(229, 229, 229, 0.1);">
        <div class="text-center pt-3" style="color: #E5E5E5; opacity: 0.6;">
            &copy; {{ date('Y') }} EventMgr. All rights reserved.
            <span class="d-block d-md-inline">|</span>
            <a href="#" class="text-decoration-none ms-md-2" style="color: #E5E5E5; opacity: 0.8;">Privacy Policy</a>
            <span>•</span>
            <a href="#" class="text-decoration-none" style="color: #E5E5E5; opacity: 0.8;">Terms of Service</a>
        </div>
    </div>
</footer>