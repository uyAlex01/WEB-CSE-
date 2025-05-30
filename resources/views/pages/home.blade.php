@extends('layouts.app')

@section('title', 'Home - Rhythmx')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    /* Color Variables */
    :root {
        --electric-violet: #8F00FF;
        --jet-black: #121212;
        --neon-aqua: #00F6FF;
        --platinum-gray: #E5E5E5;
        --sunset-coral: #FF4F81;
        --deep-purple: #2A0B45;
        --space-blue: #0F1A2F;
    }

    /* Base Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        color: var(--platinum-gray);
        /* Animated Gradient Background */
        background: linear-gradient(-45deg,
                var(--deep-purple),
                var(--space-blue),
                var(--jet-black),
                var(--deep-purple));
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
        overflow-x: hidden;
    }

    @keyframes gradientBG {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    /* Main Container */
    .main-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 6rem 1rem 3rem;
        text-align: center;
        max-width: 72rem;
        margin: 0 auto;
        min-height: 100vh;
        position: relative;
        z-index: 2;
    }

    /* Typography */
    .heading {
        font-size: clamp(1.875rem, 5vw, 2.25rem);
        font-weight: 800;
        background-image: linear-gradient(to right,
                var(--electric-violet),
                var(--neon-aqua),
                var(--electric-violet));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 0.5rem;
        animation: pulseGlow 3s ease-in-out infinite alternate;
    }

    @keyframes pulseGlow {
        0% {
            text-shadow: 0 0 5px rgba(143, 0, 255, 0.3);
        }

        100% {
            text-shadow: 0 0 20px rgba(0, 246, 255, 0.5);
        }
    }

    .highlight {
        color: var(--neon-aqua);
    }

    .subheading {
        color: var(--platinum-gray);
        font-size: clamp(0.875rem, 3vw, 1rem);
        line-height: 1.5;
        margin-bottom: 2rem;
        max-width: 36rem;
    }

    /* Search Form */
    .search-form {
        width: 100%;
        max-width: 72rem;
        padding: 1.5rem;
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
        border-radius: 0.5rem;
        border: 1px solid rgba(143, 0, 255, 0.3);
        background: linear-gradient(to right,
                rgba(143, 0, 255, 0.2),
                rgba(0, 246, 255, 0.2),
                rgba(143, 0, 255, 0.2));
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3),
            0 10px 10px -5px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    @media (min-width: 768px) {
        .search-form {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* Form Elements */
    .form-group {
        display: flex;
        flex-direction: column;
        text-align: left;
    }

    .form-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--neon-aqua);
        margin-bottom: 0.25rem;
    }

    .form-input {
        border: 1px solid var(--electric-violet);
        border-radius: 0.375rem;
        padding: 0.75rem;
        font-size: 0.875rem;
        background-color: rgba(18, 18, 18, 0.7);
        color: var(--platinum-gray);
        width: 100%;
        transition: all 0.2s ease;
    }

    .form-input::placeholder {
        color: rgba(229, 229, 229, 0.5);
    }

    .form-input:focus {
        outline: none;
        border-color: var(--neon-aqua);
        box-shadow: 0 0 0 2px rgba(0, 246, 255, 0.3);
    }

    /* Date Input */
    .date-input-wrapper {
        position: relative;
    }

    .date-icon {
        position: absolute;
        top: 50%;
        right: 0.75rem;
        transform: translateY(-50%);
        color: var(--neon-aqua);
        pointer-events: none;
    }

    /* Submit Button */
    .submit-btn {
        grid-column: 1 / -1;
        background: linear-gradient(to right,
                var(--electric-violet),
                var(--neon-aqua));
        color: var(--jet-black);
        font-weight: 600;
        font-size: 0.875rem;
        border-radius: 0.375rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .submit-btn:hover {
        background: linear-gradient(to right,
                rgba(143, 0, 255, 0.9),
                rgba(0, 246, 255, 0.9));
        transform: scale(1.02);
        box-shadow: 0 0 15px rgba(0, 246, 255, 0.4);
    }

    /* Responsive Adjustments */
    @media (max-width: 767px) {
        .main-container {
            padding: 5rem 1rem 2rem;
        }

        .search-form {
            padding: 1.25rem;
            gap: 1rem;
        }
    }
</style>


<body>
    <!-- Main Content Wrapper -->
    <main class="main-container">
        <h1 class="heading">
            Find Your Perfect
            <span class="highlight">Event</span>
        </h1>
        <p class="subheading">
            Discover and book tickets to the hottest concerts and music events near you.
        </p>
        <form class="search-form" action="/events/search" method="GET">
            <div class="form-group">
                <label class="form-label" for="searchInput">
                    What are you looking for?
                </label>
                <input aria-label="Search for artist, event, or venue" class="form-input" id="searchInput" name="query"
                    placeholder="Artist, event, or venue" type="text" />
            </div>
            <div class="form-group">
                <label class="form-label" for="locationInput">
                    Where?
                </label>
                <input aria-label="Search by city or zip code" class="form-input" id="locationInput" name="location"
                    placeholder="City or zip code" type="text" />
            </div>
            <div class="form-group">
                <label class="form-label" for="dateInput">
                    When?
                </label>
                <div class="date-input-wrapper">
                    <input aria-label="Select date" class="form-input" id="dateInput" name="date" type="date" />
                    <span class="date-icon">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                </div>
            </div>
            <button class="submit-btn" type="submit">
                <i class="fas fa-search"></i>
                Search Events
            </button>
        </form>
    </main>
</body>

</html>