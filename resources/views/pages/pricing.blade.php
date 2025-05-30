@extends('layouts.app')

@push('styles')
    <style>
        /* Pricing Page Styles with Rhythmx Color Palette */
        :root {
            --electric-violet: #8F00FF;
            --jet-black: #121212;
            --neon-aqua: #00F6FF;
            --platinum-gray: #E5E5E5;
            --sunset-coral: #FF4F81;
            --dashboard-bg-light: #f5f5f5;
            --dashboard-bg-dark: #121212;
            --card-bg-light: #fff;
            --card-bg-dark: rgba(18, 18, 18, 0.92);
            --input-bg-light: #f5f5f5;
            --input-bg-dark: #232323;
            --border-light: #e5e5e5;
            --border-dark: rgba(143, 0, 255, 0.3);
            --text-main-light: #222;
            --text-main-dark: #E5E5E5;
            --text-muted-light: #666;
            --text-muted-dark: #bdbdbd;
        }

        body {
            background: var(--dashboard-bg-dark);
            color: var(--text-main-dark);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            transition: background 0.3s, color 0.3s;
        }

        .pricing-page {
            min-height: 100vh;
            background: #121212;
            /* Jet Black */
            padding: 3rem 1rem;
            color: #E5E5E5;
            /* Platinum Gray */
        }

        .pricing-container {
            max-width: 80rem;
            margin: 0 auto;
        }

        /* Header Styles */
        .pricing-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .pricing-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: #8F00FF;
            /* Electric Violet */
            margin-bottom: 1rem;
            text-shadow: 0 0 10px rgba(143, 0, 255, 0.3);
        }

        .pricing-subtitle {
            max-width: 42rem;
            margin: 0 auto;
            font-size: 1.125rem;
            color: #E5E5E5;
            /* Platinum Gray */
        }

        /* Pricing Cards Grid */
        .pricing-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        @media (min-width: 768px) {
            .pricing-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Pricing Card Styles */
        .pricing-card {
            position: relative;
            background: #1E1E1E;
            /* Darker than Jet Black for contrast */
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #2A2A2A;
        }

        .pricing-card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 246, 255, 0.2);
            /* Neon Aqua glow */
            transform: translateY(-0.5rem);
        }

        .pricing-card-content {
            padding: 2rem;
        }

        /* Featured Card */
        .featured-card {
            border: 2px solid #8F00FF;
            /* Electric Violet */
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(143, 0, 255, 0.3),
                0 0 40px rgba(0, 246, 255, 0.1);
        }

        .featured-badge {
            position: absolute;
            top: 0;
            right: 0;
            background: #FF4F81;
            /* Sunset Coral */
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.25rem 0.75rem;
            border-bottom-left-radius: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Card Header */
        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #E5E5E5;
            /* Platinum Gray */
        }

        .card-badge {
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 9999px;
        }

        .badge-free {
            color: #00F6FF;
            /* Neon Aqua */
            background: rgba(0, 246, 255, 0.1);
            border: 1px solid #00F6FF;
        }

        .badge-popular {
            color: #121212;
            /* Jet Black */
            background: #00F6FF;
            /* Neon Aqua */
        }

        .badge-enterprise {
            color: #8F00FF;
            /* Electric Violet */
            background: rgba(143, 0, 255, 0.1);
            border: 1px solid #8F00FF;
        }

        .card-description {
            color: #A0A0A0;
            /* Lighter gray for secondary text */
            margin-top: 1rem;
        }

        /* Price Display */
        .price-display {
            margin-top: 2rem;
        }

        .price-amount {
            font-size: 2.25rem;
            font-weight: 700;
            color: #E5E5E5;
            /* Platinum Gray */
        }

        .price-period {
            color: #A0A0A0;
            /* Lighter gray */
        }

        /* Features List */
        .features-list {
            margin-top: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
        }

        .feature-icon {
            height: 1.25rem;
            width: 1.25rem;
            color: #00F6FF;
            /* Neon Aqua */
            flex-shrink: 0;
        }

        .feature-text {
            margin-left: 0.75rem;
            color: #E5E5E5;
            /* Platinum Gray */
        }

        /* Buttons */
        .card-button {
            width: 100%;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            margin-top: 2.5rem;
            cursor: pointer;
            font-weight: 600;
            letter-spacing: 0.025em;
        }

        .button-outline {
            border: 2px solid #8F00FF;
            /* Electric Violet */
            color: #8F00FF;
            background: transparent;
        }

        .button-outline:hover {
            background: #8F00FF;
            color: white;
            box-shadow: 0 0 15px rgba(143, 0, 255, 0.5);
        }

        .button-solid {
            background: #8F00FF;
            /* Electric Violet */
            color: white;
            border: 2px solid #8F00FF;
        }

        .button-solid:hover {
            background: #7A00E0;
            box-shadow: 0 0 20px rgba(143, 0, 255, 0.5);
            transform: translateY(-2px);
        }

        /* FAQ Section */
        .faq-section {
            margin-top: 6rem;
            max-width: 56rem;
            margin-left: auto;
            margin-right: auto;
        }

        .faq-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #8F00FF;
            /* Electric Violet */
            text-align: center;
            margin-bottom: 2rem;
            text-shadow: 0 0 10px rgba(143, 0, 255, 0.3);
        }

        .faq-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .faq-item {
            background: #1E1E1E;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.3);
            border: 1px solid #2A2A2A;
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            border-color: #8F00FF;
            box-shadow: 0 0 15px rgba(143, 0, 255, 0.2);
        }

        .faq-question {
            font-weight: 600;
            font-size: 1.125rem;
            color: #E5E5E5;
            /* Platinum Gray */
            margin-bottom: 0.5rem;
        }

        .faq-answer {
            color: #A0A0A0;
            /* Lighter gray */
            line-height: 1.6;
        }

        /* Neon Glow Effects */
        .button-solid,
        .featured-card,
        .pricing-title {
            position: relative;
            overflow: hidden;
        }

        .button-solid::after,
        .featured-card::after,
        .pricing-title::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(0, 246, 255, 0.2) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .button-solid:hover::after,
        .featured-card:hover::after,
        .pricing-title:hover::after {
            opacity: 1;
        }

        /* Pricing Page Styles with Rhythmx Color Palette */
        .pricing-page {
            min-height: 100vh;
            background: #121212;
            /* Jet Black */
            padding: 3rem 1rem;
            color: #E5E5E5;
            /* Platinum Gray */
        }

        .pricing-container {
            max-width: 80rem;
            margin: 0 auto;
        }

        /* Header Styles */
        .pricing-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .pricing-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: #8F00FF;
            /* Electric Violet */
            margin-bottom: 1rem;
            text-shadow: 0 0 10px rgba(143, 0, 255, 0.3);
        }

        .pricing-subtitle {
            max-width: 42rem;
            margin: 0 auto;
            font-size: 1.125rem;
            color: #E5E5E5;
            /* Platinum Gray */
        }

        /* Pricing Cards Grid */
        .pricing-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        @media (min-width: 768px) {
            .pricing-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Pricing Card Styles */
        .pricing-card {
            position: relative;
            background: #1E1E1E;
            /* Darker than Jet Black for contrast */
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #2A2A2A;
        }

        .pricing-card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 246, 255, 0.2);
            /* Neon Aqua glow */
            transform: translateY(-0.5rem);
        }

        .pricing-card-content {
            padding: 2rem;
        }

        /* Featured Card */
        .featured-card {
            border: 2px solid #8F00FF;
            /* Electric Violet */
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(143, 0, 255, 0.3),
                0 0 40px rgba(0, 246, 255, 0.1);
        }

        .featured-badge {
            position: absolute;
            top: 0;
            right: 0;
            background: #FF4F81;
            /* Sunset Coral */
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.25rem 0.75rem;
            border-bottom-left-radius: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Card Header */
        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #E5E5E5;
            /* Platinum Gray */
        }

        .card-badge {
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 9999px;
        }

        .badge-free {
            color: #00F6FF;
            /* Neon Aqua */
            background: rgba(0, 246, 255, 0.1);
            border: 1px solid #00F6FF;
        }

        .badge-popular {
            color: #121212;
            /* Jet Black */
            background: #00F6FF;
            /* Neon Aqua */
        }

        .badge-enterprise {
            color: #8F00FF;
            /* Electric Violet */
            background: rgba(143, 0, 255, 0.1);
            border: 1px solid #8F00FF;
        }

        .card-description {
            color: #A0A0A0;
            /* Lighter gray for secondary text */
            margin-top: 1rem;
        }

        /* Price Display */
        .price-display {
            margin-top: 2rem;
        }

        .price-amount {
            font-size: 2.25rem;
            font-weight: 700;
            color: #E5E5E5;
            /* Platinum Gray */
        }

        .price-period {
            color: #A0A0A0;
            /* Lighter gray */
        }

        /* Features List */
        .features-list {
            margin-top: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
        }

        .feature-icon {
            height: 1.25rem;
            width: 1.25rem;
            color: #00F6FF;
            /* Neon Aqua */
            flex-shrink: 0;
        }

        .feature-text {
            margin-left: 0.75rem;
            color: #E5E5E5;
            /* Platinum Gray */
        }

        /* Buttons */
        .card-button {
            width: 100%;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            margin-top: 2.5rem;
            cursor: pointer;
            font-weight: 600;
            letter-spacing: 0.025em;
        }

        .button-outline {
            border: 2px solid #8F00FF;
            /* Electric Violet */
            color: #8F00FF;
            background: transparent;
        }

        .button-outline:hover {
            background: #8F00FF;
            color: white;
            box-shadow: 0 0 15px rgba(143, 0, 255, 0.5);
        }

        .button-solid {
            background: #8F00FF;
            /* Electric Violet */
            color: white;
            border: 2px solid #8F00FF;
        }

        .button-solid:hover {
            background: #7A00E0;
            box-shadow: 0 0 20px rgba(143, 0, 255, 0.5);
            transform: translateY(-2px);
        }

        /* FAQ Section */
        .faq-section {
            margin-top: 6rem;
            max-width: 56rem;
            margin-left: auto;
            margin-right: auto;
        }

        .faq-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #8F00FF;
            /* Electric Violet */
            text-align: center;
            margin-bottom: 2rem;
            text-shadow: 0 0 10px rgba(143, 0, 255, 0.3);
        }

        .faq-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .faq-item {
            background: #1E1E1E;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.3);
            border: 1px solid #2A2A2A;
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            border-color: #8F00FF;
            box-shadow: 0 0 15px rgba(143, 0, 255, 0.2);
        }

        .faq-question {
            font-weight: 600;
            font-size: 1.125rem;
            color: #E5E5E5;
            /* Platinum Gray */
            margin-bottom: 0.5rem;
        }

        .faq-answer {
            color: #A0A0A0;
            /* Lighter gray */
            line-height: 1.6;
        }

        /* Neon Glow Effects */
        .button-solid,
        .featured-card,
        .pricing-title {
            position: relative;
            overflow: hidden;
        }

        .button-solid::after,
        .featured-card::after,
        .pricing-title::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(0, 246, 255, 0.2) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .button-solid:hover::after,
        .featured-card:hover::after,
        .pricing-title:hover::after {
            opacity: 1;
        }
    </style>
@endpush>

@section('content')
    <div class="pricing-page">
        <div class="pricing-container">
            <!-- Header -->
            <div class="pricing-header">
                <h2 class="pricing-title">Pricing</h2>
                <p class="pricing-subtitle">
                    Simple, transparent pricing that grows with your needs
                </p>
            </div>

            <!-- Pricing Cards -->
            <div class="pricing-grid">
                <!-- Basic Plan -->
                <div class="pricing-card">
                    <div class="pricing-card-content">
                        <div class="card-header">
                            <h3 class="card-title">Basic</h3>
                            <span class="card-badge badge-free">Free</span>
                        </div>
                        <p class="card-description">Perfect for small events and getting started</p>

                        <div class="price-display">
                            <span class="price-amount">$0</span>
                            <span class="price-period">/month</span>
                        </div>

                        <ul class="features-list">
                            <li class="feature-item">
                                <svg class="feature-icon" fill="none" viewBox="0 0 24 24" stroke="#00F6FF">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="feature-text">Up to 100 attendees</span>
                            </li>
                            <li class="feature-item">
                                <svg class="feature-icon" fill="none" viewBox="0 0 24 24" stroke="#00F6FF">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="feature-text">Basic event page</span>
                            </li>
                            <li class="feature-item">
                                <svg class="feature-icon" fill="none" viewBox="0 0 24 24" stroke="#00F6FF">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="feature-text">Email support</span>
                            </li>
                        </ul>

                        <button class="card-button button-outline">
                            Get Started
                        </button>
                    </div>
                </div>

                <!-- Pro Plan (Featured) -->
                <div class="pricing-card featured-card">
                    <div class="featured-badge">POPULAR</div>
                    <div class="pricing-card-content">
                        <div class="card-header">
                            <h3 class="card-title">Pro</h3>
                            <span class="card-badge badge-popular">Best Value</span>
                        </div>
                        <p class="card-description">For growing businesses and larger events</p>

                        <div class="price-display">
                            <span class="price-amount">$29</span>
                            <span class="price-period">/month</span>
                        </div>

                        <ul class="features-list">
                            <li class="feature-item">
                                <svg class="feature-icon" fill="none" viewBox="0 0 24 24" stroke="#00F6FF">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="feature-text">Up to 1,000 attendees</span>
                            </li>
                            <li class="feature-item">
                                <svg class="feature-icon" fill="none" viewBox="0 0 24 24" stroke="#00F6FF">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="feature-text">Custom event pages</span>
                            </li>
                            <li class="feature-item">
                                <svg class="feature-icon" fill="none" viewBox="0 0 24 24" stroke="#00F6FF">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="feature-text">Priority support</span>
                            </li>
                            <li class="feature-item">
                                <svg class="feature-icon" fill="none" viewBox="0 0 24 24" stroke="#00F6FF">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="feature-text">Analytics dashboard</span>
                            </li>
                            <li class="feature-item">
                                <svg class="feature-icon" fill="none" viewBox="0 0 24 24" stroke="#00F6FF">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="feature-text">Custom branding</span>
                            </li>
                        </ul>

                        <button class="card-button button-solid">
                            Get Started
                        </button>
                    </div>
                </div>

                <!-- Enterprise Plan -->
                <div class="pricing-card">
                    <div class="pricing-card-content">
                        <div class="card-header">
                            <h3 class="card-title">Enterprise</h3>
                            <span class="card-badge badge-enterprise">Custom</span>
                        </div>
                        <p class="card-description">For large organizations with custom needs</p>

                        <div class="price-display">
                            <span class="price-amount">$99</span>
                            <span class="price-period">/month</span>
                        </div>

                        <ul class="features-list">
                            <li class="feature-item">
                                <svg class="feature-icon" fill="none" viewBox="0 0 24 24" stroke="#00F6FF">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="feature-text">Unlimited attendees</span>
                            </li>
                            <li class="feature-item">
                                <svg class="feature-icon" fill="none" viewBox="0 0 24 24" stroke="#00F6FF">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="feature-text">White-label solution</span>
                            </li>
                            <li class="feature-item">
                                <svg class="feature-icon" fill="none" viewBox="0 0 24 24" stroke="#00F6FF">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="feature-text">24/7 dedicated support</span>
                            </li>
                            <li class="feature-item">
                                <svg class="feature-icon" fill="none" viewBox="0 0 24 24" stroke="#00F6FF">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="feature-text">API access</span>
                            </li>
                            <li class="feature-item">
                                <svg class="feature-icon" fill="none" viewBox="0 0 24 24" stroke="#00F6FF">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="feature-text">Custom integrations</span>
                            </li>
                        </ul>

                        <button class="card-button button-outline">
                            Contact Us
                        </button>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="faq-section">
                <h3 class="faq-title">Frequently Asked Questions</h3>

                <div class="faq-list">
                    <div class="faq-item">
                        <h4 class="faq-question">Can I change plans later?</h4>
                        <p class="faq-answer">Yes, you can upgrade or downgrade your plan at any time. Changes will be
                            prorated based on your billing cycle.</p>
                    </div>

                    <div class="faq-item">
                        <h4 class="faq-question">Is there a free trial?</h4>
                        <p class="faq-answer">All paid plans come with a 14-day free trial. No credit card required to start
                            your trial.</p>
                    </div>

                    <div class="faq-item">
                        <h4 class="faq-question">What payment methods do you accept?</h4>
                        <p class="faq-answer">We accept all major credit cards (Visa, Mastercard, American Express) as well
                            as PayPal.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection