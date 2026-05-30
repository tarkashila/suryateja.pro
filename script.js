document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;
    const navLinks = document.querySelectorAll('.nav-links a');
    const sections = document.querySelectorAll('section');
    const dynamicTitle = document.getElementById('dynamic-title');

    // Theme toggle functionality
    const updateTheme = () => {
        if (body.classList.contains('light-mode')) {
            body.classList.remove('light-mode');
            localStorage.setItem('theme', 'dark');
            themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
        } else {
            body.classList.add('light-mode');
            localStorage.setItem('theme', 'light');
            themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
        }
    };

    // Check for saved theme preference or default to dark mode
    const savedTheme = localStorage.getItem('theme') || 'dark';
    if (savedTheme === 'light') {
        body.classList.add('light-mode');
        themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
    } else {
        themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
    }

    themeToggle.addEventListener('click', updateTheme);


    // Smooth scrolling for navigation links
    navLinks.forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Update active link on scroll (debounced)
    const updateActiveLink = debounce(() => {
        let scrollPosition = window.scrollY;

        sections.forEach(section => {
            if (scrollPosition >= section.offsetTop - 100 && 
                scrollPosition < (section.offsetTop + section.offsetHeight - 100)) {
                let currentId = section.getAttribute('id');
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${currentId}`) {
                        link.classList.add('active');
                    }
                });
            }
        });
    }, 100);

    window.addEventListener('scroll', updateActiveLink);

    // Dynamic title change
    const titles = [
        'Digital Marketing Consultant',
        'CRM Specialist',
        'Sales Solutions Consultant',
        'Marketing Strategist',
        'Business Tools Consultant',
        'Website Developer',
        'Collaboration Tools Specialist',
        'Digital Solutions Expert',
        'Sales and Marketing Advisor'
    ];
    let titleIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    let typingSpeed = 100;
    let holdDuration = 1000; // 1 second hold time

    function changeDynamicTitle() {
        const currentTitle = titles[titleIndex];
        
        if (isDeleting) {
            dynamicTitle.textContent = currentTitle.substring(0, charIndex - 1);
            charIndex--;
        } else {
            dynamicTitle.textContent = currentTitle.substring(0, charIndex + 1);
            charIndex++;
        }

        if (!isDeleting && charIndex === currentTitle.length) {
            isDeleting = true;
            typingSpeed = holdDuration; // Hold for 1 second when full title is displayed
        } else if (isDeleting && charIndex === 0) {
            isDeleting = false;
            titleIndex = (titleIndex + 1) % titles.length;
            typingSpeed = 100;
        } else {
            typingSpeed = isDeleting ? 50 : 100;
        }

        setTimeout(changeDynamicTitle, typingSpeed);
    }

    changeDynamicTitle();

    // Utility function: Debounce
    function debounce(func, delay) {
        let timeoutId;
        return (...args) => {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => func(...args), delay);
        };
    }

    // Example usage of CircularBuffer for recent views
    const CircularBuffer = (function() {
        return function(capacity) {
            let buffer = [];
            let index = 0;

            return {
                push: function(item) {
                    buffer[index] = item;
                    index = (index + 1) % capacity;
                    if (buffer.length < capacity) buffer.length++;
                },
                get: function() {
                    return buffer.slice(0);
                }
            };
        };
    })();

    const recentViews = new CircularBuffer(5);
    const updateRecentViews = (sectionId) => {
        recentViews.push(sectionId);
        console.log("Recent views:", recentViews.get());
    };

    // Intersection Observer for section visibility
    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                updateRecentViews(entry.target.id);
            }
        });
    }, { threshold: 0.5 });

    sections.forEach(section => sectionObserver.observe(section));

    // Memoized function for expensive calculations (e.g., factorial)
    const memoize = (fn) => {
        const cache = new Map();
        return (...args) => {
            const key = JSON.stringify(args);
            if (cache.has(key)) return cache.get(key);
            const result = fn(...args);
            cache.set(key, result);
            return result;
        };
    };

    const factorial = memoize((n) => {
        if (n <= 1) return 1;
        return n * factorial(n - 1);
    });

    // Example usage of memoized factorial
    console.log("Factorial of 5:", factorial(5));
    console.log("Factorial of 5 (cached):", factorial(5));

    // Async function to fetch GitHub repos (if needed)
    const fetchGitHubRepos = async (username) => {
        try {
            const response = await fetch(`https://api.github.com/users/${username}/repos`);
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("Error fetching GitHub repos:", error);
        }
    };

    // Example usage of async function (commented out to avoid unnecessary API calls)
    // (async () => {
    //     const repos = await fetchGitHubRepos('yourusername');
    //     console.log("GitHub Repos:", repos);
    // })();
});

