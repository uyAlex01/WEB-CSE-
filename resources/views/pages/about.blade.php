@extends('layouts.app')

@section('title', 'About Rhythmx')

@section('content')
    @include('components.navbar')

    <style>
        body {
            background-color: #121212;
            color: #E5E5E5;
            padding-top: 80px;
        }

        .about-hero {
            background: linear-gradient(145deg, #8F00FF, #00F6FF);
            color: #121212;
            padding: 60px 20px;
            text-align: center;
        }

        .about-hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .about-content {
            padding: 40px 20px;
            max-width: 900px;
            margin: 0 auto;
        }

        .highlight {
            color: #8F00FF;
            font-weight: bold;
        }

        .accent {
            color: #FF4F81;
        }

        a.cta-button {
            background-color: #00F6FF;
            color: #121212;
            padding: 12px 24px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
            display: inline-block;
            margin-top: 20px;
            transition: 0.3s ease-in-out;
        }

        a.cta-button:hover {
            background-color: #8F00FF;
            color: white;
            text-shadow: 0 0 10px rgba(143, 0, 255, 0.5);
        }

        /* Loyalty Section Styles (from dashboard) */
        .loyalty-section {
            background: linear-gradient(135deg, rgba(143, 0, 255, 0.08), rgba(0, 246, 255, 0.08));
            border: 2px solid var(--electric-violet, #8F00FF);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
            color: inherit;
            transition: background 0.3s, border 0.3s;
        }

        html[data-bs-theme="light"] .loyalty-section {
            background: linear-gradient(135deg, rgba(143, 0, 255, 0.04), rgba(0, 246, 255, 0.04));
            border: 2px solid var(--electric-violet, #8F00FF);
        }

        .loyalty-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(0, 246, 255, 0.05), transparent);
            animation: rotate 8s linear infinite;
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <div class="about-content">
        <div class="loyalty-section">
            <h2>Welcome to <span class="highlight">Rhythmx</span></h2>
            <p>Your gateway to unforgettable live music experiences.</p>
        </div>
    </div>

    <div class="about-content">
        <h2 class="mb-4">Our Story</h2>
        <p>
            <span class="highlight">Rhythmx</span> was born from a passion for music and a dream to connect people through
            the magic of live performances.
            What started as a small idea between a few college friends turned into a full-blown platform built to <span
                class="accent">streamline concert discovery, ticketing, and artist promotion</span>.
        </p>

        <p class="mt-4">
            From humble beginnings, we’ve grown into a vibrant space that supports artists, empowers event organizers, and
            excites fans.
            Our goal is to make event experiences seamless, digital-first, and unforgettable — whether you're in a local gig
            or a sold-out stadium show.
        </p>

        <p class="mt-4">
            With features like a personalized dashboard, real-time ticketing, organizer tools, and a sleek design built for
            the modern concert-goer, <span class="highlight">Rhythmx</span> is setting the stage for the next generation of
            events.
        </p>

        <p class="mt-4">
            Join the movement. Feel the rhythm. Experience the future of live entertainment.
        </p>

        <a href="{{ route('events.browse') }}" class="cta-button">Browse Events</a>
    </div>
@endsection