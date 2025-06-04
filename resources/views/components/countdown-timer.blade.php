<div class="py-4" style="background-color: #121212; border-top: 1px solid #8F00FF; border-bottom: 1px solid #8F00FF;">
    <div class="container text-center">
        <h5 class="mb-3" style="color: #00F6FF; text-transform: uppercase; letter-spacing: 2px;">
            <i class="bi bi-lightning-charge-fill me-2"></i>Next Big Event Starts In:
        </h5>
        <div id="countdown" class="d-flex justify-content-center"
            style="font-family: 'Orbitron', sans-serif; font-weight: 700;">
            <div class="countdown-box mx-1">
                <span id="countdown-days" style="color: #8F00FF;">00</span>
                <small style="color: #E5E5E5; opacity: 0.7;">days</small>
            </div>
            <div class="countdown-separator" style="color: #00F6FF;">:</div>
            <div class="countdown-box mx-1">
                <span id="countdown-hours" style="color: #8F00FF;">00</span>
                <small style="color: #E5E5E5; opacity: 0.7;">hours</small>
            </div>
            <div class="countdown-separator" style="color: #00F6FF;">:</div>
            <div class="countdown-box mx-1">
                <span id="countdown-minutes" style="color: #8F00FF;">00</span>
                <small style="color: #E5E5E5; opacity: 0.7;">minutes</small>
            </div>
            <div class="countdown-separator" style="color: #00F6FF;">:</div>
            <div class="countdown-box mx-1">
                <span id="countdown-seconds" style="color: #8F00FF;">00</span>
                <small style="color: #E5E5E5; opacity: 0.7;">seconds</small>
            </div>
        </div>
        <button id="register-btn" class="btn mt-3 px-4 py-2"
            style="background-color: #8F00FF; color: white; border: none; transition: all 0.3s;"
            onmouseover="this.style.backgroundColor='#00F6FF'; this.style.color='#121212'"
            onmouseout="this.style.backgroundColor='#8F00FF'; this.style.color='white'">
            Register Now <i class="bi bi-arrow-right ms-2"></i>
        </button>
    </div>
</div>

<script>
    // Set the target date and time (format: YYYY-MM-DDTHH:MM:SS)
    const targetDate = new Date("2025-06-15T00:00:00").getTime();

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = targetDate - now;

        if (distance < 0) {
            document.getElementById("countdown").innerHTML =
                '<span style="color: #FF4F81; font-size: 1.5rem;">The event has started! Join now!</span>';
            document.getElementById("register-btn").textContent = "Join Event";
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Update each element separately for better animation control
        document.getElementById("countdown-days").textContent = days.toString().padStart(2, '0');
        document.getElementById("countdown-hours").textContent = hours.toString().padStart(2, '0');
        document.getElementById("countdown-minutes").textContent = minutes.toString().padStart(2, '0');
        document.getElementById("countdown-seconds").textContent = seconds.toString().padStart(2, '0');

        // Add pulse animation to seconds for urgency
        if (seconds % 2 === 0) {
            document.getElementById("countdown-seconds").style.color = "#8F00FF";
        } else {
            document.getElementById("countdown-seconds").style.color = "#00F6FF";
        }
    }

    // Run once immediately
    updateCountdown();

    // Then update every second
    setInterval(updateCountdown, 1000);

    // Add click event to register button
    document.getElementById("register-btn").addEventListener("click", function () {
        // Replace with your actual registration link
        window.location.href = "/register";
    });
</script>

<style>
    /* Add this to your CSS file or in a style tag */
    .countdown-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 70px;
    }

    .countdown-box span {
        font-size: 2.5rem;
        line-height: 1;
        transition: color 0.3s;
    }

    .countdown-separator {
        font-size: 2rem;
        display: flex;
        align-items: center;
        padding-bottom: 1rem;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
    }

    @media (max-width: 768px) {
        .countdown-box span {
            font-size: 1.8rem;
        }

        .countdown-separator {
            font-size: 1.5rem;
            padding-bottom: 0.8rem;
        }
    }
</style>